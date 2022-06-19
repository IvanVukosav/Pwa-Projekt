<!DOCTYPE html>
<?php
include "connect.php";
$id = $_GET['id'];
$query = "SELECT * FROM seminar WHERE id=$id";
$res = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($res);
mysqli_close($dbc);
?>
<html>

<head>
    <title>Projekt</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="style1.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
<header>
        <div class="head">
            <h1>debate</h1>
        </div>
        <div class="navigation">
             <div class="container">
                 <div class="row">
                    <div class="col-8  mx-auto ">
                        <nav>
                            <ul>
                                <li><a href="index.php">HOME</a></li>
                                <li><a href="kategorija.php?kategorija=Mundo">MUNDO</a></li>
                                <li><a href="kategorija.php?kategorija=Deporte">DEPORTE</a></li>
                                <li><a href="administracija.php">ADMINISTRACIJA</a></li>
                                <li><a href="form.php">UNOS</a></li>
                                <li><a href="registracija.php">REGISTRACIJA</a></li>
                            </ul>
                        </nav>
                     </div>
                </div>
            </div>
        </div>
    </div>
    </header>
    <div class="container">
        <div class="row">
        <!--Kod za prikaz zasebnih članaka-->
            <div class="col-8 center1 container" >
                <div>
                    <h2><?php
                        echo "<span>" . $row['kategorija'] . "</span>";
                    ?></h2>
                    <h1><?php
                        echo "<span>" . $row['naslov'] . "</span>";
                    ?></h1>
                      <p class="headerSize"><?php
                        echo "<span>" . $row['sazetak'] . "</span>";
                    ?></p>
                    <p>&bull; <?php
                        echo "<span>" . $row['datum'] . "</span>";
                    ?></p>
                </div>
                <div>
                    <?php
                        echo "<img src='img/" . $row['slika'] . "'>";
                    ?>
                </div>
                <div>
                    <p><?php
                        echo "<span>" . $row['tekst'] . "</span>";
                    ?></p>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="footerB">
    </div>
    <footer>
        <p>@Copyright EL DEBATE.Todos los derchos resevados.</p>
    </footer>
</body>

</html>