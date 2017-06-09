<?php
/**
 * Created by IntelliJ IDEA.
 * User: jens
 * Date: 09.06.2017
 * Time: 03:05
 */

function SpieleTabelleErzeugen($sql,$team)
{
    include 'dblogin.php';

    $mysqli = new mysqli($localhost, $user, $pw, $db);
    if ($mysqli->connect_errno > 0) {
        die("Connection to MySQL-server failed!");
    }

    $result = mysqli_query($mysqli, $sql);
    $i = 0;
    $erg = [];
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        if ($team == "gast") {
            while ($row = mysqli_fetch_assoc($result)) {
                // echo "vname: " . $row["gast_vname"] . " - nName: " . $row["gast_nname"] . "<br>";
                $erg[$i] = "vname: " . $row["gast_vname"] . " - nName: " . $row["gast_nname"];
                $i++;
            }
        }
        if ($team == "heim") {
            while ($row = mysqli_fetch_assoc($result)) {
                //echo "vname: " . $row["heim_vname"] . " - nName: " . $row["heim_nname"] . "<br>";
                $erg[$i] = "vname: " . $row["heim_vname"] . " - nName: " . $row["heim_nname"];
                $i++;
            }
        }
        if ($team == "join") {
            while ($row = mysqli_fetch_assoc($result)) {
                //echo "vname: " . $row["heim_vname"] . " - nName: " . $row["heim_nname"] . "<br>";
                $erg[$i] = "AufrufZeit: " . $row["AufrufZeit"] . " - DisziplinNiveau: " . $row["Disziplin"] . "-" . $row["Niveau"];
                $i++;
            }
        }
        if ($team == "erg") {
            while ($row = mysqli_fetch_assoc($result)) {
                //echo "vname: " . $row["heim_vname"] . " - nName: " . $row["heim_nname"] . "<br>";
                if($row['Satz1_heim']!=null && $row['Satz1_gast']!=null) {
                    $erg[$i] = "Ergebnis: " . "[" . $row["Satz1_heim"] . ":" . $row["Satz1_gast"]."]";
                }
                if($row['Satz2_heim']!=null && $row['Satz2_gast']!=null) {

                    $erg[$i].="[".$row["Satz2_heim"].":".$row["Satz2_gast"]. "]";
                    //[".$row["Satz3_heim"].":".$row["Satz3_gast"]."]";
                }
                if($row['Satz3_heim']!=null && $row['Satz3_gast']!=null)
                {
                    $erg[$i].="[".$row["Satz3_heim"].":".$row["Satz3_gast"]."]";
                }
                   //
                $i++;
            }
        }
    }
    return $erg;



}

?>