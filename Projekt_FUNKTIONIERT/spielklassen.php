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

<?php
if(isset($_GET['turnierid'])) {
    $turnierid=($_GET['turnierid']);

    if (isset($_GET['spielklasseid'])) {
        $spielklasseid = $_GET['spielklasseid'];


        $joinabfrage = "SELECT  spieler.SpielerID, spieler.VName AS gast_vname, spieler.NName AS gast_nname, spiel.Feld, spiel.AufrufZeit, spiel_ergebnis.Satz1_heim, spiel_ergebnis.Satz1_gast,
    spiel_ergebnis.Satz2_heim, spiel_ergebnis.Satz2_gast, spiel_ergebnis.Satz3_heim, spiel_ergebnis.Satz3_gast, spielklasse.Disziplin, 
    spielklasse.Niveau FROM spieler INNER JOIN spiel ON spieler.SpielerID=spiel.Gast INNER JOIN spiel_ergebnis ON spiel.SpielID=spiel_ergebnis.SpielID 
    INNER JOIN spielklasse on spiel.SpielklasseID=spielklasse.SpielklasseID Where spiel.SpielklasseID=" . $spielklasseid;
        $gastabfrage = "SELECT  spieler.SpielerID, spieler.VName AS gast_vname, spieler.NName AS gast_nname, spieler.Nationalitaet AS Nationalitaet  From spieler 
    INNER JOIN spiel ON spieler.SpielerID=spiel.Gast WHERE spiel.SpielklasseID=" . $spielklasseid;
        $heimabfrage = "SELECT  spieler.SpielerID, spieler.VName AS heim_vname, spieler.NName AS heim_nname, spieler.Nationalitaet AS Nationalitaet From spieler 
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
            echo "Spielklasse Nummer: " . $spielklasseid;
            ?>


            <table class="allspielklasse" border="1">
            <th>Aufrufzeit</th>
            <th>DisziplinNiveau</th>
            <th>Heim</th>
            <th>Gast</th>
            <th>Ergebnis</th>

            <?php


            for ($i = 0; $i < count($join["aufrufzeit"]); $i++) {
                echo "<tr>";

                echo "<td>" . $ergebnis["aufrufzeit"][$i] . "</td>";
                echo "<td>" . $ergebnis["disziplinniveau"][$i] . "</td>";

                echo "<td class='HeimTable'>";

                echo "<a href=spieleruebersicht.php?spielerid=" . $ergebnis["heimid"][$i] . "&turnierid=".$turnierid.">" . $ergebnis["heim"][$i];
                if ($ergebnis["land_heim"][$i] != Null) {
                    echo "<img src=\"imgs/flags/" . $ergebnis["land_heim"][$i] . ".png\" alt=\"" . $ergebnis["land_heim"][$i] . "\"/>";
                }

                echo "</td>";
                echo "<td class='GastTable'>";
                if ($ergebnis["land_gast"][$i] != Null) {
                    echo "<img src=\"imgs/flags/" . $ergebnis["land_gast"][$i] . ".png\" alt=\"" . $ergebnis["land_gast"][$i] . "\"/>";
                }
                echo "<a href=spieleruebersicht.php?spielerid=" . $ergebnis["gastid"][$i] . "&turnierid=".$turnierid.">" . $ergebnis["gast"][$i];


                echo "</td>";
                echo "<td>" . $ergebnis["erg"][$i] . "</td>";
                echo "<tr>";


            }
        }

        ?>
        </table><br>
        <a href='spielklassen.php'>Zeige alle Spielklassen </a>
        <?php
    }
    if (isset($_GET['turnierid'])) {
        $anzahl = SpieleTabelleErzeugen("SELECT count(SpielklasseID) FROM spielklasse where spielklasse.turnierid =" . $_GET['turnierid'], "berechneanzahldurchlaeufe");
        $spielklasseidabfrage = "select spielklasse.Disziplin, spielklasse.Niveau, spielklasse.SpielklasseID from spielklasse where spielklasse.turnierid =" . $_GET['turnierid'];
        $spielklasse = SpieleTabelleErzeugen($spielklasseidabfrage, "spielklasseid");

        for ($t = 0; $t < $anzahl; $t++) {
            echo "<a href ='spielklassen.php?spielklasseid=" . ($t + 1) . "'>" . $spielklasse["spielklassename"][$t] . " </a>";
        }
    }
    /*
        for ($t = 1; $t <= $anzahl; $t++) {

            $joinabfrage = "SELECT  spieler.SpielerID, spieler.VName AS gast_vname, spieler.NName AS gast_nname, spiel.Feld, spiel.AufrufZeit, spiel_ergebnis.Satz1_heim, spiel_ergebnis.Satz1_gast,
        spiel_ergebnis.Satz2_heim, spiel_ergebnis.Satz2_gast, spiel_ergebnis.Satz3_heim, spiel_ergebnis.Satz3_gast, spielklasse.Disziplin,
        spielklasse.Niveau FROM spieler INNER JOIN spiel ON spieler.SpielerID=spiel.Gast INNER JOIN spiel_ergebnis ON spiel.SpielID=spiel_ergebnis.SpielID
        INNER JOIN spielklasse on spiel.SpielklasseID=spielklasse.SpielklasseID Where spiel.SpielklasseID=" . $t;
            $gastabfrage = "SELECT  spieler.SpielerID, spieler.VName AS gast_vname, spieler.NName AS gast_nname, spieler.Nationalitaet AS Nationalitaet From spieler
        INNER JOIN spiel ON spieler.SpielerID=spiel.Gast WHERE spiel.SpielklasseID=" . $t;
            $heimabfrage = "SELECT  spieler.SpielerID, spieler.VName AS heim_vname, spieler.NName AS heim_nname, spieler.Nationalitaet AS Nationalitaet From spieler
        INNER JOIN spiel ON spieler.SpielerID=spiel.Heim WHERE spiel.SpielklasseID=" . $t;

            /*
            echo "<br>".$joinabfrage;
            echo "<br>".$gastabfrage;
            echo "<br>".$heimabfrage;

            $gast = SpieleTabelleErzeugen($gastabfrage, "gast");
            $heim = SpieleTabelleErzeugen($heimabfrage, "heim");
            $join = SpieleTabelleErzeugen($joinabfrage, "");
            $ergebnis = array_merge($gast, $heim, $join);
            if ($join) {
                echo "<a href ='spielklassen.php?spielklasseid=" . $t . "'>Spielklasse Nummer: </a>" . $t;
                <a href="#textmarke3">zum Kapitel 3</a>
                ?><!--



                --><?php
    /*        }
        }*/
}
else
{
    header("Location:turnieruebersicht.php");
}
?>
</body>
</html>