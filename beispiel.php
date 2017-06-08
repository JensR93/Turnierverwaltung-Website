<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <title>Titel</title>

    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">

</head>
<body>
<?php

$verbindung = @new mysqli("localhost","root","","aerocontrol");

if($verbindung->connect_errno!=0)
{
    echo "Es ist ein Fehler aufgetreten.";
}
else
{
    $abfragen=array(// Aufgabe
        "SELECT airplane.*, airplane_type.* FROM airplane_type 
                        INNER JOIN airplane ON airplane_type.type_id = airplane.type_id",
        "SELECT airplane.*, airplane_type.* FROM airplane_type
                        LEFT OUTER JOIN airplane ON airplane_type.type_id = airplane.type_id");

    foreach($abfragen as $sql)
    {
        echo $sql."<br />";

        $ergebnis=$verbindung->query($sql);

        if(!$ergebnis)
        {
            echo "Bei der Abfrage ist ein Fehler aufgetreten.<br />";
        }
        else
        {
            echo "<table border=\"2\">";

            while($zeile=$ergebnis->fetch_row())
            {
                echo "<tr>";

                while($attribute=$ergebnis->fetch_field())
                {
                    echo "<th>".$attribute->name."</th>";
                }

                echo "</tr>";
                foreach($zeile as $feld)
                {
                    echo "<td>".$feld."</td>";
                }


            }
            echo "</table>";
        }
    }
}
?>
</body>
</html>