<?php
include "../server/server.php";

?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Galeria jedál</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="home.php">HOME</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample05">
        <ul class="navbar-nav mr-auto">
            <li><a class="nav-link" href="home.php">Hlavné jedlá</a>
                <ul>
                    <li><a href="gulas.php">Hovädzí guláš</a></li>
                    <li><a href="kari.php">Kari kura</a></li>
                    <li><a href="losos.php">Grilovaný losos</a></li>
                </ul>
            </li>
            <li><a class="nav-link" href="home.php">Nápoje</a>
                <ul>
                    <li><a href="#">Kofola</a></li>
                    <li><a href="#">Pivo</a></li>
                    <li><a href="#">Káva</a></li>
                </ul>
            </li>
            <li><a class="nav-link" href="home.php">Nápoje</a>
                <ul>
                    <li><a href="#">Kofola</a></li>
                    <li><a href="#">Pivo</a></li>
                    <li><a href="#">Káva</a></li>
                </ul>
            </li>

            <li><a class="nav-link" href="home.php">Dezerty</a>
                <ul>
                    <li><a href="#">Zmrzlina</a></li>
                    <li><a href="#">Palacinky</a></li>
                    <li><a href="#">Štrúdľa</a></li>
                </ul>
            </li>
            <li><a class="nav-link" href="login.php">login</a> </li>
            <li><a class="nav-link" href="register.php">register</a> </li>
            <li><a class="nav-link" href="edit.php">edit</a> </li>
        </ul>

    </div>
</nav>

<div class="gallery">
    <form class="form-signin" method="post" action="<?php editAccount($link);  ?>">
        <h1 class="h3 mb-3 font-weight-normal">Edit</h1>
        <input type="text" id="inputLogin" class="form-control" placeholder="Nick" required autofocus name="newNick">
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus name="newEmail">
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="newPassword">
        <div>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="register">Edit</button>
        </div>
    </form>

    <form class="form-signin" method="post" action="<?php deleteAccount($link);  ?>">
        <div>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="Delete account">Edit</button>
        </div>
    </form>
</div>
</body>
</html>
