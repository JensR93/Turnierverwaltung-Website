<?php include 'dblogin.php'; ?>

<html>
    <head>
        <title>Badminton</title>
        <script> src="js/jquery-3.2.1.min.js" </script>
        <script> src="js/bootstrap.js" </script>

        <link rel="stylesheet" href="css/bootstrap.css">


    </head>

    <body>
<table border="1">
    <th>Vorname</th>
    <th>Nachname</th>
    <th>Geburtsdatums</th>
    <tr>
        <td>test</td>
        <td>test</td>
        <td>test</td>
    </tr>

    <?php

    $sql= "SELECT VName, NName, GDatum FROM spieler";
    $run_sql = mysqli_query($conn,$sql);

    while($rows  = mysqli_fetch_array($run_sql))
    {
        echo '<tr>
        <td>'.$rows['VNAME'].'</td>
        <td>'.$rows['NName'].'</td>
        <td>'.$rows['GDatum'].'</td>

        </tr>';
    }
    ?>
    <tr>
        <td>test</td>
        <td>test</td>
        <td>test</td>
    </tr>
</table>

    </body>
</html>

