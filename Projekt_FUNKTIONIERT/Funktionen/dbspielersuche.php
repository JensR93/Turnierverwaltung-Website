<?php
/**
 * Created by IntelliJ IDEA.
 * User: jens
 * Date: 09.06.2017
 * Time: 20:49
 */
function SpielerSuche($vorname,$nachname)
{
    include 'dblogin.php';


    $pdo = new PDO('mysql:host=localhost;dbname=turnierverwaltung', $user, $pw);

//SELECT * FROM spieler WHERE VName LIKE '%%' AND NName LIKE '%%'

    $statement = $pdo->prepare("SELECT * FROM spieler WHERE VName LIKE :vorname And NName LIKE :nachname");
    $statement->execute(array('vorname' => '%'.$vorname.'%', 'nachname' =>  '%'.$nachname.'%'));
    //echo $statement->queryString;
    $i=0;
    while ($row = $statement->fetch()) {

        $ergebnis[$i][0]=$row[0];
        $ergebnis[$i][1]=$row[1];
        $ergebnis[$i][2]=$row[2];
        $ergebnis[$i][3]=$row[3];
        $ergebnis[$i][4]=$row[4];
        $ergebnis[$i][5]=$row[5];
        $ergebnis[$i][6]=$row[6];
        $ergebnis[$i][7]=$row[7];
        $ergebnis[$i][8]=$row[8];
        $ergebnis[$i][9]=$row[9];
        $ergebnis[$i][10]=$row[10];
        $ergebnis[$i][11]=$row[11];
        $ergebnis[$i][12]=$row[12];
        $ergebnis[$i][13]=$row[13];
        $ergebnis[$i][14]=$row[14];
        $ergebnis[$i][15]=$row[15];
        $ergebnis[$i][16]=$row[16];
        $ergebnis[$i][17]=$row[17];
        $ergebnis[$i][18]=$row[18];
        $ergebnis[$i][19]=$row[19];
        //echo $ergebnis[$i][0] . " " . $ergebnis[$i][1] . "<br />";
        $i++;
    }
    return $ergebnis;
}
function IDSuche($id)
{
    include 'dblogin.php';


    $pdo = new PDO('mysql:host=localhost;dbname=turnierverwaltung', $user, $pw);


    $statement = $pdo->prepare("SELECT * FROM spieler WHERE SpielerID = :id");
    $statement->execute(array('id' => $id));
    $i=0;
    while ($row = $statement->fetch()) {
        //echo $row[0] . " " . $row[1] . "<br />";
        $ergebnis[]=$row[0];
        $ergebnis[]=$row[1];
        $ergebnis[]=$row[2];
        $ergebnis[]=$row[3];
        $ergebnis[]=$row[4];
        $ergebnis[]=$row[5];
        $ergebnis[]=$row[6];
        $ergebnis[]=$row[7];
        $ergebnis[]=$row[8];
        $ergebnis[]=$row[9];
        $ergebnis[]=$row[10];
        $ergebnis[]=$row[11];
        $ergebnis[]=$row[12];
        $ergebnis[]=$row[13];
        $ergebnis[]=$row[14];
        $ergebnis[]=$row[15];
        $ergebnis[]=$row[16];
        $ergebnis[]=$row[17];
        $ergebnis[]=$row[18];
        $ergebnis[]=$row[19];

        $i++;
    }
    return $ergebnis;
}
?>