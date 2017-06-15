<!doctype html>
<!--[if lt IE 7 ]><html class="ie ie6"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" >
<!--<![endif]-->
<head>
    <?php
    include 'Funktionen/dbspieleabfrage_neu.php';?>
    <meta charset="UTF-8">
    <title>Bracketz</title>
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
function printErgebnis($ergebnis){
    for ($j = 0; $j < (count($ergebnis)); $j++) {
        if($ergebnis[($j)]<10 && $ergebnis[($j)] != Null) {
            $ergebnis[($j)] = "0".$ergebnis[($j)];
        }
    }
    if($ergebnis[0]!=Null){
        echo $ergebnis[0];
    }
    for ($j = 1; $j < (count($ergebnis)); $j++) {
        if($ergebnis[($j)]!=Null) {
            echo " | ".$ergebnis[$j];
        }
    }
}
function rundeFuellen($erg,$j){
    $spielklasse = $_GET['spielklasse'];
    $siegerabfrage = "select spiel.SiegerID from spiel where RundenID=".$erg["rundenid"][$j]." and spiel.SpielklasseID=".$spielklasse;
    $sieger = SpieleTabelleErzeugen($siegerabfrage,"sieger");
    $ergebnisgastabfrage ="Select Satz1_gast as satz1, Satz2_gast as satz2, Satz3_gast as satz3, Satz4_gast as satz4, Satz5_gast as satz5 from spiel_ergebnis inner join spiel on spiel.SpielID=spiel_ergebnis.SpielID where RundenID=".$erg["rundenid"][$j]." and spiel.SpielklasseID=".$spielklasse." and spiel.TurnierID=".$turnierid;
    $ergebnisheimabfrage ="Select Satz1_heim as satz1, Satz2_heim as satz2, Satz3_heim as satz3, Satz4_heim as satz4, Satz5_heim as satz5 from spiel_ergebnis inner join spiel on spiel.SpielID=spiel_ergebnis.SpielID where RundenID=".$erg["rundenid"][$j]." and spiel.SpielklasseID=".$spielklasse;
    $ergebnisgast = SpieleTabelleErzeugen($ergebnisgastabfrage,"ergebnis");
    $ergebnisheim = SpieleTabelleErzeugen($ergebnisheimabfrage,"ergebnis");
    echo"<div class=\"mtch_container\"> <div class=\"match_unit\">";
    if($sieger["siegerid"] == $erg["gastid"][$j]) {
        echo "<div class=\"m_segment m_top winner";
    }
    else {
        echo "<div class=\"m_segment m_top loser";
    }
    echo"\" data-team-KompletterName=".$erg["gastid"][$j].">
		<span>
		<a href='spieluebersichtfuerspieler.php?spielerid=".$erg["gastid"][$j]."'>";
    if($erg["land_gast"][$j]!=Null){
        echo "<img src=\"imgs/flags/".$erg["land_gast"][$j].".png\" alt=\"".$erg["land_gast"][$j]."\"/>";
    }
    echo"<span>"
        .$erg["gast"][$j]."</span></a><strong>";
    printErgebnis($ergebnisgast);
    echo"</strong></span></div>";
    if($sieger["siegerid"] == $erg["gastid"][$j]) {
        echo "<div class=\"m_segment m_botm loser";
    }
    else {
        echo "<div class=\"m_segment m_botm winner";
    }
    echo"\" data-team-KompletterName=".$erg["heimid"][$j].">
		<span>
		<a href='spieluebersichtfuerspieler.php?spielerid=".$erg["heimid"][$j]."'>";
    if($erg["land_heim"][$j]!=Null){
        echo "<img src=\"imgs/flags/".$erg["land_heim"][$j].".png\" alt=\"".$erg["land_heim"][$j]."\"/>";
    }
    echo"<span>"
        .$erg["heim"][$j]."</span></a><strong>";
    printErgebnis($ergebnisheim);
    echo"</strong></span></div>";
    echo"<div class=\"m_dtls\">
								<span>June 10, 2015 - 8:00 pm</span>
							</div></div></div>";

}
function rundeFuellenFinal($erg){

    $siegerabfrage = "select spiel.SiegerID from spiel where RundenID=".$erg["rundenid"][0]." and spiel.SpielklasseID=".$_GET['spielklasse'];
    $sieger = SpieleTabelleErzeugen($siegerabfrage,"sieger");
    $ergebnisgastabfrage ="Select Satz1_gast as satz1, Satz2_gast as satz2, Satz3_gast as satz3, Satz4_gast as satz4, Satz5_gast as satz5 from spiel_ergebnis inner join spiel on spiel.SpielID=spiel_ergebnis.SpielID where RundenID=".$erg["rundenid"][0]." and spiel.SpielklasseID=".$_GET['spielklasse'];
    $ergebnisheimabfrage ="Select Satz1_heim as satz1, Satz2_heim as satz2, Satz3_heim as satz3, Satz4_heim as satz4, Satz5_heim as satz5 from spiel_ergebnis inner join spiel on spiel.SpielID=spiel_ergebnis.SpielID where RundenID=".$erg["rundenid"][0]." and spiel.SpielklasseID=".$_GET['spielklasse'];
    $ergebnisgast = SpieleTabelleErzeugen($ergebnisgastabfrage,"ergebnis");
    $ergebnisheim = SpieleTabelleErzeugen($ergebnisheimabfrage,"ergebnis");
    echo"<div class=\"mtch_container\"> <div class=\"match_unit\">";
    if($sieger["siegerid"] == $erg["gastid"][0]) {
        echo "<div class=\"m_segment m_top winner first";
    }
    else {
        echo "<div class=\"m_segment m_top loser second";
    }
    echo"\" data-team-KompletterName=".$erg["gastid"][0].">
		<span>
		<a href='spieluebersichtfuerspieler.php?spielerid=".$erg["gastid"][0]."'>";
    if($erg["land_gast"][0]!=Null){
        echo "<img src=\"imgs/flags/".$erg["land_gast"][0].".png\" alt=\"".$erg["land_gast"][0]."\"/>";
    }
    echo"<span>"
        .$erg["gast"][0]."</span></a><strong>";
    printErgebnis($ergebnisgast);
    echo"</strong></span></div>";
    if($sieger["siegerid"] == $erg["gastid"][0]) {
        echo "<div class=\"m_segment m_botm loser second";
    }
    else {
        echo "<div class=\"m_segment m_botm winner first";
    }
    echo"\" data-team-KompletterName=".$erg["heimid"][0].">
		<span>
		<a href='spieluebersichtfuerspieler.php?spielerid=".$erg["heimid"][0]."'>";
    if($erg["land_heim"][0]!=Null){
        echo "<img src=\"imgs/flags/".$erg["land_heim"][0].".png\" alt=\"".$erg["land_heim"][0]."\"/>";
    }
    echo"<span>"
        .$erg["heim"][0]."</span></a><strong>";
    printErgebnis($ergebnisheim);
    echo"</strong></span></div>";
    echo"<div class=\"m_dtls\">
								<span>June 10, 2015 - 8:00 pm</span>
							</div></div></div>";

}

function sqlAbfrage($i){

    //$spielklasseid=$_GET['spielklasse'];
    $gastabfrage = "SELECT  spieler.Nationalitaet, spieler.SpielerID, spieler.VName AS gast_vname, spieler.NName AS gast_nname, spiel.RundenID, spiel.NextSpiel, spiel.SiegerID From spieler 
    INNER JOIN spiel ON spieler.SpielerID=spiel.Gast WHERE spiel.SpielklasseID=" .$_GET['spielklasse']. " AND RundenID LIKE \"1".$i."%\"";
    $heimabfrage = "SELECT  spieler.Nationalitaet, spieler.SpielerID, spieler.VName AS heim_vname, spieler.NName AS heim_nname From spieler 
    INNER JOIN spiel ON spieler.SpielerID=spiel.Heim WHERE spiel.SpielklasseID=" .$_GET['spielklasse']. " AND RundenID LIKE \"1".$i."%\"";



    $gast = SpieleTabelleErzeugen($gastabfrage, "gast_neu");
    $heim = SpieleTabelleErzeugen($heimabfrage, "heim");

    $spielabfrage = "select spiel.RundenID,spiel.NextSpiel, spiel.SpielklasseID from spiel where RundenID LIKE \"1".$i."%\" and spiel.SpielklasseID=" .$_GET['spielklasse'];
    $spiel = SpieleTabelleErzeugen($spielabfrage, "spielabfrage");
    $erg = array_merge($spiel, $gast, $heim);

    return $erg;
}
if(isset($_GET['turnierid'])) {
$turnierid = ($_GET['turnierid']);

if (isset($_GET['spielklasse']))
{
?>
<div class="brackets_container">
    <table>
        <!--rounds container-->
        <thead>
        <tr>
            <th>
                <span>Quarter-finals</span>
            </th>
            <th>
                <span>Semi-finals</span>
            </th>
            <th>
                <span>final</span>
            </th>
            <th>
                <span>Semi-finals</span>
            </th>
            <th>
                <span>Quarter-finals</span>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr id="playground">
            <?php
            $downCounter = 5;
            for ($i = 1; $i <= 5; $i++) {
                $roundvar;
                if ($i > $downCounter) {
                    $erg = sqlAbfrage(4 - $downCounter);
                    echo "<td class=\"round_column r_";
                    echo pow(2, (4 - $downCounter)) . " reversed";
                    echo " \">";
                    for ($j = count($erg["rundenid"]) / 2; $j < (count($erg["rundenid"])); $j++) {
                        rundeFuellen($erg, $j);
                    }
                } else {
                    $erg = sqlAbfrage(4 - $i);
                    echo "<td class=\"round_column r_";
                    echo pow(2, (4 - $i));
                    if ($i == $downCounter) {
                        echo " final";
                        echo " \">";
                        rundeFuellenFinal($erg);
                    } else {
                        echo " \">";
                        for ($j = 0; $j < (count($erg["rundenid"]) / 2); $j++) {
                            rundeFuellen($erg, $j);
                        }
                    }
                }
                $downCounter--;
                echo "</td>";

                /*
                 if($i==1) {
                     echo"<td class=\"round_column r_8 \">";
                     $erg = sqlAbfrage(3);

                     for ($j = 0; $j < (count($erg["rundenid"]) /2 ); $j++) {
                         rundeFuellen($erg, $j);
                     }
                     echo "</td>";
                 }
                 if ($i == 2) {
                     $erg = sqlAbfrage(2);
                     echo"<td class=\"round_column r_4 \">";
                     for ($j = 0; $j < (count($erg["rundenid"]) / 2); $j++) {
                         rundeFuellen($erg, $j);
                     }
                     echo "</td>";
                 }
                 if ($i == 3) {
                     $erg = sqlAbfrage(1);
                     echo"<td class=\"round_column r_2 final \">";
                     for ($j = 0; $j < (count($erg["rundenid"]) / 2); $j++) {
                         rundeFuellen($erg, $j);
                     }
                     echo "</td>";
                 }
                 if ($i == 4) {
                     $erg = sqlAbfrage(2);
                     echo"<td class=\"round_column r_4 reversed \">";
                     for ($j = count($erg["rundenid"]) / 2; $j < (count($erg["rundenid"])); $j++) {
                         rundeFuellen($erg, $j);
                     }
                     echo "</td>";
                 }
                 if ($i == 5) {
                     $erg = sqlAbfrage(3);
                     echo"<td class=\"round_column r_8 reversed \">";
                     for ($j = count($erg["rundenid"]) / 2; $j < (count($erg["rundenid"])); $j++) {
                         rundeFuellen($erg, $j);
                     }
                     echo "</td>";
                }
                */


            }
            echo "</div>";
            }

            if (!isset($_GET['spielklasse'])) {
                header("Location:spielklassen.php");
            }
            }
            else
            {
                header("Location:turnieruebersicht.php");
            }
            ?></tr></tbody>
    </table>
</div>



<!--main container-->

<!-- jquery required for teams highlight-->
<script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../js/main.js">

</script>
</body>
</html>
