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
    ?>
    <table border="1">
        <th>SpielID</th><th>Aufrufzeit</th><th>Schiedsrichter</th><th>Heim</th><th>Gast</th><th>Sieger</th><th>SpielklasseID</th>
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

    if(isset($_GET['spielerid']))
    {
        $spielerid=$_GET['spielerid'];
    }
    else
    {
        echo "id nicht gefunden";
        $spielerid=1;
    }
    $pdo = new PDO('mysql:host=localhost;dbname=turnierverwaltung', $user, $pw);
    $berg=false;
    //$statement = $pdo->prepare("SELECT  turnier.TurnierID, turnier.MatchDauer, turnier.Datum,turnier.Name From turnier INNER JOIN spielklasse ON turnier.TurnierID=spielklasse.SpielklasseID WHERE turnier.name=:name'");

    $statement = $pdo->prepare("SELECT SpielID, AufrufZeit, Schiedsrichter, Heim, Gast, SiegerID, SpielklasseID FROM spiel WHERE spiel.Heim =:namee OR spiel.Gast=:name");
    /*
   SELECT DISTINCT turnier.TurnierID, turnier.MatchDauer, turnier.Datum,turnier.Name From turnier
  INNER JOIN spielklasse ON turnier.TurnierID=spielklasse.turnierid WHERE turnier.Name LIKE '%t' '%'
     */

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


}
?></body>
</html>
