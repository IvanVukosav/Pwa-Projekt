<!DOCTYPE html>
<html>
<!--UNOS-->
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
    <section class="row">
        <div class="col-sm-7 mid">
            <form name="addcontent" enctype="multipart/form-data" action="skripta.php" method="POST">
                <div class="form-item">
                    <!--Unos naslova-->
                    <span id="porukaNaslov" style="color: red;"></span>
                    <label for="naslov">Naslov vijesti</label>
                    <div class="form-field">
                        <input type="text" name="naslov" id="naslov" class="formfield-textual">
                    </div>
                </div>

                <div class="form-item">
                    <!--Unos kratkog sadržaja-->
                    <span id="porukaSazetak" style="color: red;"></span>
                    <label for="sazetak">Kratki sadržaj vijesti (do 50 znakova)</label>
                    <div class="form-field">
                        <textarea name="sazetak" id="sazetak" cols="30" rows="10" class="form-field-textual"></textarea>
                    </div>
                </div>

                <div class="form-item">
                    <!--Unos sadržaja-->
                    <span id="porukaTekst" style="color: red;"></span>
                    <label for="tekst">Sadržaj vijesti</label>
                    <div class="form-field">
                        <textarea name="tekst" id="tekst" cols="30" rows="10" class="form-field-textual"></textarea>
                    </div>
                </div>

                <div class="form-item">
                    <!--Unos slike-->
                    <span id="porukaSlika" style="color: red;"></span>
                    <label for="slika">Slika: </label>
                    <div class="form-field">
                        <input accept="image/jpg,image/png" type="file" class="input-text" id="slika" name="slika" />
                    </div>
                </div>

                <div class="form-item">
                    <!--Unos kategorije-->
                    <span id="porukaKategorija" style="color: red;"></span>
                    <label for="kategorija">Kategorija:</label>
                    <div class="form-field">
                        <select name="kategorija" id="kategorija" class="form-fieldtextual">
                            <option value="" disabled selected>Odabir kategorije</option>
                            <option value="Mundo">Mundo</option>
                            <option value="Deporte">Deporte</option>
                        </select>
                    </div>
                </div>
                <!--Spremanje u arhiv-->
                <div class="form-item">
                    <label>Spremiti u arhivu:
                        <div class="form-field">
                            <input type="checkbox" name="prikaz" id="prikaz" checked>
                        </div>
                    </label>
                </div>
                <!--Poništi/Pošalji gumbi-->
                <div class="form-item">
                    <button type="reset" value="Poništi">Poništi</button>
                    <button type="submit" value="Spremi" id="submit" name="submit">Spremi</button>
                </div>
            </form>
            <script type="text/javascript">
                // Provjera forme prije slanja
                document.getElementById("submit").onclick = function (event) {

                    var slanjeForme = true;

                    // Naslov vjesti (5-30 znakova)
                    var poljeTitle = document.getElementById("naslov");
                    var title = document.getElementById("naslov").value;
                    if (title.length < 5 || title.length > 30) {
                        slanjeForme = false;
                        poljeTitle.style.border = "1px dashed red";
                        document.getElementById("porukaNaslov").innerHTML = "Naslov vjesti mora imati između 5 i 30 znakova! </br> ";
                    } else {
                        poljeTitle.style.border = "1px solid green";
                        document.getElementById("porukaNaslov").innerHTML = "";
                    }

                    // Kratki sadržaj (10-100 znakova)
                    var poljeAbout = document.getElementById("sazetak");
                    var about = document.getElementById("sazetak").value;
                    if (about.length < 10 || about.length > 100) {
                        slanjeForme = false;
                        poljeAbout.style.border = "1px dashed red";
                        document.getElementById("porukaSazetak").innerHTML = "Kratki sadržaj mora imati između 10 i 100 znakova! </br> ";
                    } else {
                        poljeAbout.style.border = "1px solid green";
                        document.getElementById("porukaSazetak").innerHTML = "";
                    }
                    // Sadržaj mora biti unesen
                    var poljeContent = document.getElementById("tekst");
                    var content = document.getElementById("tekst").value;
                    if (content.length == 0) {
                        slanjeForme = false;
                        poljeContent.style.border = "1px dashed red";
                        document.getElementById("porukaTekst").innerHTML = "Sadržaj mora biti unesen! </br> ";
                    } else {
                        poljeContent.style.border = "1px solid green";
                        10
                        document.getElementById("porukaTekst").innerHTML = "";
                    }
                    // Slika mora biti unesena
                    var poljeSlika = document.getElementById("slika");
                    var pphoto = document.getElementById("slika").value;
                    if (pphoto.length == 0) {
                        slanjeForme = false;
                        poljeSlika.style.border = "1px dashed red";
                        document.getElementById("porukaSlika").innerHTML = "Slika mora biti unesena! </br> ";
                    } else {
                        poljeSlika.style.border = "1px solid green";
                        document.getElementById("porukaSlika").innerHTML = "";
                    }
                    // Kategorija mora biti odabrana
                    var poljeCategory = document.getElementById("kategorija");
                    if (document.getElementById("kategorija").selectedIndex == 0) {
                        slanjeForme = false;
                        poljeCategory.style.border = "1px dashed red";

                        document.getElementById("porukaKategorija").innerHTML = "Kategorija mora biti odabrana! </br> ";
                    } else {
                        poljeCategory.style.border = "1px solid green";
                        document.getElementById("porukaKategorija").innerHTML = "";
                    }

                    if (slanjeForme != true) {
                        event.preventDefault();
                    }

                };
            </script>
        </div>
    </section>
            </div>
            </div>
    <div class="footerB">
    </div>
    <footer>
        <p>@Copyright EL DEBATE.Todos los derchos resevados.</p>
    </footer>
</body>

</html>