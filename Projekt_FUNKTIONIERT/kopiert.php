<html>
<head>
<?php
    include 'funktionen/dbspielerabfrage.php';
    include 'funktionen/dbspieleabfrage_neu.php';
    include 'funktionen/Einfuegen.php';
    include '1.php';
    ?>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>


</body>
</html>
<h1>
<?php
echo "Zu erledigen:<br> Spielerübersichtseite, wenn keine eingabe (aktuell leer)<br>Aktuell Fehlermeldung, wenn man nach unbekanntem Spieler sucht!<br>Turnierbaum fehlt komplett<br>Styles einfügen<br>Tabellen spalten per Javascript abschaltbar<br></h1>";
$joinabfrage="SELECT spieler.SpielerID, spieler.VName AS gast_vname, spieler.NName AS gast_nname, spiel.Feld, spiel.AufrufZeit, spiel_ergebnis.Satz1_heim, spiel_ergebnis.Satz1_gast,
 spiel_ergebnis.Satz2_heim, spiel_ergebnis.Satz2_gast, spiel_ergebnis.Satz3_heim, spiel_ergebnis.Satz3_gast, spielklasse.Disziplin, 
 spielklasse.Niveau FROM spieler INNER JOIN spiel ON spieler.SpielerID=spiel.Gast INNER JOIN spiel_ergebnis ON spiel.SpielID=spiel_ergebnis.SpielID 
 INNER JOIN spielklasse on spiel.SpielklasseID=spielklasse.SpielklasseID";
$gastabfrage="SELECT spieler.SpielerID, spieler.VName AS gast_vname, spieler.NName AS gast_nname From spieler INNER JOIN spiel ON spieler.SpielerID=spiel.Gast";
$heimabfrage="SELECT spieler.SpielerID, spieler.VName AS heim_vname, spieler.NName AS heim_nname From spieler INNER JOIN spiel ON spieler.SpielerID=spiel.Heim";

$gast= SpieleTabelleErzeugen($gastabfrage, "gast");
$heim= SpieleTabelleErzeugen($heimabfrage, "heim");
$join= SpieleTabelleErzeugen($joinabfrage, "");
$ergebnis=array_merge($gast,$heim,$join);

?>

<div id="Spielertabelle">

<table border="1">
<th>Aufrufzeit</th>
<th>DisziplinNiveau</th>
<th>Match Übersicht</th>
<th>Ergebnis</th>
<?php



for($i=0;$i<count($join["aufrufzeit"]);$i++)
{ echo "<tr>";

    echo "<td>".$ergebnis["aufrufzeit"][$i]."</td>";
    echo "<td>".$ergebnis["disziplinniveau"][$i]."</td>";

    echo "<td><table border='1'><td><a href=spieleruebersicht.php?spielerid=".$ergebnis["heimid"][$i].">".$ergebnis["heim"][$i]." ID:".$ergebnis["heimid"][$i]."</td><td><a href=spieleruebersicht.php?spielerid=".$ergebnis["gastid"][$i].">".$ergebnis["gast"][$i]." ID:".
        $ergebnis["gastid"][$i]."</td></td></table>";
    echo "<td>".$ergebnis["erg"][$i]."</td>";
    echo "<tr>";


}

?>
</table>

</div>