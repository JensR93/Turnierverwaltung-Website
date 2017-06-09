<html>
<head>
    <?php
    include 'funktionen/dbturnierabfrage.php';
    include '1.php';
    ?>
</head>
<body>

<table border="1">

<?php

$turnierabfrage="Tennis";
$spieler= TurnierIDSuche("Badminton");

for($i=0;$i<count($spieler);$i++)
{
    echo "<tr>";
    for($j=0;$j<count($spieler[$i]);$j++) {
        echo "<td>" . $spieler[$i][$j] . "</td>";

    }
    echo "</tr>";

}
?>
</table>
</body>
</html>

