<?php
/**
 * Created by IntelliJ IDEA.
 * User: jens
 * Date: 09.06.2017
 * Time: 20:49
 * function Turniersuche($name)
{
include 'dblogin.php';


$pdo = new PDO('mysql:host=localhost;dbname=turnierverwaltung', $user, $pw);

//SELECT * From turnier INNER JOIN spielklasse ON turnier.TurnierID=spielklasse.SpielklasseID WHERE turnier.name=:name'
//$statement = $pdo->prepare("SELECT * FROM turnier WHERE SpielerID = :id");
//SELECT  turnier.TurnierID, turnier.MatchDauer, turnier.Datum,turnier.Name From turnier INNER JOIN spielklasse ON turnier.TurnierID=spielklasse.SpielklasseID WHERE turnier.name="tennis"
$statement = $pdo->prepare("SELECT  turnier.TurnierID, turnier.MatchDauer, turnier.Datum,turnier.Name From turnier INNER JOIN spielklasse ON turnier.TurnierID=spielklasse.SpielklasseID WHERE turnier.name=:name'");
$statement->execute(array('name' => $name));
$i=0;
echo "tets";
$ergebnis[]=$statement->fetchAll();
echo $ergebnis[0];

while ($row = $statement->fetch()) {
//echo $row[0] . " " . $row[1] . "<br />";
echo "tets---";
$ergebnis=$row[0];
echo
$i++;
}
echo $ergebnis[$row][1];
return $ergebnis;
}
 */

function TurnierIDSuche($namee)
{
    include 'dblogin.php';


    $pdo = new PDO('mysql:host=localhost;dbname=turnierverwaltung', $user, $pw);
    $berg=false;
    //$statement = $pdo->prepare("SELECT  turnier.TurnierID, turnier.MatchDauer, turnier.Datum,turnier.Name From turnier INNER JOIN spielklasse ON turnier.TurnierID=spielklasse.SpielklasseID WHERE turnier.name=:name'");

    $statement = $pdo->prepare("SELECT DISTINCT turnier.TurnierID, turnier.MatchDauer, turnier.Datum,turnier.Name, turnier.Spielklassen
  From turnier INNER JOIN spielklasse ON turnier.TurnierID=spielklasse.turnierid WHERE turnier.Name LIKE :namee");
    /*
   SELECT DISTINCT turnier.TurnierID, turnier.MatchDauer, turnier.Datum,turnier.Name From turnier
  INNER JOIN spielklasse ON turnier.TurnierID=spielklasse.turnierid WHERE turnier.Name LIKE '%t' '%'
     */

    $statement->execute(array('namee' =>'%'.$namee.'%'));
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
        //$ergebnis[]=$row[1];
        //$ergebnis[]=$row[2];


        $i++;
        $berg=true;

    }
    if(!$berg)
    {
        echo "Turnier: ".$namee." wurde nicht gefunden";

        return null;
    }
    else
    {
        return $ergebnis;
    }


}
function TurnierAllSuche()
{
    include 'dblogin.php';

        echo "kein turnier";

    $i = 0;
    $erg = [];

    $mysqli = new mysqli($localhost, $user, $pw, $db);
    if ($mysqli->connect_errno > 0) {
        die("Connection to MySQL-server failed!");
    }
    $result = mysqli_query($mysqli, "SELECT DISTINCT turnier.TurnierID, turnier.MatchDauer, turnier.Datum,turnier.Name , turnier.Spielklassen From turnier 
                                           INNER JOIN spielklasse ON turnier.TurnierID=spielklasse.turnierid");
    if (mysqli_num_rows($result) > 0)
    {
        while ($row = mysqli_fetch_assoc($result)) {
            $erg[$i][0] = $row["TurnierID"];
            $erg[$i][1] = $row["MatchDauer"];
            $erg[$i][2] = $row["Datum"];
            $erg[$i][3] = $row["Name"];
            $erg[$i][4] = $row["Spielklassen"];
            $i++;
        }
        return $erg;
    }
    return null;


}
?>