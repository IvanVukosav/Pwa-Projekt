<!DOCTYPE html>
<html>
<?php
include "connect.php";
?>

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
        <!--Forma za registraciju korisnika-->
        <div class="col-12">
            <form method="POST" enctype="multipart/form-data">
                <label for="username">Korisničko ime:</label><br />
                <input type="text" id="username" name="username" /><br /><br />
                <label for="ime">Ime:</label><br />
                <input type="text" id="ime" name="ime" /><br /><br />
                <label for="prezime">Prezime:</label><br />
                <input type="text" id="prezime" name="prezime" /><br /><br />
                <label for="lozinka">Lozinka:</label><br />
                <input type="password" id="lozinka" name="lozinka" /><br /><br />
                <label for="lozinka1">Ponovite lozinku:</label><br />
                <input type="password" id="lozinka1" name="lozinka1" /><br /><br />
                <button type="submit" id="submit" name="submit">Registriraj se</button>
            </form>
            <?php
            /*Kod koji sprema podatke iz forme u bazu, lozinka se hashira*/
        if (isset($_POST['submit']) and !empty($_POST['username']) and !empty($_POST['ime']) and !empty($_POST['prezime']) and !empty($_POST['lozinka']) and !empty($_POST['lozinka1'])){
            if ($_POST['lozinka1'] != $_POST['lozinka']){
                echo "<br/><br/>Lozinke nisu iste!<br/>";
            } else {
                $user = $_POST['username'];
                $ime = $_POST['ime'];
                $prez = $_POST['prezime'];
                $hash = password_hash($_POST['lozinka'], CRYPT_BLOWFISH);
                $query = "SELECT * FROM korisnik WHERE korisnicko_ime=?";
                $stmt = mysqli_stmt_init($dbc);
                if (mysqli_stmt_prepare($stmt, $query)){
                    mysqli_stmt_bind_param($stmt, 's', $user);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                }
                if (mysqli_stmt_num_rows($stmt) > 0){
                    echo "Korisnik s tim korisničkim imenom već postoji!";
                } else {
                    $query = "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka) VALUES (?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($dbc);
                    if (mysqli_stmt_prepare($stmt, $query)){
                        mysqli_stmt_bind_param($stmt, 'ssss', $ime, $prez, $user, $hash);
                        mysqli_stmt_execute($stmt);
                    }
                }
            }
        }
        ?>
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