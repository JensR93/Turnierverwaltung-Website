<html>
<head>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">


    </script>
<style>
    span {
        font-weight: bold;
    }

    table.tableSection {
        display: block;
        height: 200px;
        width: 1400px;
        overflow: auto;
    }
    .spalte11{display: none}
    .spalte6{display: none}

</style>
<script>

    function init() {
        var besuch = zaehlerstand();
        var ausgabe = document.getElementById('info');
        ausgabe.innerHTML = besuch;




    }

    function wertHolen() {
        var Wert = "";
        if (document.cookie) {
            var Wertstart = document.cookie.indexOf("=") + 1;
            var Wertende = document.cookie.indexOf(";");
            if (Wertende == -1) {
                Wertende = document.cookie.length;
            }
            Wert = document.cookie.substring(Wertstart, Wertende);
        }
        return Wert;
    }

    function wertSetzen(Bezeichner, Wert, Verfall) {
        var jetzt = new Date();
        var Auszeit = new Date(jetzt.getTime() + Verfall);
        document.cookie = Bezeichner + "=" + Wert + "; expires=" + Auszeit.toGMTString() +
            ";";
    }

    function zaehlerstand() {
        var Verfallszeit = 1000 * 60 * 60 * 24 * 365;
        var Anzahl = wertHolen();
        var Zaehler = 0;
        if (Anzahl != "") {
            Zaehler = parseInt(Anzahl) || 0;
        }
        Zaehler = Zaehler + 1;
        wertSetzen("Zaehler", Zaehler, Verfallszeit);
        return (Zaehler);
    }
    window.addEventListener('DOMContentLoaded', init);



    jQuery(document).ready(function(){
        jQuery('#hideshow').on('click', function(event) {
            jQuery('.spalte6').toggle('show');//Meldegebühren
            jQuery('.spalte11').toggle('show');//Verfügbar
        });
    });

</script>


    <?php
    include 'funktionen/dbspielersuche.php';
    include 'funktionen/dbspieleabfrage_neu.php';
    include 'funktionen/Einfuegen.php';
    include '1.php';
    include 'suchleiste.php';
    ?>

    <style>



        #PageNavi{
            background-color: lightblue;

        }
        #PageNavi tr{

            height: 10px;
            text-align:center;
        }
        #PageNavi td{

            min-width: 100px;
            text-align:center;
            vertical-align: bottom;

        }
    </style>

</head>
<body onload="">






<?php

/*
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

}*/
 ?>
    </table>
<?php

function getpage()
{
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
        if (!$page) {
            $page = 1;
        }
    } else {

        $page = 1;
    }
    return $page;
}

function navimalen()
{
    $page= getpage();
    echo "<table border = 1 id='PageNavi'>
<tr><td><form action=\"spieleruebersicht.php?vname=\">
    <input hidden=\"true\" id=\"\" name=\"vname\">
    <input hidden=\"true\" id=\"\" name=\"nname\">
    <input type=\"submit\" id=\"\" value=".($page-1)." name=\"page\">
</form></td>
<td><form action=\"spieleruebersicht.php?vname=\">
    <input hidden=\"true\" id=\"\" name=\"vname\">
    <input hidden=\"true\" id=\"\" name=\"nname\">
    <input type=\"submit\" id=\"\" value=".($page)." name=\"page\">
</form></td>
<td><form action=\"spieleruebersicht.php?vname=\">
    <input hidden=\"true\" id=\"\" name=\"vname\">
    <input hidden=\"true\" id=\"\" name=\"nname\">
    <input type=\"submit\" id=\"\" value=".($page+1)." name=\"page\">
</form></td></tr><tr><td>Rückwärts</td><td></td><td>Vowärts</td></tr>
</table>
<form action=\"spieleruebersicht.php?vname=\">
    <input hidden=\"true\" id=\"\" name=\"vname\">
        <input hidden=\"true\" id=\"\" name=\"nname\">
  
    
        <input id=\"\" name=\"page\">
    
    <input type=\"submit\" value=\"Seite suchen\" >
</form>";
}
?>







<?php


if(isset($_GET['vname'])&&isset($_GET['nname']) &&!isset($_GET['spielerid']))
 {
    //echo $_GET['spielername'];
navimalen();
$page= getpage();

             $id= SpielerSuche($_GET['vname'],$_GET['nname'],$page);

                if(!$id)
                {
                    echo "Ihre Suche hat nichts ergeben!";
                }
                else
                {



                    ?>

<table id="spielertabelle" class="tableSection" border="1"><thead>
                        <th class="spalte0">SpielerID</th>     <th class="spalte1">Name</th>              <th class="spalte2">GDatum</th>        <th class="spalte3">m/w</th>        <th class="spalte4">Verein</th>        <th class="spalte5">Ranglistenpunkte</th>
                                <th class="spalte6">MeldeGebuehren</th>        <th class="spalte7">Siege:Niederlagen</th>        <th class="spalte8">Nationalitaet</th>               <th class="spalte9">Sätze</th>
                        <th class="spalte10">Punkte</th>             <th class="spalte11">Verfuegbar</th>        <th class="spalte12">ExtSpielerID</th>        <th class="spalte13"> AktuellesSpiel</th>
    </thead> <?php
                         for($i=0;$i<count($id);$i++)
                    {
                        echo "<tr>";
                        for($j=0;$j<count($id[$i]);$j++) {


//                           echo "<td class= \"spalte\">". $id[$i][$j] . "</td>";
                            if($j==1)
                            {

                                echo "<td><a href='spieluebersichtfuerspieler.php?spielerid=".$id[$i][0]."'> " . $id[$i][$j]."</a></td>";
                            }
                            else
                            {
                                echo "<td class= \"spalte".$j."\">". $id[$i][$j] . "</td>";
                            }


                        }
                        echo "</tr>";

                    }
                }
 }
?>
</table>


<?php

        if(isset($_GET['spielerid']))
{
        //echo $_GET['spielername'];   echo $row[0] . " " . $row[1] . "<br />";
        ?>
<table id="spielertabelle" class="tableSection" border="1"><thead>
    <th class="spalte0">SpielerID</th>     <th class="spalte1">Name</th>              <th class="spalte2">GDatum</th>        <th class="spalte3">m/w</th>        <th class="spalte4">Verein</th>        <th class="spalte5">Ranglistenpunkte</th>
    <th class="spalte6">MeldeGebuehren</th>        <th class="spalte7">Siege:Niederlagen</th>        <th class="spalte8">Nationalitaet</th>               <th class="spalte9">Sätze</th>
    <th class="spalte10">Punkte</th>             <th class="spalte11">Verfuegbar</th>        <th class="spalte12">ExtSpielerID</th>        <th class="spalte13"> AktuellesSpiel</th>
    </thead>   <?php
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
        /*echo "<td>" . $id[$i] . "</td>";*/
        echo "<td class= \"spalte".$i."\">". $id[$i]. "</td>";
    }
    echo "</tr><a href=\"spieleruebersicht.php?vname=&nname=\">Zeige alle Spieler</a>";
}

        ?>
    </table>
<script>

</script>
<br><input type='button' id='hideshow' value='Meldegebuehren/Verfuegbar anzeigen'>
<p>Dies ist Ihr <span id="info">1</span>. Besuch auf dieser Seite!</p>



</body>
</html>

