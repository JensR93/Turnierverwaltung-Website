<html>
<head>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">


    </script>
    <style>

        span {
            font-weight: bold;
        }
        .allgemeinabstand{
            font-family: tahoma;
            margin: 2rem;
            font-size: large;
        }
        .allspielklasse{
            min-width: 60%;
            max-width: 90%;
            margin: 2rem;
            margin-top: 1.25rem;
            margin-right: 2rem;
            font-family: tahoma;
            font-size: large;

            border-collapse: separate;
            -webkit-border-vertical-spacing: 0.5rem;

        }
        .allspielklasse table{

            margin-bottom: 2rem;

        }
        .allspielklasse tr{
            min-width: 100%;

        }
        .allspielklasse td{

            /*max-width: 15em;*/
            border-collapse: separate;
            -webkit-border-horizontal-spacing: 0.5rem;
            white-space: nowrap;
        }
    </style>
</head>
    <?php
    include 'funktionen/dbspielersuche.php';
    include 'funktionen/Einfuegen.php';
    include '1.php';
    include 'suchleiste.php';

    echo "</head><body onload=\"\">";




    if(isset($_GET['turnierid'])) {
        $turnierid = ($_GET['turnierid']);
        if (isset($_GET['vname']) && isset($_GET['nname'])) {

            $KompletterName = SpielerSuche($_GET['vname'], $_GET['nname'], "1");

            if (!$KompletterName) {
                echo "Ihre Suche hat nichts ergeben!";
            } else {

                echo "<table class='allspielklasse' id=\"spielertabelle\" class=\"tableSection\" border=\"0\">";

                for ($i = 0; $i < count($KompletterName); $i++) {
                    echo "<tr>";
                    echo "<td><a href='spieluebersichtfuerspieler.php?spielerid=" . $KompletterName[$i][0] . "&turnierid=".$_GET['turnierid']."'> ";
                    if ($KompletterName[$i][8] != Null) {
                        echo "<img src=\"imgs/flags/" . $KompletterName[$i][8] . ".png\" alt=\"" . $KompletterName[$i][8] . "\"/>";
                    }
                    echo $KompletterName[$i][1] . "</a></td>";


                    echo "</tr>";

                }
            }

            echo "<table>";


        }
        if (isset($_GET['spielerid'])) {
            //echo $_GET['spielername'];   echo $row[0] . " " . $row[1] . "<br />";

            echo "<table KompletterName=\"spielertabelle\" class=\"tableSection\" border=\"1\">";

            $KompletterName = IDSuche($_GET['spielerid']);

            echo "<tr>";
            for ($i = 0; $i < count($KompletterName); $i++) {
                /*echo "<td>" . $KompletterName[$i] . "</td>";*/
                echo "<td class= \"spalte" . $i . "\">" . $KompletterName[$i] . "</td>";
            }
            echo "</tr><a href=\"spieleruebersicht.php?vname=&nname=\">Zeige alle Spieler</a>";
        }
     }
         else
         {
             if (isset($_GET['vname']) && isset($_GET['nname'])) {

                 $KompletterName = SpielerSuche($_GET['vname'], $_GET['nname'], "1");

                 if (!$KompletterName) {
                     echo "Ihre Suche hat nichts ergeben!";
                 } else {

                     echo "<table class='allspielklasse' id=\"spielertabelle\" class=\"tableSection\" border=\"0\">";

                     for ($i = 0; $i < count($KompletterName); $i++) {
                         echo "<tr>";
                         echo "<td><a href='spieluebersichtfuerspieler.php?spielerid=" . $KompletterName[$i][0]."'> ";
                         if ($KompletterName[$i][8] != Null) {
                             echo "<img src=\"imgs/flags/" . $KompletterName[$i][8] . ".png\" alt=\"" . $KompletterName[$i][8] . "\"/>";
                         }
                         echo $KompletterName[$i][1] . "</a></td>";


                         echo "</tr>";

                     }
                 }

                 echo "<table>";


             }
             if (isset($_GET['spielerid'])) {
                 //echo $_GET['spielername'];   echo $row[0] . " " . $row[1] . "<br />";

                 echo "<table KompletterName=\"spielertabelle\" class=\"tableSection\" border=\"1\">";

                 $KompletterName = IDSuche($_GET['spielerid']);

                 echo "<tr>";
                 for ($i = 0; $i < count($KompletterName); $i++) {
                     /*echo "<td>" . $KompletterName[$i] . "</td>";*/
                     echo "<td class= \"spalte" . $i . "\">" . $KompletterName[$i] . "</td>";
                 }
                 echo "</tr><a href=\"spieleruebersicht.php?vname=&nname=\">Zeige alle Spieler</a>";
             }
         }
        ?>
    </table>

<!--
    <br><input type='button' id='hideshow' value='Meldegebuehren/Verfuegbar anzeigen'>
    <p>Dies ist Ihr <span id="info">1</span>. Besuch auf dieser Seite!</p>-->



    </body>
</html>

