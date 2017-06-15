<html>
<head>
    <link rel="stylesheet" href="css/bootstrap.css">

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
include "Funktionen/dbspieleabfrage_neu.php";
    ?>
    <table border="1">
        <?php
        $turniere = SpielerIDSpielSuche();
        for ($i = 0; $i < count($turniere); $i++) {
            echo "<tr>";
            for ($j = 0; $j < (count($turniere[$i])); $j++)
            {

                if ($j==6)
                {

                    echo "<td><a href='spielklassen.php?spielklasseid=".$turniere[$i][$j]."'> " . $turniere[$i][$j]."</a></td>";
                }
                elseif($j==3 OR $j==4)
                {

                    echo "<td><a href='spieleruebersicht.php?spielerid=".$turniere[$i][$j]."'> " . $turniere[$i][$j]."</a></td>";
                }
                else {
                    echo "<td>" . $turniere[$i][$j] . "</td>";
                }
            }
            echo "</tr>";

        }
        ?>
    </table>
<?php

function SpielerIDSpielSuche()
{
    include 'Funktionen/dblogin.php';
    if(isset($_GET['spielerid'])) {
        $turnierid=$_GET['turnierid'];
        $spielerid=$_GET['spielerid'];

        $joinabfrage = "SELECT  spieler.SpielerID, spieler.VName AS gast_vname, spieler.NName AS gast_nname, spiel.Feld, spiel.AufrufZeit, spiel_ergebnis.Satz1_heim, spiel_ergebnis.Satz1_gast,
    spiel_ergebnis.Satz2_heim, spiel_ergebnis.Satz2_gast, spiel_ergebnis.Satz3_heim, spiel_ergebnis.Satz3_gast, spielklasse.Disziplin, 
    spielklasse.Niveau FROM spieler INNER JOIN spiel ON spieler.SpielerID=spiel.Gast INNER JOIN spiel_ergebnis ON spiel.SpielID=spiel_ergebnis.SpielID 
    INNER JOIN spielklasse on spiel.SpielklasseID=spielklasse.SpielklasseID Where spiel.Heim=".$spielerid." or spiel.gast=".$spielerid;
        $gastabfrage = "SELECT  spieler.SpielerID, spieler.VName AS gast_vname, spieler.NName AS gast_nname, spieler.Nationalitaet AS Nationalitaet  From spieler 
    INNER JOIN spiel ON spieler.SpielerID=spiel.Gast Where spiel.Heim=".$spielerid." or spiel.gast=".$spielerid;
        $heimabfrage = "SELECT  spieler.SpielerID, spieler.VName AS heim_vname, spieler.NName AS heim_nname, spieler.Nationalitaet AS Nationalitaet From spieler 
    INNER JOIN spiel ON spieler.SpielerID=spiel.Heim Where spiel.Heim=".$spielerid." or spiel.gast=".$spielerid;

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


            <table class="allspielklasse" border="1">
            <th>Aufrufzeit</th>
            <th>DisziplinNiveau</th>
            <th>Heim</th>
            <th>Gast</th>
            <th>Ergebnis</th>

            <?php


            for ($i = 0; $i < count($join["aufrufzeit"]); $i++) {
                echo "<tr>";

                echo "<td>" . $ergebnis["aufrufzeit"][$i] . "</td>";
                echo "<td>" . $ergebnis["disziplinniveau"][$i] . "</td>";

                echo "<td class='HeimTable'>";

                echo"<a href=spieleruebersicht.php?spielerid=" . $ergebnis["heimid"][$i] . ">" . $ergebnis["heim"][$i];
                if($ergebnis["land_heim"][$i]!=Null){
                    echo "<img src=\"imgs/flags/".$ergebnis["land_heim"][$i].".png\" alt=\"".$ergebnis["land_heim"][$i]."\"/>";
                }

                echo     "</td>";
                echo "<td class='GastTable'>";
                if($ergebnis["land_gast"][$i]!=Null){
                    echo "<img src=\"imgs/flags/".$ergebnis["land_gast"][$i].".png\" alt=\"".$ergebnis["land_gast"][$i]."\"/>";
                }
                echo"<a href=spieleruebersicht.php?spielerid=" . $ergebnis["gastid"][$i] . ">" . $ergebnis["gast"][$i];


                echo "</td>";
                echo "<td>" . $ergebnis["erg"][$i] . "</td>";
                echo "<tr>";


            }
        }

        ?>
        </table><br>
        <a href ='spielklassen.php'>Zeige alle Spielklassen </a>
        <?php
    }
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
    }*/


}
?></body>
</html>
