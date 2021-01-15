<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="../stranky/home.php">HOME</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample05">
        <ul class="navbar-nav mr-auto">
            <li><a class="nav-link" href="../stranky/home.php">Hlavné jedlá</a>
                <ul>
                    <li><a href="../stranky/gulas.php">Hovädzí guláš</a></li>
                    <li><a href="../stranky/kari.php">Kari kura</a></li>
                    <li><a href="../stranky/losos.php">Grilovaný losos</a></li>
                </ul>
            </li>
            <li><a class="nav-link" href="../stranky/home.php">Nápoje</a>
                <ul>
                    <li><a href="#">Kofola</a></li>
                    <li><a href="#">Pivo</a></li>
                    <li><a href="#">Káva</a></li>
                </ul>
            </li>
            <li><a class="nav-link" href="../stranky/home.php">Nápoje</a>
                <ul>
                    <li><a href="#">Kofola</a></li>
                    <li><a href="#">Pivo</a></li>
                    <li><a href="#">Káva</a></li>
                </ul>
            </li>

            <li><a class="nav-link" href="../stranky/home.php">Dezerty</a>
                <ul>
                    <li><a href="#">Zmrzlina</a></li>
                    <li><a href="#">Palacinky</a></li>
                    <li><a href="#">Štrúdľa</a></li>
                </ul>
            </li>

            <li><a class="nav-link <?php if ($_SESSION['login'] != ""){echo "hidden";} ?> " href="../stranky/login.php">login</a> </li>
            <li><a class="nav-link <?php if ($_SESSION['login'] != ""){echo "hidden";} ?> " href="../stranky/register.php">register</a> </li>
            <li><a class="nav-link <?php if ($_SESSION['login'] != "admin"){echo "hidden";} ?> " href="../stranky/pridajObrazok.php">pridaj</a> </li>
            <li><a class="nav-link <?php if ($_SESSION['login'] == ""){echo "hidden";} ?>" href="../stranky/edit.php">edit</a> </li>
            <li><a class="nav-link <?php if ($_SESSION['login'] == ""){echo "hidden";} ?>" href="../stranky/logout.php">logout</a> </li>
        </ul>

    </div>
</nav>
