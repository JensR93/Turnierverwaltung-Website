<?php

function SpielerEinfuegen($sql)
{
    include 'dblogin.php';


// Create connection
    $conn = new mysqli($localhost, $user, $pw, $db);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully<br></br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>