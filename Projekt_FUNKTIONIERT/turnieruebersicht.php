<html>
<head><link rel="stylesheet" href="css/bootstrap.css">
    <?php
    include 'funktionen/dbturnierabfrage.php';
    include '1.php';
    ?>
</head>
<body>
<style>
    .allgemeinabstand{
        font-family: tahoma;
        margin: 2rem;
        font-size: large;
    }
    .allspielklasse{
        min-width: 30rem;
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
    .tdabstand{
        min-width: 0.75rem;
        text-align: center ;
    }
</style>


<?php
include "suchleiste.php";
echo "<div class='allgemeinabstand'> <form action=\"turnieruebersicht.php?name\">
    <label for=\"name\">Turniername:
        <input id=\"Turniername\" name=\"name\">
    </label> 

    <input type=\"submit\" value=\"suchen\" >
</form></div>";
function alleTurnier()
{
?> <div class="allgemeinabstand"> Alle Turniere:</div>
    <table border="0" class="allspielklasse table-hover">
        <?php
        $turniere = TurnierAllSuche();
        for ($i = 0; $i < count($turniere); $i++) {
            echo "<tr>";
            for ($j = 0; $j < 2; $j++)
            {
                if ($j==1)
                {

                    echo "<td><a href='spielklassen.php?turnierid=".$turniere[$i][2]."'> " . $turniere[$i][$j]."</a></td>";
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

                echo "<td><a href='spielklassen.php?turnierid=".$turnier[$i][0]."'> " . $turnier[$i][$j]."</a></td>";
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
        //echo "nichts gefunden";
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

