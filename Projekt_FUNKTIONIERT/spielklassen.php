<html>
<head>
    <?php

    include 'funktionen/Einfuegen.php';
    include '1.php';
    ?>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>
        body{

        }
        .allgemeinabstand{
            font-family: tahoma;
            margin: 2rem;
            font-size: large;
        }
        .allspielklasse{
            min-width: 60%;
            max-width: 90%;
            margin: 2rem;
            margin-top: 1.25rem;
            margin-right: 2rem;
            font-family: tahoma;
            font-size: large;

            border-collapse: separate;
            -webkit-border-vertical-spacing: 0.5rem;

        }
        .allspielklasse table{

            margin-bottom: 2rem;

        }
        .allspielklasse tr{
            min-width: 100%;

        }
        .allspielklasse td{

            /*max-width: 15em;*/
            border-collapse: separate;
            -webkit-border-horizontal-spacing: 0.5rem;
            white-space: nowrap;
        }
        .tdabstand{
            min-width: 0.75rem;
            text-align: center ;
        }

    </style>
</head>

<body>

<?php
if(isset($_GET['turnierid']) &&  !$_GET['turnierid']=="") {
    $turnierid=($_GET['turnierid']);





if (isset($_GET['spielklasseid'])) {
$spielklasseid = $_GET['spielklasseid'];


$joinabfrage = "SELECT  spielklasse.spielklasseid, spieler.SpielerID, spieler.VName AS gast_vname, spieler.NName AS gast_nname, spiel.Feld, time_format(spiel.AufrufZeit,\"%H:%i\") as AufrufZeit, spiel_ergebnis.Satz1_heim, spiel_ergebnis.Satz1_gast,
    spiel_ergebnis.Satz2_heim, spiel_ergebnis.Satz2_gast, spiel_ergebnis.Satz3_heim, spiel_ergebnis.Satz3_gast, spielklasse.Disziplin, 
    spielklasse.Niveau FROM spieler INNER JOIN spiel ON spieler.SpielerID=spiel.Gast INNER JOIN spiel_ergebnis ON spiel.SpielID=spiel_ergebnis.SpielID 
    INNER JOIN spielklasse on spiel.SpielklasseID=spielklasse.SpielklasseID Where spiel.SpielklasseID=" . $spielklasseid . " and spielklasse.turnierid=" . $turnierid." order by aufrufzeit";
$gastabfrage = "SELECT  spieler.SpielerID, spieler.VName AS gast_vname, spieler.NName AS gast_nname, spieler.Nationalitaet AS Nationalitaet  From spieler 
    INNER JOIN spiel ON spieler.SpielerID=spiel.Gast inner join spielklasse on spiel.spielklasseid=spielklasse.spielklasseid WHERE spiel.SpielklasseID=" . $spielklasseid . " and spielklasse.turnierid=" . $turnierid;
$heimabfrage = "SELECT  spieler.SpielerID, spieler.VName AS heim_vname, spieler.NName AS heim_nname, spieler.Nationalitaet AS Nationalitaet From spieler 
    INNER JOIN spiel ON spieler.SpielerID=spiel.Heim inner join spielklasse on spiel.spielklasseid=spielklasse.spielklasseid WHERE spiel.SpielklasseID=" . $spielklasseid . " and spielklasse.turnierid=" . $turnierid;
/*
echo "<br>".$joinabfrage;
echo "<br>".$gastabfrage;
echo "<br>".$heimabfrage;
*/
$gast = SpieleTabelleErzeugen($gastabfrage, "gast");
$heim = SpieleTabelleErzeugen($heimabfrage, "heim");
$join = SpieleTabelleErzeugen($joinabfrage, "");
$ergebnis = array_merge($gast, $heim, $join);
if ($join) {
?>


<table class="allspielklasse table-hover"  border="0"  >


    <?php


    for ($i = 0; $i < count($join["aufrufzeit"]); $i++) {
        echo "<tr>";

        echo "<td>" . $ergebnis["aufrufzeit"][$i] . "</td>";
        echo "<td><a href='spielklassen.php?turnierid= ".$_GET["turnierid"]."&spielklasseid=" .$_GET["spielklasseid"]."'>". $ergebnis["disziplinniveau"][$i] . "</td></a>";

        echo "<td class='HeimTable'>";

        echo "<a href='spieluebersichtfuerspieler.php?turnierid=" . $_GET["turnierid"] ."&spielerid=" . $ergebnis["heimid"][$i]  . "'>" . $ergebnis["heim"][$i];
        if ($ergebnis["land_heim"][$i] != Null) {
            echo "<img src=\"imgs/flags/" . $ergebnis["land_heim"][$i] . ".png\" alt=\"" . $ergebnis["land_heim"][$i] . "\"/><td class='tdabstand'>-</td> ";
        }

        echo "</td>";
        echo "<td class='GastTable'>";
        if ($ergebnis["land_gast"][$i] != Null) {
            echo "<img src=\"imgs/flags/" . $ergebnis["land_gast"][$i] . ".png\" alt=\"" . $ergebnis["land_gast"][$i] . "\"/>";
        }
        echo "<a href='spieluebersichtfuerspieler.php?spielerid=" . $ergebnis["gastid"][$i] . "&turnierid=" . $turnierid . "'>" . $ergebnis["gast"][$i];


        echo "</td>";
        echo "<td>" . $ergebnis["erg"][$i] . "</td>";
        echo "<tr>";


    }
    echo " </table><br>
        <a href='spielklassen.php?&turnierid=" . $_GET['turnierid'] . "'><div class='allgemeinabstand'> Zeige alle Spielklassen</div> </a>";
    }


    }

    if (isset($_GET['turnierid']) && !isset($_GET['spielklasseid']))
    {

        $anzahl = SpieleTabelleErzeugen("SELECT count(SpielklasseID) FROM spielklasse where spielklasse.turnierid =" . $_GET['turnierid'], "berechneanzahldurchlaeufe");
        $spielklasseidabfrage = "select turnier.name, spielklasse.Disziplin, spielklasse.Niveau, spielklasse.SpielklasseID from spielklasse inner join turnier on Spielklasse.turnierid=turnier.TurnierID where spielklasse.turnierid =" . $_GET['turnierid'];
        $spielklasse = SpieleTabelleErzeugen($spielklasseidabfrage, "spielklasseid");

        if (isset($_GET["vt"])){
            echo "<div class='allgemeinabstand'>Zeige Turnierbaum von :";
            for ($t = 0; $t < $anzahl; $t++) {
                echo "<br/><a href ='turnierbaum.php?spielklasseid=" . $spielklasse["spielklasseid"][$t] . "&turnierid=" . $_GET['turnierid'] . "'>" . $spielklasse["spielklassename"][$t] . " </a>";
            }
            echo"</div>";
        }
        else {
            echo "<div class='allgemeinabstand'>Alle Spielklassen von ".$spielklasse["turniername"][0].":";
            for ($t = 0; $t < $anzahl; $t++) {
                echo "<br/><a href ='spielklassen.php?spielklasseid=" . $spielklasse["spielklasseid"][$t] . "&turnierid=" . $_GET['turnierid'] . "'>" . $spielklasse["spielklassename"][$t] . " </a>";
            }
            echo"</div>";
        }
    }



    /*."&turnierid=".$_GET['turnierid']."'
        for ($t = 1; $t <= $anzahl; $t++) {

            $joinabfrage = "SELECT  spieler.SpielerID, spieler.VName AS gast_vname, spieler.NName AS gast_nname, spiel.Feld, spiel.AufrufZeit, spiel_ergebnis.Satz1_heim, spiel_ergebnis.Satz1_gast,
        spiel_ergebnis.Satz2_heim, spiel_ergebnis.Satz2_gast, spiel_ergebnis.Satz3_heim, spiel_ergebnis.Satz3_gast, spielklasse.Disziplin,
        spielklasse.Niveau FROM spieler INNER JOIN spiel ON spieler.SpielerID=spiel.Gast INNER JOIN spiel_ergebnis ON spiel.SpielID=spiel_ergebnis.SpielID
        INNER JOIN spielklasse on spiel.SpielklasseID=spielklasse.SpielklasseID Where spiel.SpielklasseID=" . $t;
            $gastabfrage = "SELECT  spieler.SpielerID, spieler.VName AS gast_vname, spieler.NName AS gast_nname, spieler.Nationalitaet AS Nationalitaet From spieler
        INNER JOIN spiel ON spieler.SpielerID=spiel.Gast WHERE spiel.SpielklasseID=" . $t;
            $heimabfrage = "SELECT  spieler.SpielerID, spieler.VName AS heim_vname, spieler.NName AS heim_nname, spieler.Nationalitaet AS Nationalitaet From spieler
        INNER JOIN spiel ON spieler.SpielerID=spiel.Heim WHERE spiel.SpielklasseID=" . $t;

            /*
            echo "<br>".$joinabfrage;
            echo "<br>".$gastabfrage;
            echo "<br>".$heimabfrage;

            $gast = SpieleTabelleErzeugen($gastabfrage, "gast");
            $heim = SpieleTabelleErzeugen($heimabfrage, "heim");
            $join = SpieleTabelleErzeugen($joinabfrage, "");
            $ergebnis = array_merge($gast, $heim, $join);
            if ($join) {
                echo "<a href ='spielklassen.php?spielklasseid=" . $t . "'>Spielklasse Nummer: </a>" . $t;
                <a href="#textmarke3">zum Kapitel 3</a>
                ?><!--



                --><?php
    /*        }
        }*/
}
else
{
    header("Location:turnieruebersicht.php");
}
?>
</body>
</html>