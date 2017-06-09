<?php
/**
 * Created by IntelliJ IDEA.
 * User: jens
 * Date: 09.06.2017
 * Time: 20:49
 */
function Turniersuche($name)
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
function TurnierIDSuche($name)
{
    include 'dblogin.php';


    $pdo = new PDO('mysql:host=localhost;dbname=turnierverwaltung', $user, $pw);

    //$statement = $pdo->prepare("SELECT  turnier.TurnierID, turnier.MatchDauer, turnier.Datum,turnier.Name From turnier INNER JOIN spielklasse ON turnier.TurnierID=spielklasse.SpielklasseID WHERE turnier.name=:name'");

    $statement = $pdo->prepare("SELECT  turnier.TurnierID, turnier.MatchDauer, turnier.Datum,turnier.Name From turnier INNER JOIN spielklasse ON turnier.TurnierID=spielklasse.SpielklasseID WHERE turnier.name = :name");
    $statement->execute(array('name' => $name));
    $i=0;
    while ($row = $statement->fetch()) {
        //echo $row[0] . " " . $row[1] . "<br />";
        $ergebnis[$i][]=$row[0];
        $ergebnis[$i][]=$row[1];
        $ergebnis[$i][]=$row[2];
        $ergebnis[$i][]=$row[3];
        //$ergebnis[]=$row[1];
        //$ergebnis[]=$row[2];


        $i++;
    }
    return $ergebnis;
}
?>