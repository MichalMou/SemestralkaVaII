<?php
include "../server/server.php"
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
    <form class="form-signin" method="post" enctype="multipart/form-data"  action="<?php pridajObrazok($link); ?>">


        <h1 class="textCent">Pridaj obrázok</h1>
        <input type="file" name="pridanyObrazok"  id="pridanyObrazok" accept="image/jpeg" class="form-control" >

        <h1 class="textCent">Categória obrázku</h1>
        <select class="selectMid" name="typObr">
            <option value="0">Vyber typ obrázku:</option>
            <option value="1">Guláš</option>
            <option value="2">Losos</option>
            <option value="3">Kari</option>
            <option value="4">Káva</option>
            <option value="5">Kofola</option>
            <option value="6">Pivo</option>
            <option value="7">Palacinky</option>
            <option value="8">Štrudľa</option>
            <option value="9">Zmrzlina</option>
        </select>

        <div>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="upload">upload</button>
        </div>
    </form>

    <form method="post" action="<?php vymazObrazok($link); ?>">
        <?php listObrazkov($link); ?>


        <div>
            <button class="btn btn-lg btn-primary btn-block btn-marg" type="submit" name="deleteImg">delete</button>
        </div>
    </form>


</div>

</body>


</html>