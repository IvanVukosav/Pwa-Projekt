<!DOCTYPE html>
<?php
include "connect.php";

$picture = $_FILES['slika']['name'];
$title = $_POST['naslov'];
$about = $_POST['sazetak'];
$content = $_POST['tekst'];
$category = $_POST['kategorija'];   
$date=date('d.m.Y.');
if(isset($_POST['prikaz'])){
    $archive = 1;
} else {
    $archive = 0;
}

$target_dir = "img/".$picture;
move_uploaded_file($_FILES['slika']['tmp_name'], $target_dir);

$query = "INSERT INTO seminar (datum, naslov, sazetak, tekst, slika, kategorija, arhiva) VALUES ('$date', '$title', '$about', '$content', '$picture', '$category', '$archive')";

$res = mysqli_query($dbc, $query) or die("Error in query.");
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
        <!--Kod za prikaz friško upload-anog sadržaja-->
        <div class="row ">
            <div class="col-8 center1 container">
                <div>
                    <h3><?php echo $_POST['kategorija']; ?></h3>
                </div>
                <div>
                    <h1><?php echo $_POST['naslov']; ?></h1>
                </div>
                <div>
                    <p class="headerSize"><?php
                        echo "<span>" . $_POST['sazetak'] . "</span>";
                    ?></p>
                </div>
                <div>
                     <p>&bull;<?php echo $date?> </p>
                 </div>
                <div ><?php echo "<img src='img/" . $picture . "' class='image'/>";  ?></div>
                <div>
                    <p><?php echo $_POST['tekst']; ?></p>
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