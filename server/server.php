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
            $encryptedPswd = md5($password);
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
        $encryptedPassword = md5($password);
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
                        <img src=" . $img_adr . " />
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

        header("location: home.php");
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
                    <div class='check-img' >
                        <img src='$img_adr'  />
                    </div>
                    <div class='check-text'>
                        <input class='textCent' type='checkbox' id='image.$i' name='image.$i' value='1'>
                        <label for='image.$i' > I have a bike</label><br>
                    </div>
                    
                    
              ";
        }
    }
}

function vymazObrazok($link)
{

}
