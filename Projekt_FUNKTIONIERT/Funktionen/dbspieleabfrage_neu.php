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



    $i = 0;
    $erg = [];

    $mysqli = new mysqli($localhost, $user, $pw, $db);
    if ($mysqli->connect_errno > 0) {
        die("Connection to MySQL-server failed!");
    }

// Platzhalter müssen anstelle des ganzen Wertes verwendet werden

        /*}
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ss", $v, $l);*/


    $result = mysqli_query($mysqli, $sql);





    if (mysqli_num_rows($result) > 0) {
        // output data of each row



        if ($team == "spieler") {

            while ($row = mysqli_fetch_assoc($result)) {
                //echo "vname: " . $row["heim_vname"] . " - nName: " . $row["heim_nname"] . "<br>";
                $erg[$i][0] = $row["SpielerID"];
                $erg[$i][1] = $row["VName"];
                $erg[$i][2] = $row["NName"];
                $erg[$i][3] = $row["GDatum"];
                $erg[$i][4] = $row["Geschlecht"];
                $erg[$i][5] = $row["Verein"];
                $erg[$i][6] = $row["RLP_Einzel"];
                $erg[$i][7] = $row["RLP_Doppel"];
                $erg[$i][8] = $row["RLP_Mixed"];
                $erg[$i][9] = $row["MeldeGebuehren"];
                $erg[$i][10] = $row["AnzahlSiege"];
                $erg[$i][11] = $row["Nationalitaet"];
                $erg[$i][12] = $row["AnzahlNiederlagen"];
                $erg[$i][13] = $row["GewonneneSaetze"];
                $erg[$i][14] = $row["VerloreneSaetze"];
                $erg[$i][15] = $row["ErspieltePunkte"];
                $erg[$i][16] = $row["ZugelassenePunkte"];
                $erg[$i][17] = $row["Verfuegbar"];
                $erg[$i][18] = $row["ExtSpielerID"];
                $erg[$i][19] = $row["AktuellesSpiel"];

                //$erg["Vname"][$i] = $row["Vname"];

                $i++;
            }
        }
        if($team=="spielabfrage")
        {
            while ($row = mysqli_fetch_assoc($result))
            {
                $erg["rundenid"][$i] = $row["RundenID"];
                $erg["nextspiel"][$i] = $row["NextSpiel"];
                /*$erg["SpielklasseID"][$i] = $row["SpielklasseID"];*/
                $i++;
            }
            //$erg["rundenid"][$i]="ABBRUCH";

        }
        if($team=="anzahlspielabfrage")
        {
            while ($row = mysqli_fetch_assoc($result)) {
                $erg["count(spiel.SpielID)"];
                $i++;
            }

        }
        if ($team == "gast") {
            while ($row = mysqli_fetch_assoc($result)) {
                // echo "vname: " . $row["gast_vname"] . " - nName: " . $row["gast_nname"] . "<br>";
                $erg["gast"][$i] = $row["gast_vname"] ." ". $row["gast_nname"];
                $erg["gastid"][$i] = $row["SpielerID"];
                $erg["land_gast"][$i] = $row["Nationalitaet"];
                $i++;
            }

        }
        if ($team == "sieger") {
            while ($row = mysqli_fetch_assoc($result)) {
                // echo "vname: " . $row["gast_vname"] . " - nName: " . $row["gast_nname"] . "<br>";
                $erg["siegerid"] = $row["SiegerID"];
            }
        }
        if ($team == "ergebnis") {
            while ($row = mysqli_fetch_assoc($result)) {
                $erg[0] = $row["satz1"];
                $erg[1] = $row["satz2"];
                $erg[2] = $row["satz3"];
                $erg[3] = $row["satz4"];
                $erg[4] = $row["satz5"];


            }
        }
        if ($team == "gast_neu") {
            while ($row = mysqli_fetch_assoc($result)) {
                // echo "vname: " . $row["gast_vname"] . " - nName: " . $row["gast_nname"] . "<br>";
                $erg["gast"][$i] = $row["gast_vname"] ." ". $row["gast_nname"];
                $erg["gastid"][$i] = $row["SpielerID"];
                $erg["siegerid"][$i] = $row["SiegerID"];
                $erg["land_gast"][$i] = $row["Nationalitaet"];
/*                $erg["rundenid"][$i] = $row["RundenID"];
                $erg["nextspiel"][$i] = $row["NextSpiel"];*/
                $i++;
            }
        }
        if ($team == "heim") {
            while ($row = mysqli_fetch_assoc($result)) {
                //echo "vname: " . $row["heim_vname"] . " - nName: " . $row["heim_nname"] . "<br>";
                $erg["heim"][$i] = $row["heim_vname"] ." ". $row["heim_nname"];
                $erg["heimid"][$i] = $row["SpielerID"];
                $erg["land_heim"][$i] = $row["Nationalitaet"];

                $i++;
            }
        }
        if ($team == "berechneanzahldurchlaeufe") {
            while ($row = mysqli_fetch_assoc($result)) {
                //echo "vname: " . $row["heim_vname"] . " - nName: " . $row["heim_nname"] . "<br>";
               return $row["count(SpielklasseID)"];
            }
        }

        if ($team == "") {
            while ($row = mysqli_fetch_assoc($result)) {
                //echo "vname: " . $row["heim_vname"] . " - nName: " . $row["heim_nname"] . "<br>";
                $erg["aufrufzeit"][$i] = $row["AufrufZeit"];
                $erg["disziplinniveau"][$i] = $row["Disziplin"] . "-" . $row["Niveau"];
                for ($j=1; $j<=3;$j++){
                    if($row["Satz".$j."_heim"]!=null && $row["Satz".$j."_heim"]<10) {
                        $row["Satz".$j."_heim"] = "0".$row["Satz".$j."_heim"];
                    }
                    if($row["Satz".$j."_gast"]!=null && $row["Satz".$j."_gast"]<10) {
                        $row["Satz".$j."_gast"] = "0".$row["Satz".$j."_gast"];
                    }
                }



                if($row['Satz1_heim']!=null && $row['Satz1_gast']!=null) {
                    $erg["erg"][$i] = "[" . $row["Satz1_heim"] . ":" . $row["Satz1_gast"]."]";
                }
                if($row['Satz2_heim']!=null && $row['Satz2_gast']!=null) {

                    $erg["erg"][$i].="[".$row["Satz2_heim"].":".$row["Satz2_gast"]. "]";
                    //[".$row["Satz3_heim"].":".$row["Satz3_gast"]."]";
                }
                if($row['Satz3_heim']!=null && $row['Satz3_gast']!=null)
                {
                    $erg["erg"][$i].="[".$row["Satz3_heim"].":".$row["Satz3_gast"]."]";
                }
                $i++;
            }
        }
        if($team=="spielklasseid")
        {
            while ($row = mysqli_fetch_assoc($result))
            {
                $erg["spielklasseid"][$i]=$row["SpielklasseID"][$i];
                $erg["spielklassename"][$i]=$row["Disziplin"] . "-" . $row["Niveau"];
                $i++;
            }

        }


    }

    return $erg;



}

?>