<!DOCTYPE html>
<?php
session_start();
include "connect.php";
if(!isset($_SESSION['logged'])){
    $_SESSION['logged'] = 0;
}
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
        <div class="col-12">
            <!--Forma za prijavu-->
            <?php
                echo '<form method="POST" enctype="multipart/form-data">
                    <label for="username">Korisničko ime:</label><br/>   
                    <input type="text" id="username" name="username"/><br/><br/>
                    <label for="lozinka">Lozinka:</label><br/>   
                    <input type="password" id="lozinka" name="lozinka"/><br/><br/>
                    <button type="submit" id="submit" name="submit">Prijava</button>
                </form>';
                if (!empty($_POST['username']) and !empty($_POST['lozinka'])){
                    $user = $_POST['username'];
                    $query = "SELECT korisnicko_ime, lozinka, razina FROM korisnik WHERE korisnicko_ime=?";
                    $stmt = mysqli_stmt_init($dbc);
                    if (mysqli_stmt_prepare($stmt, $query)){
                        mysqli_stmt_bind_param($stmt, 's', $user);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_store_result($stmt);
                    }
                    mysqli_stmt_bind_result($stmt, $user, $pass, $razina);
                    mysqli_stmt_fetch($stmt);
                    if (mysqli_stmt_num_rows($stmt) > 0){
                        if (password_verify($_POST['lozinka'], $pass)){
                            echo "Uspješan login!</br>";
                            $_SESSION['priv'] = $razina;
                            $_SESSION['user'] = $user;
                            $_SESSION['logged'] = 1;
                        } else {
                            echo "Kriva lozinka";
                        }
                    } else {
                        echo "Korisnik ne postoji. <a href='registracija.php'>Registriraj se</a>";
                    }
                }
                if ($_SESSION['logged'] == 1){
                    if ($_SESSION['priv'] != 1){
                        $usertmp = $_SESSION['user'];
                        echo "$usertmp , Niste administrator. Nemate pristup stranici.";
                    } else {
                        $query = "SELECT * FROM seminar";
                        $result = mysqli_query($dbc, $query);
                        while($row = mysqli_fetch_array($result)) {
                        /*Kod koji ispisuje formu za uređivanje ako se prijavite kao admin*/ 
                        echo '<form enctype="multipart/form-data" action="" method="POST">
                            <div>
                                <label for="naslov">Naslov:</label>
                                <div>
                                    <input type="text" name="naslov" value="'.$row['naslov'].'">
                                </div>
                            </div>
                            <div>
                                <label for="sazetak">Sažetak:</label>
                                <div>
                                    <textarea name="sazetak" id="" cols="50" rows="5">'.$row['sazetak'].'</textarea>
                                </div>
                            </div>
                            <div>
                                <label for="tekst">Sadržaj vijesti:</label>
                                <div>
                                    <textarea name="tekst" id="" cols="50" rows="5">'.$row['tekst'].'</textarea>
                                </div>
                            </div>
                            <div>
                                <label for="slika">Slika:</label>
                                <div>
                                    <input type="file" id="slika" value="'. $row['slika'].'" name="slika" /><br><img src="img/' .  $row['slika'] . '" style="width:100px;">
                                </div>
                            </div>
                            <div>
                                <label for="kategorija">Kategorija vijesti:</label>
                                <div>
                                    <select name="kategorija" id="kategorija" value="'.$row['kategorija'].'">
                                        <option value="Mundo">Mundo</option>
                                        <option value="Deporte">Deporte</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label>Spremiti u arhivu:
                                    <div>';
                                        if($row['arhiva'] == 0) {
                                        echo '<input type="checkbox" name="prikaz" id="prikaz" /> Arhiviraj?';
                                        } else {
                                        echo '<input type="checkbox" name="prikaz" id="prikaz" checked /> Arhiviraj?';
                                        }
                                        echo '</div>
                                </label>
                            </div>
                            <div>
                                <input type="hidden" name="id" value="'.$row['id'].'">
                                <button type="reset" value="Poništi">Poništi</button>
                                <button type="submit" name="update" value="Prihvati">Izmjeni</button>
                                <button type="submit" name="delete" value="Izbriši">Izbriši</button>
                            </div>
                        </form><div class="btop"></div>';
                        }
                        /*Kod za gumb delete u formi za uređivanje*/ 
                        if(isset($_POST['delete'])){
                            $id = $_POST['id'];
                            $query = "DELETE FROM seminar WHERE id=$id";
                            $res = mysqli_query($dbc, $query);
                            echo "<meta http-equiv='refresh' content='0'>";
                        }
                        /*Kod za gumb update u formi za uređivanje*/
                        if(isset($_POST['update'])){
                            $picture = $_FILES['slika']['name'];
                            $title = $_POST['naslov'];
                            $about = $_POST['sazetak'];
                            $content = $_POST['tekst'];
                            $category = $_POST['kategorija'];
                            if(isset($_POST['prikaz'])){
                                $archive = 1;
                            } else {
                                $archive = 0;
                            }
                            $target_dir = "img/".$picture;
                            move_uploaded_file($_FILES['slika']['tmp_name'], $target_dir);
                            $id = $_POST['id'];
                            $query = "UPDATE seminar SET naslov='$title', sazetak='$about', tekst='$content', slika='$picture', kategorija='$category', arhiva='$archive' WHERE id=$id";
                            $res = mysqli_query($dbc, $query);
                            echo "<meta http-equiv='refresh' content='0'>";
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