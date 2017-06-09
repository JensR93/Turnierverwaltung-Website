<?php
$mysqli = new mysqli('localhost', 'root', '', 'turnierverwaltung');
if($mysqli->connect_errno>0)
{
    die("Connection to MySQL-server failed!");
}
$resultArr = array();//to store results
//to execute query

$executingFetchQuery = $mysqli->query("SELECT vname, nname  FROM Spieler");
echo"<table border ='1'>";

/*
<tr> <td> hallodu da </td> </tr> </table>";

*/
if($executingFetchQuery)
{
    echo "<th>Vorname</th><th>Nachname</th>";
    while($row = $executingFetchQuery->fetch_assoc())
    {
        echo "<tr>";
        echo "<td>";
        echo $row['vname'];
        echo "</td>";

        echo "<td>";
        if( $row['nname']=='Röcker')
        {
            echo 'ist toll';
        }
        else
        {
            echo $row['nname'];
        }

        echo "</td>";

        echo "</tr>";


    }

}
/*
print_r($resultArr);//print the rows returned by query, containing specified columns*/

?>