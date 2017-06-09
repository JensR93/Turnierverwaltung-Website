<html>
<head>
    <?php
    include 'funktionen/dbturnierabfrage.php';
    include '1.php';
    ?>
</head>
<body>


<?php
function alleTurnier()
{
    ?>
    <table border="1">
<?php
    $turniere = TurnierAllSuche();
    for ($i = 0; $i < count($turniere); $i++) {
        echo "<tr>";
        for ($j = 0; $j < count($turniere[$i]); $j++) {
            echo "<td>" . $turniere[$i][$j] . "</td>";

        }
        echo "</tr>";

    }
    ?>
    </table>
<?php
}

if(isset($_GET['name']))
{
    //$turnierabfrage = "Tennis";
    $turnier = TurnierIDSuche($_GET['name']);

    $anzahl= count($turnier);

    if($anzahl>0) {
        ?>
<table border="1">
    <th>Turnierid</th>
    <th>Aufrufzeit</th>
    <th>Datum</th>
    <th>Name</th>
    <?php
        for ($i = 0; $i < $anzahl; $i++) {
            echo "<tr>";
            for ($j = 0; $j < count($turnier[$i]); $j++) {
                echo "<td>" . $turnier[$i][$j] . "</td>";

            }
            echo "</tr>";

        }
    }
    else
    {
        alleTurnier();
    }
}
else
{
    alleTurnier();
}
?>
</table>
</body>
</html>

