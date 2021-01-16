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
    <div class="article text textCent">
        <h1>Kari kura</h1>
        <p>
            Na rozpálenom masle opražíme nadrobno nakrájanú cibuľu. Pridáme nakrájané kuracie prsia, dochutíme ich
            soľou, korením, kari a červenou paprikou. Chvíľu ich restujeme a prilejeme vývar. Mäso približne 5 minút
            varíme na miernom ohni, primiešame smotanu a necháme ju prehriať. Kari podávame s ryžou.
        </p>

    </div>
    <?php getObrazok($link, 3); ?>

</div>

</body>
</html>