<html>
<head><link rel="stylesheet" href="css/bootstrap.css">
    <?php
    include 'funktionen/dbturnierabfrage.php';
    include '1.php';
    ?>
</head>
<body>


<?php
include "suchleiste.php";
function alleTurnier()
{
    ?>
    <table border="1">
<?php
    $turniere = TurnierAllSuche();
    for ($i = 0; $i < count($turniere); $i++) {
        echo "<tr>";
        for ($j = 0; $j < (count($turniere[$i])); $j++)
        {
            if ($j==3)
            {

                echo "<td><a href='spielklassen.php?spielklasseid=".$turniere[$i][4]."'> " . $turniere[$i][$j]."</a></td>";
            }
            else {
                echo "<td>" . $turniere[$i][$j] . "</td>";
            }
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
    //$turnier = TurnierIDSuche($_GET['name']);
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
            for ($j = 0; $j < (count($turnier[$i])-1); $j++) {


                if ($j==3)
                {

                    echo "<td><a href='spielklassen.php?spielklasseid=".$turnier[$i][4]."'> " . $turnier[$i][$j]."</a></td>";
                }
                else
                {
                    echo "<td>" . $turnier[$i][$j]."</td>";
                }


            }
            echo "</tr>";

        }
    }
    else
    {
        echo "nichts gefunden";
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

