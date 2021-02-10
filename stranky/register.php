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
<?php include('../header/header.php'); ?>

        <div class="gallery">
            <form class="form-signin" method="post" action="<?php register($link);  ?>">
                <h1 class="h3 mb-3 font-weight-normal">Registrácia</h1>
                <input type="text" id="inputLogin" class="form-control" placeholder="Nick" required autofocus name="nick">
                <div>
                    <?php
                    if (isset($_GET['exLog'])) {
                        echo '<p>Meno obsadene!</p>'."\n";
                    }
                    ?>
                </div>
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus name="email">
                <div>
                    <?php
                    if (isset($_GET['invEml'])) {
                        echo '<p>Zlý email!</p>'."\n";
                    }
                    if (isset($_GET['exEml'])) {
                        echo '<p>Email Obsadený!</p>'."\n";
                    }
                    ?>
                </div>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password">
                <input type="password" id="inputRePassword" class="form-control" placeholder="Repeat password" required name="repassword">
                <div>
                    <?php
                    if (isset($_GET['matPwd'])) {
                        echo '<p>Heslá sa nezhodujú!</p>'."\n";
                    }
                    ?>
                </div>
                <div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="register">register</button>
                </div>
                <?php
                if (isset($_GET['succ'])) {
                    echo '<h1>Registrácia úspešná</h1>'."\n";
                }
                ?>
            </form>
        </div>
</body>
</html>
