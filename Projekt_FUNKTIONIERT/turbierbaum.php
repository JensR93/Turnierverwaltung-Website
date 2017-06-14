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
    for ($j = 0; $j < (count($ergebnis))-1; $j++) {
        if($ergebnis[($j+1)]!=Null) {
            echo $ergebnis[$j]." | ".$ergebnis[$j+1];
        }
    }
}
function rundeFuellen($erg,$j){

    $siegerabfrage = "select spiel.SiegerID from spiel where RundenID=".$erg["rundenid"][$j];
    $sieger = SpieleTabelleErzeugen($siegerabfrage,"sieger");
    $ergebnisgastabfrage ="Select Satz1_gast as satz1, Satz2_gast as satz2, Satz3_gast as satz3, Satz4_gast as satz4, Satz5_gast as satz5 from spiel_ergebnis inner join spiel on spiel.SpielID=spiel_ergebnis.SpielID where RundenID=".$erg["rundenid"][$j];
    $ergebnisheimabfrage ="Select Satz1_heim as satz1, Satz2_heim as satz2, Satz3_heim as satz3, Satz4_heim as satz4, Satz5_heim as satz5 from spiel_ergebnis inner join spiel on spiel.SpielID=spiel_ergebnis.SpielID where RundenID=".$erg["rundenid"][$j];
    $ergebnisgast = SpieleTabelleErzeugen($ergebnisgastabfrage,"ergebnis");
    $ergebnisheim = SpieleTabelleErzeugen($ergebnisheimabfrage,"ergebnis");
    // printErgebnis($ergebnisheim);
    echo"<div class=\"mtch_container\"> <div class=\"match_unit\">";

    if($sieger["siegerid"][0] = $erg["gastid"][$j])
    {
        echo"<div class=\"m_segment m_top winner\" data-team-id=".$erg["gastid"][$j].">
		<span>
		<a href=\"#\">
		<span>"
            .$erg["gast"][$j]."</span>
									</a>
									<strong>";
        printErgebnis($ergebnisgast);
        echo"</strong>
								</span>
							</div>
							<div class=\"m_segment m_botm loser\" data-team-id=".$erg["heimid"][$j].">
								<span>
									<a href=\"#\">
										<span>".$erg["heim"][$j]."</span>
									</a>
									<strong>";
        printErgebnis($ergebnisheim);

        echo"</strong>
		    </span>
		    </div>";

    }
    else{
        echo"<div class=\"m_segment m_top winner\" data-team-id=".$erg["heimid"][$j].">
		       <span>
		       <a href=\"#\">
	        <span>" .$erg["heim"][$j]."</span>
									</a>
									<strong>";
        printErgebnis($ergebnisheim);
        echo"</strong>
								</span>
							</div>
							<div class=\"m_segment m_botm loser\" data-team-id=".$erg["gastid"][$j].">
								<span>
									<a href=\"#\">
										<span>".$erg["gast"][$j]."</span>
									</a>
									<strong>";
        printErgebnis($ergebnisgast);
        echo"</strong>
								</span>
							</div>";
    }
    echo"<div class=\"m_dtls\">
								<span>June 10, 2015 - 8:00 pm</span>
							</div>
						</div>
					</div>";

}
$spielklasseid=1;
function sqlAbfrage($i){
    $spielklasseid=1;
    $gastabfrage = "SELECT  spieler.SpielerID, spieler.VName AS gast_vname, spieler.NName AS gast_nname, spiel.RundenID, spiel.NextSpiel, spiel.SiegerID From spieler 
    INNER JOIN spiel ON spieler.SpielerID=spiel.Gast WHERE spiel.SpielklasseID=" . $spielklasseid . " AND RundenID LIKE \"1".$i."%\"";
    $heimabfrage = "SELECT  spieler.SpielerID, spieler.VName AS heim_vname, spieler.NName AS heim_nname From spieler 
    INNER JOIN spiel ON spieler.SpielerID=spiel.Heim WHERE spiel.SpielklasseID=" . $spielklasseid . " AND RundenID LIKE \"1".$i."%\"";



    $gast = SpieleTabelleErzeugen($gastabfrage, "gast_neu");
    $heim = SpieleTabelleErzeugen($heimabfrage, "heim");

    $spielabfrage = "select spiel.RundenID,spiel.NextSpiel, spiel.SpielklasseID from spiel where RundenID LIKE \"1".$i."%\"";
    $spiel = SpieleTabelleErzeugen($spielabfrage, "spielabfrage");
    $erg = array_merge($spiel, $gast, $heim);

    return $erg;
}
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
        <tbody><tr id="playground">
            <?php

            for ($i = 1; $i <= 5; $i++) {

                //echo "i=".$i;



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




            } echo "</div>"
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
