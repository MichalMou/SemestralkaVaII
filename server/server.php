<?php

session_start();


$login = "";
$email = "";
$password = "";
$errory = 0;

// vytvorim spojenie
$link = mysqli_connect('localhost', 'root', '', 'vaiisem');

// otestujem spojenie
if (!$link) {
    echo "Nepodarilo sa pripojit na MySQL server!";
    echo 'chyba' . mysqli_connect_error();
    die;
}



function register($link)
{
    if (isset($_POST['register'])) {
        $errory = 0;
        $nick = mysqli_real_escape_string($link, $_POST['nick']);
        $email = mysqli_real_escape_string($link, $_POST['email']);
        $password = mysqli_real_escape_string($link, $_POST['password']);
        $repassword = mysqli_real_escape_string($link, $_POST['repassword']);

        //controll of input
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errory++;
            echo "<p>Invalid email format </p>p>";
        }
        if (empty($nick)) {
            $errory++;
            echo "<p>Username is required</p>";
        }
        if (empty($email)) {
            $errory++;
            echo "<p>Email is required</p>";
        }
        if (empty($password)) {
            $errory++;
            echo "<p>Password is required</p>>";
        }
        if ($password != $repassword) {
            $errory++;
            echo "<p>The two passwords do not match</p>";
        }

        //controll of occupied acc name or email
        $user_check_query = "SELECT * FROM account WHERE login='$nick' OR email='$email' LIMIT 1";
        $result = mysqli_query($link, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        // if user exists
        if ($user) {
            if ($user['login'] === $nick) {
                $errory++;
                echo "<p>Username already exists</p>";
            }

            if ($user['email'] === $email) {
                $errory++;
                echo "<p>email already exists</p>";
            }
        }
        //kontrola chyb
        if ($errory++ == 0) {
            $passwordSalty = $password . $nick;
            $encryptedPswd = md5($passwordSalty);
            $SQLquerry = "INSERT INTO account (email,login,password) VALUES ('$email','$nick','$encryptedPswd')";
            mysqli_query($link, $SQLquerry);
            header("location: home.php");
            exit();
        }

    }
}

function login($link)
{
    if (isset($_POST['username'])) {
        $login = mysqli_real_escape_string($link, $_POST['username']);
        $password = mysqli_real_escape_string($link, $_POST['loginPassword']);
        $passwordSalty = $password . $login;
        $encryptedPassword = md5($passwordSalty);
        $query = "SELECT * FROM account WHERE login='$login' AND password='$encryptedPassword'";
        $results = mysqli_query($link, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['login'] = $login;
            header("location: home.php?");
            exit();
        }
    }
}

function editAccount($link)
{
    if (isset($_POST['edit'])) {
        $errors = array();
        $newLogin = mysqli_real_escape_string($link, $_POST['newUsername']);
        $newEmail = mysqli_real_escape_string($link, $_POST['newEmail']);
        $newPassword = mysqli_real_escape_string($link, $_POST['newPassword']);
        $oldUsername = mysqli_real_escape_string($link, $_SESSION['login']);
        $newPassword = md5($newPassword);

        //find id of account to delete
        $query = "SELECT ID FROM account WHERE login='$oldUsername'";
        $user = mysqli_query($link, $query);
        $data = mysqli_fetch_assoc($user);
        $id = $data["ID"];

        //controll of occupied acc name or email
        $user_check_query = "SELECT * FROM account WHERE login='$newLogin' OR email='$newEmail' LIMIT 1";
        $result = mysqli_query($link, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        // if user exists
        if ($user) {
            if ($user['login'] === $newLogin) {
                array_push($errors, "Username already exists");
            }

            if ($user['email'] === $newEmail) {
                array_push($errors, "email already exists");
            }
        }

        //controll of errors
        if (count($errors) == 0) {
            $query = "UPDATE account SET login='$newLogin' ,email='$newEmail' ,password='$newPassword' WHERE id='$id' ";
            $results = mysqli_query($link, $query);
            if (mysqli_affected_rows($link) == 1) {
                $_SESSION['login'] = $newLogin;
                header("location: home.php");
                exit();
            }
        }
    }
}

function deleteAccount($link)
{
    if (isset($_POST['delete'])) {
        $username = mysqli_real_escape_string($link, $_SESSION['login']);
        $query = "SELECT ID FROM account WHERE login='$username'";
        $user = mysqli_query($link, $query);
        $data = mysqli_fetch_assoc($user);
        $id = $data["ID"];

        $query = "DELETE FROM account WHERE ID='$id'";
        $result = mysqli_query($link, $query);

        if (mysqli_affected_rows($link) > 0) {
            session_reset();
            header("location: home.php");
            exit();
        }
    }
}

function logout()
{
    if (isset($_POST['logout'])) {
        $_SESSION['login'] = "";
        header("location: home.php?");
        exit();
    }
}

function getOobneUdaje($link) {
    $login = $_SESSION['login'];
    $query = "SELECT * FROM account WHERE login='$login'";
    $result = mysqli_query($link, $query);

    $row = mysqli_fetch_array($result);
    $email = $row['email'];
    $heslo = $row['password'];


    echo "
    <p class='textInfo'> 
    Meno : $login <br/>
    Email : $email <br/>
    </p>
    ";


}

function getObrazok($link, $typ)
{
    $query = "SELECT * FROM obrazky";
    $result = mysqli_query($link, $query);
    $i = 0;

    if (mysqli_num_rows($result) > 0) {
        while ($i < mysqli_num_rows($result)) {
            $i++;
            $row = mysqli_fetch_array($result);

            // zobrazovanie obrazkov
            if ($row['typ'] == $typ) {
                $img_adr = $row['adresa'];

                echo "
                    <div class='image' >
                        <img alt='' src='" . $img_adr . "' />
                    </div>
                ";
            }
        }
    }
}

function pridajObrazok($link)
{
    if (isset($_POST['upload'])) {
        $priecinok_obr = '../image/';

        $tmp_adresa = $_FILES['pridanyObrazok']['tmp_name'];
        $nazov = basename($_FILES['pridanyObrazok']['name']);

        $typObr = $_POST['typObr'];
        $adresa = "../image/$nazov";

        move_uploaded_file($tmp_adresa, $priecinok_obr . $nazov);

        $query = "INSERT INTO obrazky (nazov, typ, adresa) VALUES ('$nazov','$typObr','$adresa')";
        $result = mysqli_query($link, $query);

        header("location: Obrazky.php");
        exit();
    }
}

function listObrazkov($link)
{
    $query = "SELECT * FROM obrazky";
    $result = mysqli_query($link, $query);
    $i = 0;

    if (mysqli_num_rows($result) > 0) {
        while ($i < mysqli_num_rows($result)) {
            $i++;
            $row = mysqli_fetch_array($result);
            $img_adr = $row['adresa'];
            // zobrazovanie obrazkov

            echo "
                    <div class='checkImg ' >
                        <img class='imgMid' alt='' src='$img_adr'  />
                    </div>
                    <div class='checkText'>
                        <input class='textCent' type='checkbox' id='image$i' name='image$i' value='1'>
                        <label for='image$i' > Vymazat tento obrázok</label><br>
                    </div>
              ";
        }
    }
}

function vymazObrazok($link)
{
    if (isset($_POST['deleteImg'])) {
        $query = "SELECT * FROM obrazky";
        $result = mysqli_query($link, $query);
        $poc_riadkov = mysqli_num_rows($result);
        $i = 0;

        if ($poc_riadkov > 0) {
            while ($i <= $poc_riadkov) {
                $i++;
                $row = mysqli_fetch_array($result);
                $img_nazov = $row['nazov'];

                // testovacia cast
                $tmp_post = 'image' . $i;

                if (isset($_POST[$tmp_post])) {
                    $query2 = "DELETE FROM obrazky WHERE nazov = '$img_nazov'";
                    $result2 = mysqli_query($link, $query2);
                }
            }

        }
        header("location: home.php");
        exit();

    }
}

function getClanok($link, $typ) {
    $query = "SELECT * FROM články";
    $result = mysqli_query($link, $query);
    $i = 0;

    if (mysqli_num_rows($result) > 0) {
        while ($i < mysqli_num_rows($result)) {
            $i++;
            $row = mysqli_fetch_array($result);

            // zobrazovanie obrazkov
            if ($row['typ'] == $typ) {
                $nadpis = $row['nadpis'];
                $text = $row['článok'];
                $nazov = $row['názov'];
                echo "
                    <h1>$nadpis</h1>
                    <p>$text</p>
                    ";

                if ($_SESSION['login'] == "admin") {
                    echo '
                        <form class="form-signin" method="post" action="<?php vymazatClanok($link,'.$nazov.');  ?>">
                            <div>
                                <button class="btn btn-lg btn-primary btn-block" type="submit" name="deleteClanok">vymazať článok</button>
                            </div>
                        </form>
                        ';

                }
            }
        }
    }
}

function vymazatClanok($link,$nazov) {
    if (isset($_POST['deleteImg'])) {
        $query = "SELECT * FROM články";
        $result = mysqli_query($link, $query);
        $poc_riadkov = mysqli_num_rows($result);
        $i = 0;

        if ($poc_riadkov > 0) {
            while ($i <= $poc_riadkov) {
                $i++;
                $row = mysqli_fetch_array($result);
                $nazovClanok = $row['nazov'];

                if ($nazov == $nazovClanok) {
                    $query2 = "DELETE FROM obrazky WHERE nazov = '$nazovClanok'";
                    $result2 = mysqli_query($link, $query2);
                }
            }
        }
        exit();
    }
}

function pridajClanok($link) {
    if(isset($_POST['pridajClanok'])) {
        $nazov = $_POST['nazovClanok'];
        $nadpis = $_POST['nadpisClanok'];
        $text = $_POST['textClanok'];
        $typ = $_POST['typClanok'];
        $query = "INSERT INTO články(typ, názov, nadpis, článok) VALUES ('$typ','$nazov','$nadpis','$text')";
        $result = mysqli_query($link, $query);


    }


}
