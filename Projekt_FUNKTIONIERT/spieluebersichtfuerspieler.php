<html>
<head>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>
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
/**
 * Created by IntelliJ IDEA.
 * User: jens
 * Date: 11.06.2017
 * Time: 01:35
 * /SELECT SpielID, AufrufZeit, Schiedsrichter, Heim, Gast, SiegerID, SpielklasseID FROM spiel WHERE spiel.Gast = 1 OR spiel.Heim = 1

 */
include "1.php";
//include "Funktionen/dbspieleabfrage_neu.php";

if(!isset($_GET['turnierid']))
{
    //leere Turnierid
    $turnierabfrage="SELECT DISTINCT spieler.vname, spieler.nname, turnier.Name, spielklasse.TurnierID FROM spieler INNER JOIN spieler_spielklasse on spieler.SpielerID = spieler_spielklasse.SpielerID 
INNER JOIN spielklasse ON spieler_spielklasse.SpielklasseID = spielklasse.SpielklasseID inner join turnier on spielklasse.turnierid = turnier.TurnierID where spieler.spielerid=".$_GET['spielerid'];
    $turnierids=SpieleTabelleErzeugen($turnierabfrage,"turnierids");
    echo"<div class='allgemeinabstand'>Turniere mit ".$turnierids["spielername"][0].":";
    for($i=0;$i<count($turnierids["name"]);$i++){
        echo "<br/><a href='spieluebersichtfuerspieler.php?turnierid=".$turnierids["turnierids"][$i]. "&spielerid=".$_GET["spielerid"]."'>".$turnierids["name"][$i]."</a>";
    }
    echo"</div>";

}
else {
    ?>
    <table class="table-hover" border="0">
    <?php
    $turniere = SpielerIDSpielSuche();
    for ($i = 0; $i < count($turniere); $i++) {
        echo "<tr>";
        for ($j = 0; $j < (count($turniere[$i])); $j++) {


            echo "<td><a href='spieluebersichtfuerspieler.php?spielerid=" . $turniere[$i][$j] . "&spielerid=".$_GET["spielerid"]."'> " . $turniere[$i][$j] . "</a></td>";


            echo "<td>" . $turniere[$i][$j] . "</td>";

        }
        echo "</tr>";

    }
}

    echo" </table>";





function SpielerIDSpielSuche()
    {
    include 'Funktionen/dblogin.php';
    if (isset($_GET['spielerid'])) {


    $turnierid = $_GET['turnierid'];
    $spielerid = $_GET['spielerid'];

    $joinabfrage = "SELECT  spielklasse.SpielklasseID,spieler.SpielerID, spieler.VName AS gast_vname, spieler.NName AS gast_nname, spiel.Feld, time_format(spiel.AufrufZeit,\"%H:%i\") as AufrufZeit, spiel_ergebnis.Satz1_heim, spiel_ergebnis.Satz1_gast,
            spiel_ergebnis.Satz2_heim, spiel_ergebnis.Satz2_gast, spiel_ergebnis.Satz3_heim, spiel_ergebnis.Satz3_gast, spielklasse.Disziplin,
            spielklasse.Niveau FROM spieler INNER JOIN spiel ON spieler.SpielerID=spiel.Gast INNER JOIN spiel_ergebnis ON spiel.SpielID=spiel_ergebnis.SpielID
            INNER JOIN spielklasse on spiel.SpielklasseID=spielklasse.SpielklasseID Where (spiel.Heim=" . $spielerid . " or spiel.gast=" . $spielerid . ") and spielklasse.turnierID=" . $_GET['turnierid'] . " order by aufrufzeit";
    $gastabfrage = "SELECT  spieler.SpielerID, spieler.VName AS gast_vname, spieler.NName AS gast_nname, spieler.Nationalitaet AS Nationalitaet  From spieler
            INNER JOIN spiel ON spieler.SpielerID=spiel.Gast inner join spielklasse on spiel.SpielklasseID=spielklasse.SpielklasseID Where (spiel.Heim=" . $spielerid . " or spiel.gast=" . $spielerid . ") and spielklasse.turnierID=" . $_GET['turnierid'];
    $heimabfrage = "SELECT  spieler.SpielerID, spieler.VName AS heim_vname, spieler.NName AS heim_nname, spieler.Nationalitaet AS Nationalitaet From spieler
            INNER JOIN spiel ON spieler.SpielerID=spiel.Heim inner join spielklasse on spiel.SpielklasseID=spielklasse.SpielklasseID Where (spiel.Heim=" . $spielerid . " or spiel.gast=" . $spielerid . ") and spielklasse.turnierID=" . $_GET['turnierid'];
    // $namenabfrage = "Select spieler.vname, spieler.nname"



    $gast = SpieleTabelleErzeugen($gastabfrage, "gast");
    $heim = SpieleTabelleErzeugen($heimabfrage, "heim");
    $join = SpieleTabelleErzeugen($joinabfrage, "");

    $ergebnis = array_merge($gast, $heim, $join);
    echo "<div class='allgemeinabstand'>Alle Spiele von ";
    if ($ergebnis["heimid"][0] == $spielerid) {
        echo $ergebnis["heim"][0] . ":";
    }
    if ($ergebnis["gastid"][0] == $spielerid) {
        echo $ergebnis["gast"][0] . ":";
    }
    echo "</div>";

    if ($join) {
    ?>


        <table class="allspielklasse table-hover" border="0">

<?php


for ($i = 0; $i < count($join["aufrufzeit"]); $i++) {


    echo "<tr>";

    echo "<td>" . $ergebnis["aufrufzeit"][$i] . "</td>";
    echo "<td> " . $ergebnis["disziplinniveau"][$i] . "</td>";
    echo "<td><a href='spielklassen.php?turnierid= ".$_GET["turnierid"]."&spielklasseid=" .$ergebnis["spielklasseid"][$i]."'>". $ergebnis["disziplinniveau"][$i] . "</td></a>";

    echo "<td class='HeimTable'>";

    echo "<a href='spieluebersichtfuerspieler.php?spielerid=" . $ergebnis["heimid"][$i] . "&turnierid=" . $_GET['turnierid'] . "'>" . $ergebnis["heim"][$i];
    if ($ergebnis["land_heim"][$i] != Null) {
        echo "<img src=\"imgs/flags/" . $ergebnis["land_heim"][$i] . ".png\" alt=\"" . $ergebnis["land_heim"][$i] . "\"/>";
    }

    echo "</td>";
    echo "<td class='tdabstand'> - </td>";
    echo "<td class='GastTable'>";
    if ($ergebnis["land_gast"][$i] != Null) {
        echo "<img src=\"imgs/flags/" . $ergebnis["land_gast"][$i] . ".png\" alt=\"" . $ergebnis["land_gast"][$i] . "\"/>";
    }
    echo "<a href='spieluebersichtfuerspieler.php?spielerid=" . $ergebnis["gastid"][$i] . "&turnierid=" . $_GET['turnierid'] . "'>" . $ergebnis["gast"][$i];


    echo "</td>";
    echo "<td>" . $ergebnis["erg"][$i] . "</td>";
    echo "<tr>";


}
}


echo "</table><br>
        <a href ='spielklassen.php?turnierid=" . $_GET['turnierid'] . "'><div class='allgemeinabstand'>Zeige alle Spielklassen</div></a>";


/* if(isset($_GET['spielerid']))
 {
     $spielerid=$_GET['spielerid'];
 }
 else
 {
     echo "KompletterName nicht gefunden";
     $spielerid=1;
 }
 $pdo = new PDO('mysql:host=localhost;dbname=turnierverwaltung', $user, $pw);
 $berg=false;
 //$statement = $pdo->prepare("SELECT  turnier.TurnierID, turnier.MatchDauer, turnier.Datum,turnier.Name From turnier INNER JOIN spielklasse ON turnier.TurnierID=spielklasse.SpielklasseID WHERE turnier.name=:name'");

 $statement = $pdo->prepare("SELECT SpielID, AufrufZeit, Schiedsrichter, Heim, Gast, SiegerID, SpielklasseID FROM spiel WHERE spiel.Heim =:namee OR spiel.Gast=:name");

SELECT DISTINCT turnier.TurnierID, turnier.MatchDauer, turnier.Datum,turnier.Name From turnier
INNER JOIN spielklasse ON turnier.TurnierID=spielklasse.turnierid WHERE turnier.Name LIKE '%t' '%'


 $statement->execute(array('namee' =>$spielerid,'name' =>$spielerid));
 $i=0;
 //echo $statement->queryString."<br>";
 while ($row = $statement->fetch())
 {
     //echo $row[0] . " " . $row[1] . "<br />";
     $ergebnis[$i][]=$row[0];
     $ergebnis[$i][]=$row[1];
     $ergebnis[$i][]=$row[2];
     $ergebnis[$i][]=$row[3];
     $ergebnis[$i][]=$row[4];
     $ergebnis[$i][]=$row[5];
     $ergebnis[$i][]=$row[6];

     //$ergebnis[]=$row[1];
     //$ergebnis[]=$row[2];


     $i++;
     $berg=true;

 }
 if(!$berg)
 {
     echo "Spiel mit : ".$namee." wurde nicht gefunden";

     return null;
 }
 else
 {
     return $ergebnis;
 }


}*/
}
}
?></body>
</html>
