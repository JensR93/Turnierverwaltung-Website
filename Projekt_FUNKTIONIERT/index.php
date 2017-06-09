<?php
include 'funktionen/dbspielerabfrage.php';
include 'funktionen/Einfuegen.php';
include 'menu/1.php';
?>
<head>
    <style type="text/css">
        #SpielerTabelle
        {
            width: 50vw;
            background-color:lightblue;
        }
        </style>
</head>
<body>
h
<div id="SpielerTabelle">
    <?php
    SpielerTabelleErzeugen();
    ?>
</div>
<div id="SpielerEinf>
    <?php
    SpielerEinfuegen("INSERT INTO Spieler (Vname, NName, GDatum) VALUES ('Jens', 'Röcker', '12.06.1993')");
    ?>
</div>
</body>
