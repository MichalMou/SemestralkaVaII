<?php
include "../server/server.php"
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Galeria jedál</title>
</head>
<body>
<?php include('../header/header.php'); ?>



<div class="gallery">
    <div class="textCent">
        <form class="form-signin-text " method="post" action="<?php pridajClanok($link); ?>">

            <div><label for="subject1">Názov článku</label></div>
            <div class="article-okno article-text">
                <input class="article-okno article-text" id="subject1" name="nazovClanok" placeholder="Názov.." ></input>
            </div>

            <h1 class="textCent">Vyber typ článku. </h1>
            <select class="selectMid" name="typClanok">
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

            <div><label for="subject2">Nadpis</label></div>
            <div class="article-okno article-text">
                <input class="article-okno article-text" id="subject2" name="nadpisClanok" placeholder="Nadpis.." ></input>
            </div>

            <div><label for="subject3">Článok</label></div>
            <div class="article-okno">
                <textarea class="article-okno " id="subject3" name="textClanok" placeholder="Text článku.."></textarea>
            </div>


            <div>
                <button class=" btn btn-lg btn-primary btn-block button" type="submit" name="pridajClanok">Pridaj článok</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>

