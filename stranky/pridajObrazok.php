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

        <h1 class="h3 mb-3 font-weight-normal textCent">Pridaj obrázok</h1>
        <input type="file" name="pridanyObrazok"  id="pridanyObrazok" accept="image/jpeg" class="form-control" >

        <h1 class="h3 mb-3 font-weight-normal textCent">Vyber typ obrázku. </h1>
        <input type="radio" name="typObr" value="1">
        <label for="gulas">Gulas</label><br>
        <input type="radio" name="typObr" value="3">
        <label for="kari">Kari</label><br>
        <input type="radio" name="typObr" value="2">
        <label for="losos">Losos</label>

        <div>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="upload">upload</button>
        </div>
    </form>
</div>

</body>


</html>