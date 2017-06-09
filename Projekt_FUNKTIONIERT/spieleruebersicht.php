<html>
<head>
    <?php
    include 'funktionen/dbspielerabfrage.php';
    include 'funktionen/dbspielersuche.php';
    include 'funktionen/dbspieleabfrage_neu.php';
    include 'funktionen/Einfuegen.php';
    include '1.php';
    ?>
</head>
<body>
<?php
if(isset($_GET['id'])) {
    // id index exists


    $spielerabfrage="Select * from spieler";
    $spieler= SpieleTabelleErzeugen($spielerabfrage, "spieler");
?>

    <table border="1">
        <th>SpielerID</th>     <th>VName</th>        <th>NName</th>        <th>GDatum</th>        <th>Geschlecht</th>        <th>Verein</th>        <th>RLP_Einzel</th>        <th>RLP_Doppel</th>
        <th>RLP_Mixed</th>        <th>MeldeGebuehren</th>        <th>AnzahlSiege</th>        <th>Nationalitaet</th>        <th>AnzahlNiederlagen</th>        <th>GewonneneSaetze</th>        <th>VerloreneSaetze</th>
        <th>ErspieltePunkte</th>        <th>ZugelassenePunkte</th>        <th>Verfuegbar</th>        <th>ExtSpielerID</th>        <th>AktuellesSpiel</th>



 <?php
    for($i=0;$i<count($spieler);$i++)
    {
        echo "<tr>";
        for($j=0;$j<count($spieler[$i]);$j++) {
            echo "<td>" . $spieler[$i][$j] . "</td>";

        }
        echo "</tr>";
    }

}
 ?>
    </table>
<?php

 if(isset($_GET['vname'])&&isset($_GET['nname']))
 {
    //echo $_GET['spielername'];
     ?>
        <table border="1">
            <th>SpielerID</th>     <th>VName</th>        <th>NName</th>        <th>GDatum</th>        <th>Geschlecht</th>        <th>Verein</th>        <th>RLP_Einzel</th>        <th>RLP_Doppel</th>
            <th>RLP_Mixed</th>        <th>MeldeGebuehren</th>        <th>AnzahlSiege</th>        <th>Nationalitaet</th>        <th>AnzahlNiederlagen</th>        <th>GewonneneSaetze</th>        <th>VerloreneSaetze</th>
            <th>ErspieltePunkte</th>        <th>ZugelassenePunkte</th>        <th>Verfuegbar</th>        <th>ExtSpielerID</th>        <th>AktuellesSpiel</th>
        <?php
             $id= SpielerSuche($_GET['vname'],$_GET['nname']);

             for($i=0;$i<count($id);$i++)
             {
                 echo "<tr>";
                 for($j=0;$j<count($id[$i]);$j++) {
                     echo "<td>" . $id[$i][$j] . "</td>";

                 }
                 echo "</tr>";

             }
 }
?>
</table>
<table border="1">

<?php
        if(isset($_GET['spielerid']))
{
        //echo $_GET['spielername'];   echo $row[0] . " " . $row[1] . "<br />";
        ?>
    <th>SpielerID</th>     <th>VName</th>        <th>NName</th>        <th>GDatum</th>        <th>Geschlecht</th>        <th>Verein</th>        <th>RLP_Einzel</th>        <th>RLP_Doppel</th>
    <th>RLP_Mixed</th>        <th>MeldeGebuehren</th>        <th>AnzahlSiege</th>        <th>Nationalitaet</th>        <th>AnzahlNiederlagen</th>        <th>GewonneneSaetze</th>        <th>VerloreneSaetze</th>
    <th>ErspieltePunkte</th>        <th>ZugelassenePunkte</th>        <th>Verfuegbar</th>        <th>ExtSpielerID</th>        <th>AktuellesSpiel</th>
<?php
    $id= IDSuche($_GET['spielerid']);
        /*
        echo "<tr><td>$id[0]</td></tr>";
        for($j=0;$j<count($id);$j++)
        {

        echo  "<td><td>".$id[$j]."</td></tr>";

        }*/
    echo "<tr>";
    for($i=0;$i<count($id);$i++)
    {


            echo "<td>" . $id[$i] . "</td>";




    }echo "</tr>";

}
        ?>
    </table>
</body>
</html>

