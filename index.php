
<!DOCTYPE html>
<?php
    include "connect.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style1.css"/>
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
                                <li><a href="#">HOME</a></li>
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
        <h5 class="headerBold">MUNDO</h5>
   
        <section class="row">
                <!--Dohvat sadržaja iz baze kategorije Mundo-->
                <?php
                    $query = "SELECT * FROM seminar WHERE arhiva=1 AND kategorija='Mundo' LIMIT 4";
                    $res = mysqli_query($dbc, $query);
                    while ($row = mysqli_fetch_array($res)){
                        echo "<div class='col-3 '>";
                            echo "<div>";
                                echo "<img class='imgWidth' src='img/" . $row['slika'] . "' style='width:75%; height:auto;'/>";
                            echo "</div>";
                            echo "<div>";
                                echo "<h5>";
                                    echo "<br/>"."<a href='clanak.php?id=" . $row['id']."'>";/*minijaturni prikaz, prikaži samo 25 znakova, na većem sve*/
                                        echo substr($row['naslov'], 0, 25);
                                echo "</a></h5>";

                                echo "<h3>";
                                echo "<p href='clanak.php?id=" . $row['id']."'>";
                                    echo substr($row['sazetak'], 0, 35)."<br/>";
                            echo "</p></h3>";

                                echo "<div>";
                                    echo "<p class='test' href='clanak.php?id=" . $row['id']."'>";
                                        echo substr($row['tekst'], 0, 100)."<br/>";
                                echo "</p></div>";
                        echo "</div></div>";
                    }?>
            </section>
       <p class="line">__________________________________________________________________________________________________________________________________________________________</p>

        <h5 class="headerBold">DEPORTE</h5>
     
         <section class="row">
         <?php
                    $query = "SELECT * FROM seminar WHERE arhiva=1 AND kategorija='Deporte' LIMIT 4";
                    $res = mysqli_query($dbc, $query);
                    while ($row = mysqli_fetch_array($res)){
                        echo "<div class='col-3 mx-auto'>";
                            echo "<div>";
                                echo "<img  class='imgWidth' src='img/" . $row['slika'] . "' style='width:75%; height:auto;'/>";
                            echo "</div>";
                            echo "<div>";
                                echo "<h5>";
                                    echo "<br/>"."<a href='clanak.php?id=" . $row['id']."'>";
                                        echo substr($row['naslov'], 0, 30);
                                echo "</a></h5>";

                                echo "<h3>";
                                echo "<p href='clanak.php?id=" . $row['id']."'>";
                                    echo substr($row['sazetak'], 0, 13)."<br/>";
                                    echo substr($row['sazetak'], 15, 17)."<br/>";
                            echo "</p></h3>";

                                echo "<div>";
                                    echo "<p href='clanak.php?id=" . $row['id']."'>";
                                        echo substr($row['tekst'], 0, 30);
                                echo "</p></div>";
                        echo "</div></div>";
                    }?>
        </section>
        <hr>
    </div>
    <div class="footerB">
    </div>
    <footer>
        <p>@Copyright EL DEBATE.Todos los derchos resevados.</p>
    </footer>
</body>
</html>