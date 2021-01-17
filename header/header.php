<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="../stranky/home.php">HOME</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05"
            aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample05">
        <ul class="navbar-nav mr-auto">
            <li><a class="nav-link" href="../stranky/home.php">Hlavné jedlá</a>
                <ul>
                    <li><a href="../stranky/jedlo/gulas.php">Hovädzí guláš</a></li>
                    <li><a href="../stranky/jedlo/kari.php">Kari kura</a></li>
                    <li><a href="../stranky/jedlo/losos.php">Grilovaný losos</a></li>
                </ul>
            </li>

            <li><a class="nav-link" href="../stranky/home.php">Nápoje</a>
                <ul>
                    <li><a href="../stranky/napoje/kava.php">Káva</a></li>
                    <li><a href="../stranky/napoje/kofola.php">Kofola</a></li>
                    <li><a href="../stranky/napoje/pivo.php">Pivo</a></li>
                </ul>
            </li>

            <li><a class="nav-link" href="../stranky/home.php">Dezerty</a>
                <ul>
                    <li><a href="../stranky/dezerty/palacinky.php">Palacinky</a></li>
                    <li><a href="../stranky/dezerty/strudla.php">Štrúdľa</a></li>
                    <li><a href="../stranky/dezerty/zmrzlina.php">Zmrzlina</a></li>
                </ul>
            </li>

            <li><a class="nav-link" href="../stranky/home.php">Možnosti</a>
                <ul>

                    <li class="<?php if ($_SESSION['login'] != "") {
                        echo "hidden";
                    } ?>"><a class="nav-link " href="../stranky/login.php">Login</a></li>
                    <li class="<?php if ($_SESSION['login'] != "") {
                        echo "hidden";
                    } ?>"><a class="nav-link" href="../stranky/register.php">Register</a> </li>
                    <li class="<?php if ($_SESSION['login'] != "admin") {
                        echo "hidden";
                    } ?>"><a class=" nav-link" href="../stranky/Obrazky.php">Správa obrázkov</a> </li>
                    <li class="<?php if ($_SESSION['login'] == "") {
                        echo "hidden";
                    } ?>"><a class=" nav-link " href="../stranky/edit.php">Správa účtu</a> </li>
                    <li class="<?php if ($_SESSION['login'] == "") {
                        echo "hidden";
                    } ?>"><a class=" nav-link " href="../stranky/logout.php">Logout</a> </li>
                </ul>
            </li>

        </ul>

    </div>
</nav>
