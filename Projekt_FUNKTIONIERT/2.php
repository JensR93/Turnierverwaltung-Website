<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Horizontale Navigation mit Overflow</title>
    <style>
        <link rel="stylesheet" href="css/bootstrap.css">
        body {
            margin:0;
            font-family:tahoma, sans-serif;
        }

        nav {
            background:slategrey;
            width:100%;
            padding:1em 0;
            font-size: large;
            overflow-x:auto;
            -webkit-overflow-scrolling: touch;
        }


        nav ul {
            margin:0;
            list-style:none;
            padding:0;

        }

        nav li {
            float:left;
            margin: 0 1em;
        }


        nav a {
            color:white;
            text-decoration:none;
        }
        .aktuellesTurnier{

            float: inherit;

            color: white;
            font-weight: bold;
            font-size: x-large;

        }
        @media screen and (max-width:698px) {

            nav {
                box-shadow: inset -16px 0 20px -16px black;
            }

        }

    </style>
</head>

<body>
<nav>
    <ul>
        <?php
        include "Funktionen/dbspieleabfrage_neu.php";




        if(!isset($_GET['turnierid']))
        {
            // echo "<li><a href='spielklassen.php?turnierid='>Spielklassentabelle_neu</a></li>";
            echo"<li><a href=\"spielklassen.php\">Spielklassentabelle_alt</a></li>";
        }
        if(isset($_GET['turnierid']) &&$_GET['turnierid']!="" && isset($_GET['spielklasseid']) ){
            $spielklasseabfrage = "Select spielklasse.Disziplin, spielklasse.Niveau from spielklasse where spielklasse.SpielklasseID=".$_GET["spielklasseid"];
            $spielklasse = SpieleTabelleErzeugen($spielklasseabfrage,"spielklassename");

            echo"<li><a href='turnierbaum.php?turnierid=".$_GET['turnierid']."&spielklasseid=".$_GET['spielklasseid']."'>Turnierbaum</a></li>";
        }
        else
        {

        }

        echo"<li><a href=\"spieleruebersicht.php?vname=&nname=\">Spielerübersicht</a></li>
        <li><a href=\"spieluebersichtfuerspieler.php\">spieluebersichtfuerspieler</a></li>
        ";
        echo"<li><a href=\"turnieruebersicht.php\">Turniersuche</a></li>";
        if(isset($_GET['turnierid'])&&$_GET['turnierid']!="") {

            $turniernameabfrage = "Select turnier.name from turnier where turnier.TurnierID=".$_GET["turnierid"];
            $turniername = SpieleTabelleErzeugen($turniernameabfrage,"turniername");


            echo "<li><a href='spielklassen.php?turnierid=" . $_GET['turnierid'] . "'>Spielklassentabelle_neu</a></li>";
        }

        ?>
    </ul>
    <?php


    ?>
</nav>
<?php
if(isset($_GET['turnierid'])&& $_GET['turnierid']!="") {
    echo"<nav><ul><li class='aktuellesTurnier'>".$turniername["turniername"][0];
    if(isset($_GET['spielklasseid'])) {
        echo" - ".$spielklasse["spielklassename"][0];
    }
    echo"</li></ul></nav>";
}
?>
</body>
</html>
