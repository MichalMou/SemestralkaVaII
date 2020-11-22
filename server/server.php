<?php
session_start();

$login = "";
$email = "";
$password = "";
$errors = array();

// vytvorim spojenie
$link = mysqli_connect('localhost', 'root', '', 'vaiisem');

// otestujem spojenie
if(!$link) {
    echo "Nepodarilo sa pripojit na MySQL server!";
    echo 'chyba'.mysqli_connect_error();
    die;
}

function register($link)
{
    if (isset($_POST['register'])) {
        $nick = mysqli_real_escape_string($link, $_POST['nick']);
        $email = mysqli_real_escape_string($link, $_POST['email']);
        $password = mysqli_real_escape_string($link, $_POST['password']);
        $repassword = mysqli_real_escape_string($link, $_POST['repassword']);

        //controll of input
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
        if (empty($nick)) {
            array_push($errors, "Username is required");
        }
        if (empty($email)) {
            array_push($errors, "Email is required");
        }
        if (empty($password)) {
            array_push($errors, "Password is required");
        }
        if ($password != $repassword) {
            array_push($errors, "The two passwords do not match");
        }

        //controll of occupied acc name or email
        $user_check_query = "SELECT * FROM account WHERE login='$nick' OR email='$email' LIMIT 1";
        $result = mysqli_query($link, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        // if user exists
        if ($user) {
            if ($user['login'] === $nick) {
                array_push($errors, "Username already exists");
            }

            if ($user['email'] === $email) {
                array_push($errors, "email already exists");
            }
        }
        //kontrola chyb
        if (count($errors) == 0) {
            $encryptedPswd = md5($password);
            $SQLquerry = "INSERT INTO account (email,login,password) VALUES ('$email','$nick','$encryptedPswd')";
            mysqli_query($link, $SQLquerry);
            header("location: home.php");
            exit();
        }

    }
}

function login($link){
    if (isset($_POST['login'])) {
        $login = mysqli_real_escape_string($link, $_POST['username']);
        $password = mysqli_real_escape_string($link, $_POST['LoginPassword']);
        $encryptedPassword = md5($password);
        $query = "SELECT * FROM account WHERE login='$login' AND password='$encryptedPassword'";
        $results = mysqli_query($link, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['login'] = $login;
            header("location: home.php");
            exit();
        }
    }
}

function editAccount($link){
    if (isset($_POST['edit'])) {
        $newLogin = mysqli_real_escape_string($link, $_POST['newUsername']);
        $newEmail = mysqli_real_escape_string($link, $_POST['newEmail']);
        $newPassword = mysqli_real_escape_string($link, $_POST['newPassword']);
        $oldUsername = mysqli_real_escape_string(_SESSION['username']);

        //find id of account to delete
        $query = "SELECT id FROM account WHERE login='$oldUsername' ";
        $user = mysqli_query($link, $query);
        $id = $user['id'];

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
            $query = "UPDATE account SET login='$newLogin' email='$newEmail' password='$newPassword' WHERE id='$id' ";
            $results = mysqli_query($link, $query);
            if (mysqli_num_rows($results) == 1) {
                $_SESSION['login'] = $newLogin;
                header("location: home.php");
                exit();
            }
        }
    }



}

function deleteAccount($link){
    $username = mysqli_real_escape_string(_SESSION['username']);
    $query = "SELECT id FROM account WHERE login='$username' ";
    $user = mysqli_query($link, $query);
    $id = $user['id'];

    $query = "DELETE FROM account WHERE id='$id' ";
    $result = mysqli_query($link, $query);
    if($result === True){
        session_reset();
        header("location: home.php");
        exit;
    }
}