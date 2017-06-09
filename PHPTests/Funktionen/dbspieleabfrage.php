<?php
/**
 * Created by IntelliJ IDEA.
 * User: jens
 * Date: 09.06.2017
 * Time: 03:05
 */

function SpieleTabelleErzeugen($sql)
{
    include 'dblogin.php';

    $mysqli = new mysqli($localhost, $user, $pw, $db);
    if($mysqli->connect_errno>0)
    {
        die("Connection to MySQL-server failed!");
    }
    $resultArr = array();//to store results
//to execute query
    $executingFetchQuery = $mysqli->query($sql);
    echo"<table border ='1'>";

    $return ="";
    if($executingFetchQuery)
    {

        while($row = $executingFetchQuery->fetch_assoc())
        {
            $return=$return  . "<tr>". "<td>". $row['VName'];


            $return=$return  ."<td>". $row['NName']. "</td>";
            $return=$return. "<td>". $row['Feld']."</td>";
            if($row['AufrufZeit']!=null && $row['Satz1_gast']!=null)
            {
                $return=$return. "<td>". $row['AufrufZeit']."</td>";
            }

            $return=$return. "<td>". $row['Disziplin']." ".$row['Niveau']."</td>";


            if($row['Satz1_heim']!=null && $row['Satz1_gast']!=null)
            {
                $return = $return . "<td>" . $row['Satz1_heim'] . "</td>";
                $return = $return . "<td>" . $row['Satz1_gast'] . "</td>";
                if($row['Satz2_heim']!=null && $row['Satz2_gast']!=null) {
                    $return = $return . "<td>" . $row['Satz2_heim'] . "</td>";
                    $return = $return . "<td>" . $row['Satz2_gast'] . "</td>";
                    if($row['Satz3_heim']!=null && $row['Satz3_gast']!=null)
                    {
                        $return=$return."<td>".$row['Satz3_heim']."</td><td>".$row['Satz3_gast']."</td>";
                    }
                }
            }
            $return=$return."</tr>";







//            $return=$return  . "Vorname ".$row['vname']. "Nachname".$row['nname'] ;


        }

    }

    echo "test";
    return $return;
}
?>