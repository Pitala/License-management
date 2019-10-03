<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to index page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

require_once "config.php";
?>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Main</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS: You can use this stylesheet to override any Bootstrap styles and/or apply your own styles -->
    <link href="css/custom.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>

    <!-- Navigation -->
    <nav id="siteNav" class="navbar navbar-default navbar-fixed-top" role="navigation" >
            <div class="navcontainer"  >
                <!-- Logo and responsive toggle -->
                <div class="navbar-header" >
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php" >
                        <span class="glyphicon glyphicon-fire"></span>
                        license-management
                    </a>
                </div>
            </div><!-- /.container -->
    </nav>


	<!-- Header -->
    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h2>
                <a href="reset-password.php" class="btn btn-default">Password reset</a>
                <a href="logout.php" class="btn btn-default">Logout</a> </h2>
                <h2>Wilkommen <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>!</h2>

                <div class="header-content-inner-tab1">
                <script>
                $( function() {
                  $( "#tabs" ).tabs();
                } );
                </script>


                <div id="tabs">
                  <div class = "tabs-header">
                  <ul>
                    <li><a href="#tabs-1">Lizenzen</a></li>
                    <li><a href="#tabs-2">Produkte</a></li>
                    <li><a href="#tabs-3">Firmen</a></li>
                  </ul>
                </div>

                  <div id="tabs-1">

                  <?php
                    $result = mysqli_query($link,"SELECT l.idlizenzen, f.name, p.produktname, l.anzahl, l.ablaufdatum FROM lizenzen l
                                                  JOIN firmen f ON  l.firma = f.idfirmen
                                                  JOIN produkte p ON l.produkt = p.idprodukte
                                                  GROUP BY l.idlizenzen;");
                    echo "<table border='2'>
                    <tr>
                    <th>&nbspIDlizenzen&nbsp</th>
                    <th>&nbspFirma&nbsp</th>
                    <th>&nbspProdukt&nbsp</th>
                    <th>&nbspAnzahl&nbsp</th>
                    <th>&nbspAblaufdatum&nbsp</th>
                    </tr>";

                    while($row = mysqli_fetch_array($result))
                    {
                      echo "<tr>";
                      echo "<td>" . $row['idlizenzen'] . "</td>";
                      echo "<td>" . $row['name'] . "</td>";
                      echo "<td>" . $row['produktname'] . "</td>";
                      echo "<td>" . $row['anzahl'] . "</td>";
                      echo "<td>" . $row['ablaufdatum'] . "</td>";
                      echo "</tr>";
                    }
                    echo "</table>";
                  ?>
                  </div>
                  <div id="tabs-2">
                    <?php
                    $result = mysqli_query($link,"SELECT p.idprodukte, f.name, p.produktname, p.stueckpreis FROM produkte p
                                                  JOIN firmen f ON p.firma = f.idfirmen
                                                  GROUP BY p.idprodukte;");
                    echo "<table border='2'>
                    <tr>
                    <th>&nbspIDprodukte&nbsp</th>
                    <th>&nbspFirma&nbsp</th>
                    <th>&nbspProdukt&nbsp</th>
                    <th>&nbspStückpreis&nbsp</th>
                    </tr>";

                    while($row = mysqli_fetch_array($result))
                    {
                      echo "<tr>";
                      echo "<td>" . $row['idprodukte'] . "</td>";
                      echo "<td>" . $row['name'] . "</td>";
                      echo "<td>" . $row['produktname'] . "</td>";
                      echo "<td>" . $row['stueckpreis'] . "</td>";
                      echo "</tr>";
                    }
                    echo "</table>";
                    ?>
                    </div>
                  <div id="tabs-3">
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM firmen GROUP BY idfirmen;");
                    echo "<table border='2'>
                    <tr>
                    <th>&nbspIDfirmen&nbsp</th>
                    <th>&nbspName&nbsp</th>
                    <th>&nbspAnsp. Vorname&nbsp</th>
                    <th>&nbspAnsp. Nachname&nbsp</th>
                    <th>&nbspAnsp. Telefonnummer&nbsp</th>
                    <th>&nbspAnsp. Email&nbsp</th>
                    </tr>";

                    while($row = mysqli_fetch_array($result))
                    {
                      echo "<tr>";
                      echo "<td>" . $row['idfirmen'] . "</td>";
                      echo "<td>" . $row['name'] . "</td>";
                      echo "<td>" . $row['ansvname'] . "</td>";
                      echo "<td>" . $row['ansnname'] . "</td>";
                      echo "<td>" . $row['anstel'] . "</td>";
                      echo "<td>" . $row['ansemail'] . "</td>";
                      echo "</tr>";
                    }
                    echo "</table>";
                    ?>


                  </div>

                </div>
              </div>

              <div class="header-content-inner-tab2">

                <script>
                $( function() {
                  $( "#eindel" ).tabs();
                } );
                </script>


                <div id="eindel">
                <div class"tabs2-header">
                <ul>
                  <li><a href="#eindel1">Einfügen</a></li>
                  <li><a href="#eindel2">Suchen</a></li>
                </ul>
                </div>

                  <div id="eindel1">
                    <div class="header-content-inner-text-tab2">

                  <form action="" method="post">
                    <label>Firma</label>
                    <input type="text" name="firma" required="required" placeholder="Firma *"><br>
                    <label>Produkt</label>
                    <input type="text" name="produkt" required="required" placeholder="Produkt *"><br>
                    <label>Anzahl</label>
                    <input type="text" name="anzahl" required="required" placeholder="Anzahl *"><br>
                    <label>Stückpreis</label>
                    <input type="text" name="stueckpreis" required="required" placeholder="Stückpreis *"><br>
                    <label>Ablaufdatum (YYYY-MM-DD)</label>
                    <input type="text" name="ablaufdatum" required="required" placeholder="YYYY-MM-DD *"><br>
                    <label>Ansprechperson Vorname</label>
                    <input type="text" name="vorname" placeholder="Vorname"><br>
                    <label>Ansprechperson Nachname</label>
                    <input type="text" name="nachname" placeholder="Nachname"><br>
                    <label>Ansprechperson Telefonnummer</label>
                    <input type="text" name="telefonnummer" placeholder="Telefonnummer"><br>
                    <label>Ansprechperson Email</label>
                    <input type="text" name="email" placeholder="Email"><br>

                    <div class = "header-content-inner-text-ende"> * Muss ausgefüllt werden!</div>
                    <input class="btn btn-default-submit" type="submit" name="submit" value="Einfügen">
                  </form>
                  </div>
                  <?php

                  if(isset($_POST['submit']))
                  {
                    $firma = $_POST['firma'];
                    $vorname = $_POST['vorname'];
                    $nachname = $_POST['nachname'];
                    $telefon = $_POST['telefonnummer'];
                    $email = $_POST['email'];
                    $produkt = $_POST['produkt'];
                    $preis = $_POST['stueckpreis'];
                    $anzahl = $_POST['anzahl'];
                    $ablaufdatum = $_POST['ablaufdatum'];

                    $daten = mysqli_query($link, "SELECT name FROM firmen where name = '$firma'");
                    $result = mysqli_fetch_array($daten);
                    if($result['name']==$firma)
                    {
                        //Nur Eine Ansprechperson pro Firma!!!
                    }
                    else {
                      $sql = "INSERT INTO firmen (name, ansvname, ansnname, anstel, ansemail) VALUES
                            ('$firma', '$vorname', '$nachname', '$telefon', '$email');";
                      mysqli_query($link, $sql);
                    }

                    mysqli_query($link, "INSERT INTO produkte (firma, produktname, stueckpreis) VALUES ( (SELECT idfirmen from firmen where name = '$firma'),'$produkt', '$preis');");
                    //Foreign key = firma --- Primary key = idfirmen

                    mysqli_query($link, "INSERT INTO lizenzen (firma, produkt, anzahl, ablaufdatum) VALUES ((SELECT idfirmen from firmen where name = '$firma'),
                                                                                                            (SELECT idprodukte from produkte where produktname= '$produkt'), '$anzahl', '$ablaufdatum');");

                  mysqli_close($link);
                  echo "<meta http-equiv='refresh' content='0'>";
                  //Refreshed die Seite

                  }

                   ?>


                  </div>
                  <div id="eindel2">
                    <div class="header-content-inner-text-tab2">

                      <form action="" method="post">
                          <input type="text" placeholder= "Firma" name="firma">
                          <input type="submit" class="btn btn-default-submit" name="submit1" value="Suchen">&nbsp;nach Firma<br><br>
                          <input type="text" placeholder= "Produkt" name="produkt">
                          <input type="submit" class="btn btn-default-submit" name="submit2" value="Suchen">&nbsp;nach Produkt
                      </form>
                    </div>
                      <?php

                      if(isset($_POST['submit1']))
                      {

                        $searchvar=$_POST['firma'];
                        $sql="SELECT * FROM firmen where name like '%$searchvar%' GROUP BY idfirmen";
                        $result=mysqli_query($link, $sql);

                        if (mysqli_num_rows($result) > 0) {

                          echo "<table border='2'>
                          <tr>
                          <th>&nbspIDfirmen&nbsp</th>
                          <th>&nbspName&nbsp</th>
                          <th>&nbspAnsp. Vorname&nbsp</th>
                          <th>&nbspAnsp. Nachname&nbsp</th>
                          <th>&nbspAnsp. Telefonnummer&nbsp</th>
                          <th>&nbspAnsp. Email&nbsp</th>
                          </tr>";


                            while($row = mysqli_fetch_array($result))
                            {
                              echo "<tr>";
                              echo "<td>" . $row['idfirmen'] . "</td>";
                              echo "<td>" . $row['name'] . "</td>";
                              echo "<td>" . $row['ansvname'] . "</td>";
                              echo "<td>" . $row['ansnname'] . "</td>";
                              echo "<td>" . $row['anstel'] . "</td>";
                              echo "<td>" . $row['ansemail'] . "</td>";
                              echo "</tr>";
                            }
                            echo "</table>";

                        }
                        else
                        {
                          echo "Keine Suchergebnisse!";
                        }
                        //mysqli_close($link);
                        //echo "<meta http-equiv='refresh' content='0'>";
                        //Refreshed die Seite
                      }

                      if(isset($_POST['submit2']))
                      {

                        $searchvar2=$_POST['produkt'];
                        $sql2="SELECT p.idprodukte, f.name, p.produktname, p.stueckpreis FROM produkte p
                               JOIN firmen f ON p.firma = f.idfirmen WHERE p.produktname like '%$searchvar2%' GROUP BY p.idprodukte";

                        $result2=mysqli_query($link, $sql2);

                        if (mysqli_num_rows($result2) > 0) {

                          echo "<table border='2'>
                          <tr>
                          <th>&nbspIDprodukte&nbsp</th>
                          <th>&nbspFirma&nbsp</th>
                          <th>&nbspProdukt&nbsp</th>
                          <th>&nbspStückpreis&nbsp</th>
                          </tr>";


                            while($row2 = mysqli_fetch_array($result2))
                            {
                              echo "<tr>";
                              echo "<td>" . $row2['idprodukte'] . "</td>";
                              echo "<td>" . $row2['name'] . "</td>";
                              echo "<td>" . $row2['produktname'] . "</td>";
                              echo "<td>" . $row2['stueckpreis'] . "</td>";
                              echo "</tr>";
                            }
                            echo "</table>";

                        }
                        else
                        {
                          echo "Keine Suchergebnisse!";
                        }

                        //mysqli_close($link);
                        //echo "<meta http-equiv='refresh' content='0'>";
                        //Refreshed die Seite
                      }

                      ?>

                 </div>

                </div>
              </div>

            </div>
         </div>
    </header>
</html>
