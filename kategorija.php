<!DOCTYPE html>
<?php 
include 'connect.php';
$category = $_GET['kategorija']; 
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
        <!--Kod za prikaz friško upload-anog sadržaja-->
        
        <div class="col-11 ">
            <h2><?php echo $category ?></h2>
            <div class="row">
                <?php
                    $query = "SELECT * FROM seminar WHERE arhiva=1 AND kategorija='$category'";
                    $res = mysqli_query($dbc, $query);
                    while ($row = mysqli_fetch_array($res)){
                        echo "<div class='col-sm-4' style='border:2px black solid;'>";
                            echo "<div>";
                                echo "<img src='img/" . $row['slika'] . "' style='width:100%; height:auto;'/>";
                            echo "</div>";
                            echo "<div>";
                                echo "<h4>";
                                    echo "<a href='clanak.php?id=" . $row['id']."'>";
                                        echo $row['naslov'];
                                echo "</a></h4>";
                        echo "</div></div>";
                    }?>
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
