<html>
<head>
<?php
    include 'funktionen/dbspieleabfrage_neu.php';
    include 'funktionen/Einfuegen.php';
    include '1.php';
    ?>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>
        .allspielklasse{
           min-width: 1000px;

        }
        .allspielklasse td{

            max-width: 15em;
            white-space: nowrap;
        }
    </style>
</head>

<body>



<h1>Zu erledigen:<br>Turnierbaum fehlt komplett<br>Styles einfügen<br>Tabellen spalten per Javascript abschaltbar<br></h1>

<?php
if(isset($_GET['spielklasseid'])) {
$spielklasseid=$_GET['spielklasseid'];


    $joinabfrage = "SELECT  spieler.SpielerID, spieler.VName AS gast_vname, spieler.NName AS gast_nname, spiel.Feld, spiel.AufrufZeit, spiel_ergebnis.Satz1_heim, spiel_ergebnis.Satz1_gast,
    spiel_ergebnis.Satz2_heim, spiel_ergebnis.Satz2_gast, spiel_ergebnis.Satz3_heim, spiel_ergebnis.Satz3_gast, spielklasse.Disziplin, 
    spielklasse.Niveau FROM spieler INNER JOIN spiel ON spieler.SpielerID=spiel.Gast INNER JOIN spiel_ergebnis ON spiel.SpielID=spiel_ergebnis.SpielID 
    INNER JOIN spielklasse on spiel.SpielklasseID=spielklasse.SpielklasseID Where spiel.SpielklasseID=" . $spielklasseid;
    $gastabfrage = "SELECT  spieler.SpielerID, spieler.VName AS gast_vname, spieler.NName AS gast_nname From spieler 
    INNER JOIN spiel ON spieler.SpielerID=spiel.Gast WHERE spiel.SpielklasseID=" . $spielklasseid;
    $heimabfrage = "SELECT  spieler.SpielerID, spieler.VName AS heim_vname, spieler.NName AS heim_nname From spieler 
    INNER JOIN spiel ON spieler.SpielerID=spiel.Heim WHERE spiel.SpielklasseID=" . $spielklasseid;

    /*
    echo "<br>".$joinabfrage;
    echo "<br>".$gastabfrage;
    echo "<br>".$heimabfrage;
    */
    $gast = SpieleTabelleErzeugen($gastabfrage, "gast");
    $heim = SpieleTabelleErzeugen($heimabfrage, "heim");
    $join = SpieleTabelleErzeugen($joinabfrage, "");
    $ergebnis = array_merge($gast, $heim, $join);
    if ($join) {
        echo "Spielklasse Nummer: ".$spielklasseid;
        ?>


        <table class="allspielklasse" border="1">
        <th>Aufrufzeit</th>
        <th>DisziplinNiveau</th>
        <th>Match Übersicht</th>
        <th>Ergebnis</th>

        <?php


        for ($i = 0; $i < count($join["aufrufzeit"]); $i++) {
            echo "<tr>";

            echo "<td>" . $ergebnis["aufrufzeit"][$i] . "</td>";
            echo "<td>" . $ergebnis["disziplinniveau"][$i] . "</td>";

            echo "<td><table border='0'><td><a href=spieleruebersicht.php?spielerid=" . $ergebnis["heimid"][$i] . ">" . $ergebnis["heim"][$i] . " ID:" . $ergebnis["heimid"][$i] . "</td><td><a href=spieleruebersicht.php?spielerid=" . $ergebnis["gastid"][$i] . ">" . $ergebnis["gast"][$i] . " ID:" .
                $ergebnis["gastid"][$i] . "</td></td></table>";
            echo "<td>" . $ergebnis["erg"][$i] . "</td>";
            echo "<tr>";


        }
    }

    ?>
    </table><br>
   <a href ='spielklassen.php'>Zeige alle Spielklassen </a>
    <?php
}
if(!isset($_GET['spielklasseid'])) {
$anzahl = SpieleTabelleErzeugen("SELECT count(SpielklasseID) FROM spielklasse", "berechneanzahldurchlaeufe");


    for ($t = 1; $t <= $anzahl; $t++)
    {

        $joinabfrage = "SELECT  spieler.SpielerID, spieler.VName AS gast_vname, spieler.NName AS gast_nname, spiel.Feld, spiel.AufrufZeit, spiel_ergebnis.Satz1_heim, spiel_ergebnis.Satz1_gast,
    spiel_ergebnis.Satz2_heim, spiel_ergebnis.Satz2_gast, spiel_ergebnis.Satz3_heim, spiel_ergebnis.Satz3_gast, spielklasse.Disziplin, 
    spielklasse.Niveau FROM spieler INNER JOIN spiel ON spieler.SpielerID=spiel.Gast INNER JOIN spiel_ergebnis ON spiel.SpielID=spiel_ergebnis.SpielID 
    INNER JOIN spielklasse on spiel.SpielklasseID=spielklasse.SpielklasseID Where spiel.SpielklasseID=" . $t;
        $gastabfrage = "SELECT  spieler.SpielerID, spieler.VName AS gast_vname, spieler.NName AS gast_nname From spieler 
    INNER JOIN spiel ON spieler.SpielerID=spiel.Gast WHERE spiel.SpielklasseID=" . $t;
        $heimabfrage = "SELECT  spieler.SpielerID, spieler.VName AS heim_vname, spieler.NName AS heim_nname From spieler 
    INNER JOIN spiel ON spieler.SpielerID=spiel.Heim WHERE spiel.SpielklasseID=" . $t;

        /*
        echo "<br>".$joinabfrage;
        echo "<br>".$gastabfrage;
        echo "<br>".$heimabfrage;
        */
        $gast = SpieleTabelleErzeugen($gastabfrage, "gast");
        $heim = SpieleTabelleErzeugen($heimabfrage, "heim");
        $join = SpieleTabelleErzeugen($joinabfrage, "");
        $ergebnis = array_merge($gast, $heim, $join);
        if ($join) {
            echo "<a href ='spielklassen.php?spielklasseid=".$t."'>Spielklasse Nummer: </a>" . $t;
            /*<a href="#textmarke3">zum Kapitel 3</a>*/
            ?>


            <table class ="allspielklasse" border="1">
            <th>Aufrufzeit</th>
            <th>DisziplinNiveau</th>
            <th>Match Übersicht</th>
            <th>Ergebnis</th>

            <?php


            for ($i = 0; $i < count($join["aufrufzeit"]); $i++) {
                echo "<tr>";

                echo "<td>" . $ergebnis["aufrufzeit"][$i] . "</td>";
                echo "<td>" . $ergebnis["disziplinniveau"][$i] . "</td>";

                echo "<td><table border='0'><td><a href=spieleruebersicht.php?spielerid=" . $ergebnis["heimid"][$i] . ">" . $ergebnis["heim"][$i] . " ID:" . $ergebnis["heimid"][$i] . "</td><td><a href=spieleruebersicht.php?spielerid=" . $ergebnis["gastid"][$i] . ">" . $ergebnis["gast"][$i] . " ID:" .
                    $ergebnis["gastid"][$i] . "</td></td></table>";
                echo "<td>" . $ergebnis["erg"][$i] . "</td>";
                echo "<tr>";


            }
        }

        ?>
        </table>
        <?php
    }
}
?>
</body>
</html>