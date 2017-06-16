<?php
/**
 * Created by IntelliJ IDEA.
 * User: jens
 * Date: 09.06.2017
 * Time: 20:49
 */
function SpielerSuche($vorname,$nachname,$page)
{
    include 'dblogin.php';


    $rowsperpage=$page*10;

    $pdo = new PDO('mysql:host=localhost;dbname=turnierverwaltung', $user, $pw);

//SELECT * FROM spieler WHERE VName LIKE '%%' AND NName LIKE '%%'

    $anzahl=100;
    $start=($page-1)*$anzahl;

   /* echo "Anfang:".$start." Ende: ".$anzahl*$page;*/

    $statement = $pdo->prepare("SELECT * FROM spieler WHERE VName LIKE :vorname And NName LIKE :nachname ORDER BY SpielerID Asc LIMIT ".$start.",".$anzahl);
    $statement->execute(array('vorname' => '%'.$vorname.'%', 'nachname' =>  '%'.$nachname.'%'));
    //echo $statement->queryString;
    $i=0;
    $ergebnis=null;
    while ($row = $statement->fetch()) {

        $ergebnis[$i][0]=$row[0];
        $ergebnis[$i][1]=$row[1]." ".$row[2];
        $ergebnis[$i][2]=$row[3];
        $ergebnis[$i][3]=$row[4];
        $ergebnis[$i][4]=$row[5];
        $ergebnis[$i][5]=$row[6].":".$row[7].":".$row[8];
        $ergebnis[$i][6]=$row[9];
        $ergebnis[$i][7]=$row[10].":".$row[12];
        $ergebnis[$i][8]=$row[11];
        $ergebnis[$i][9]=$row[13].":".$row[14];
        $ergebnis[$i][10]=$row[15].":".$row[16];
        $ergebnis[$i][11]=$row[17];
        $ergebnis[$i][12]=$row[18];
        $ergebnis[$i][13]=$row[19];

        //echo $ergebnis[$i][0] . " " . $ergebnis[$i][1] . "<br />";
        $i++;
    }
    if(!$ergebnis)
    {
        echo "Die Suche war leer";
        return null;
    }
    return $ergebnis;
}
function IDSuche($id)
{
    include 'dblogin.php';


    $pdo = new PDO('mysql:host=localhost;dbname=turnierverwaltung', $user, $pw);


    $statement = $pdo->prepare("SELECT * FROM spieler WHERE SpielerID = :KompletterName");
    $statement->execute(array('KompletterName' => $id));
    $i=0;
    while ($row = $statement->fetch()) {
        //echo $row[0] . " " . $row[1] . "<br />";
        $ergebnis[]=$row[0];
        $ergebnis[]=$row[1]." ".$row[2];
        $ergebnis[]=$row[3];
        $ergebnis[]=$row[4];
        $ergebnis[]=$row[5];
        $ergebnis[]=$row[6].":".$row[7].":".$row[8];
        $ergebnis[]=$row[9];
        $ergebnis[]=$row[10].":".$row[12];
        $ergebnis[]=$row[11];
        $ergebnis[]=$row[13].":".$row[14];;
        $ergebnis[]=$row[15].":".$row[16];
        $ergebnis[]=$row[17];
        $ergebnis[]=$row[18];
        $ergebnis[]=$row[19];

/*
 *
 *         $ergebnis[$i][0]=$row[0];
        $ergebnis[$i][1]=$row[1]." ".$row[2];
        $ergebnis[$i][2]=$row[3];
        $ergebnis[$i][3]=$row[4];
        $ergebnis[$i][4]=$row[5];
        $ergebnis[$i][5]=$row[6].":".$row[7].":".$row[8];
        $ergebnis[$i][6]=$row[9];

        $ergebnis[$i][7]=$row[10].":".$row[12];
        $ergebnis[$i][8]=$row[11];
        $ergebnis[$i][9]=$row[13].":".$row[14];
        $ergebnis[$i][10]=$row[15].":".$row[16];
        $ergebnis[$i][11]=$row[17];
        $ergebnis[$i][12]=$row[18];
        $ergebnis[$i][13]=$row[19];
 *
 *
 *
 */
        $i++;
    }
    return $ergebnis;
}
?>