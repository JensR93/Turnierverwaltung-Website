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


    ?>

    <meta charset="UTF-8">
    <title>Bracketz</title>
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <?php
    include '1.php'?>
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
    $spielklasse = $_GET['spielklasseid'];
    $siegerabfrage = "select spiel.SiegerID from spiel Inner join spielklasse on spiel.spielklasseid=spielklasse.spielklasseid where RundenID=".$erg["rundenid"][$j]." and spiel.SpielklasseID=".$spielklasse." and spielklasse.turnierID=".$_GET['turnierid'];
    $sieger = SpieleTabelleErzeugen($siegerabfrage,"sieger");
    $ergebnisgastabfrage ="Select Satz1_gast as satz1, Satz2_gast as satz2, Satz3_gast as satz3, Satz4_gast as satz4, Satz5_gast as satz5 from spiel_ergebnis inner join spiel on spiel.SpielID=spiel_ergebnis.SpielID Inner join spielklasse on spiel.spielklasseid=spielklasse.spielklasseid where RundenID=".$erg["rundenid"][$j]." and spiel.SpielklasseID=".$spielklasse." and spielklasse.turnierID=".$_GET['turnierid'];
    $ergebnisheimabfrage ="Select Satz1_heim as satz1, Satz2_heim as satz2, Satz3_heim as satz3, Satz4_heim as satz4, Satz5_heim as satz5 from spiel_ergebnis inner join spiel on spiel.SpielID=spiel_ergebnis.SpielID Inner join spielklasse on spiel.spielklasseid=spielklasse.spielklasseid where RundenID=".$erg["rundenid"][$j]." and spiel.SpielklasseID=".$spielklasse." and spielklasse.turnierID=".$_GET['turnierid'];
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
		<a href='spieluebersichtfuerspieler.php?spielerid=".$erg["gastid"][$j]."&turnierid=".$_GET['turnierid']."'>";
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
		<a href='spieluebersichtfuerspieler.php?spielerid=".$erg["gastid"][$j]."&turnierid=".$_GET['turnierid']."'>";
    if($erg["land_heim"][$j]!=Null){
        echo "<img src=\"imgs/flags/".$erg["land_heim"][$j].".png\" alt=\"".$erg["land_heim"][$j]."\"/>";
    }
    echo"<span>"
        .$erg["heim"][$j]."</span></a><strong>";
    printErgebnis($ergebnisheim);
    echo"</strong></span></div>";
    echo"<div class=\"m_dtls\">
								
							</div></div></div>";

}
function rundeFuellenFinal($erg){

    $siegerabfrage = "select spiel.SiegerID from spiel Inner join spielklasse on spiel.spielklasseid=spielklasse.spielklasseid where RundenID=".$erg["rundenid"][0]." and spiel.SpielklasseID=".$_GET['spielklasseid']." and spielklasse.turnierID=".$_GET['turnierid'];
    $sieger = SpieleTabelleErzeugen($siegerabfrage,"sieger");
    $ergebnisgastabfrage ="Select Satz1_gast as satz1, Satz2_gast as satz2, Satz3_gast as satz3, Satz4_gast as satz4, Satz5_gast as satz5 from spiel_ergebnis inner join spiel on spiel.SpielID=spiel_ergebnis.SpielID Inner join spielklasse on spiel.spielklasseid=spielklasse.spielklasseid where RundenID=".$erg["rundenid"][0]." and spiel.SpielklasseID=".$_GET['spielklasseid']." and spielklasse.turnierID=".$_GET['turnierid'];
    $ergebnisheimabfrage ="Select Satz1_heim as satz1, Satz2_heim as satz2, Satz3_heim as satz3, Satz4_heim as satz4, Satz5_heim as satz5 from spiel_ergebnis inner join spiel on spiel.SpielID=spiel_ergebnis.SpielID Inner join spielklasse on spiel.spielklasseid=spielklasse.spielklasseid where RundenID=".$erg["rundenid"][0]." and spiel.SpielklasseID=".$_GET['spielklasseid']." and spielklasse.turnierID=".$_GET['turnierid'];
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
		<a href='spieluebersichtfuerspieler.php?spielerid=".$erg["gastid"][0]."&turnierid=".$_GET['turnierid']."'>";
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
		<a href='spieluebersichtfuerspieler.php?spielerid=".$erg["gastid"][0]."&turnierid=".$_GET['turnierid']."'>";
    if($erg["land_heim"][0]!=Null){
        echo "<img src=\"imgs/flags/".$erg["land_heim"][0].".png\" alt=\"".$erg["land_heim"][0]."\"/>";
    }
    echo"<span>"
        .$erg["heim"][0]."</span></a><strong>";
    printErgebnis($ergebnisheim);
    echo"</strong></span></div>";
    echo"<div class=\"m_dtls\">
								
							</div></div></div>";

}

function sqlAbfrage($i){

    //$spielklasseid=$_GET['spielklasse'];
    $gastabfrage = "SELECT  spieler.Nationalitaet, spieler.SpielerID, spieler.VName AS gast_vname, spieler.NName AS gast_nname, spiel.RundenID, spiel.NextSpiel, spiel.SiegerID From spieler 
    INNER JOIN spiel ON spieler.SpielerID=spiel.Gast Inner join spielklasse on spiel.spielklasseid=spielklasse.spielklasseid WHERE spiel.SpielklasseID=" .$_GET['spielklasseid']. " AND RundenID LIKE \"1".$i."%\""." AND spielklasse.turnierID=".$_GET['turnierid'];
    $heimabfrage = "SELECT  spieler.Nationalitaet, spieler.SpielerID, spieler.VName AS heim_vname, spieler.NName AS heim_nname From spieler 
    INNER JOIN spiel ON spieler.SpielerID=spiel.Heim Inner join spielklasse on spiel.spielklasseid=spielklasse.spielklasseid WHERE spiel.SpielklasseID=" .$_GET['spielklasseid']. " AND RundenID LIKE \"1".$i."%\""." AND spielklasse.turnierID=".$_GET['turnierid'];



    $gast = SpieleTabelleErzeugen($gastabfrage, "gast_neu");
    $heim = SpieleTabelleErzeugen($heimabfrage, "heim");

    $spielabfrage = "select spiel.RundenID,spiel.NextSpiel, spiel.SpielklasseID from spiel Inner join spielklasse on spiel.spielklasseid=spielklasse.spielklasseid where RundenID LIKE \"1".$i."%\" and spiel.SpielklasseID=" .$_GET['spielklasseid']." and spielklasse.turnierID=".$_GET['turnierid'];
    $spiel = SpieleTabelleErzeugen($spielabfrage, "spielabfrage");
    $erg = array_merge($spiel, $gast, $heim);

    return $erg;
}
if(isset($_GET['turnierid'])) {
$turnierid = ($_GET['turnierid']);

if (isset($_GET['spielklasseid']))
{
?>
<div class="brackets_container">
    <table>
        <!--rounds container-->
        <thead>
        <tr>
            <?php
            $anzahlSpielerAbfrage = "Select count(spieler.SpielerID) as count FROM spieler inner join spieler_spielklasse on spieler.SpielerID = spieler_spielklasse.SpielerID where SpielklasseID =".$_GET["spielklasseid"];
            $anzahlSpieler = SpieleTabelleErzeugen($anzahlSpielerAbfrage,"anzahlspieler");
            $width = ((log($anzahlSpieler["anzahlspieler"],2))-1) *2 +1;
            $anzahlRunden = (log($anzahlSpieler["anzahlspieler"],2));
            if($width>6) {
                echo "<th><span>Achtelfinale</span></th>";
            }
            if($width>4){
                echo"<th><span>Viertelfinale</span></th>";
            }
            if($width>2){
                echo"<th><span>Halbfinale</span></th>";
            }
            if($width>0){
                echo"<th><span>Finale</span></th>";
            }
            if($width>2){
                echo"<th><span>Halbfinale</span></th>";
            }
            if($width>4){
                echo"<th><span>Viertelfinale</span></th>";
            }
            if($width>6) {
                echo"<th><span>Achtelfinale</span></th>";
            }
            echo" </tr>
        </thead>
        <tbody>
        <tr id='playground'>";


            $downCounter = $width;

            for ($i = 1; $i <= $width; $i++) {
                if ($i > $downCounter) {
                    $erg = sqlAbfrage($anzahlRunden+1 - $downCounter);
                    echo "<td class=\"round_column r_";
                    $roundd= pow(2, ($anzahlRunden+1 - $downCounter));
                    echo $roundd." reversed";
                    echo " \">";
                    for ($j = count($erg["rundenid"]) / 2; $j < (count($erg["rundenid"])); $j++) {

                        rundeFuellen($erg, $j);
                    }
                } else {
                    $erg = sqlAbfrage($anzahlRunden+1 - $i);
                    echo "<td class=\"round_column r_";
                    echo pow(2, ($anzahlRunden+1 - $i));
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

            if (!isset($_GET['spielklasseid'])) {
                header("Location:spielklassen.php?vt=true&turnierid=".$_GET["turnierid"]);
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
