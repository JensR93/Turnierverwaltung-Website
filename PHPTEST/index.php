
<html>
    <head>
        <title>Badminton</title>
        <script> src="js/jquery-3.2.1.min.js" </script>
        <script> src="js/bootstrap.js" </script>

        <link rel="stylesheet" href="css/bootstrap.css">


    </head>

    <body>

<?php
/*$SERVER='localhost';
$user='root';
$password='jens1234';
$db='turnierverwaltung';
$port='3306';*/

$sql= "SELECT VName, NName, GDatum FROM spieler";
$verbindung = @new mysqli("localhost","root","","turnierverwaltung");

if($verbindung->connect_errno!=0)
{
    echo "Es ist ein Fehler aufgetreten.";
}
else
{

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



?>

    </body>
</html>

