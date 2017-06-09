
<html>
    <head>
        <title>Badminton</title>
        <script> src="js/jquery-3.2.1.min.js" </script>
        <script> src="js/bootstrap.js" </script>

        <link rel="stylesheet" href="css/bootstrap.css">



    </head>

    <body>

    <?php
    echo "php start";

    $con = mysqli_connect( "127.0.0.1" , "root" , "" , "turnierverwaltung");

    // Check connection
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    echo "php end";

    mysqli_query( $con , "INSERT INTO users values ( 'id' , 'smith' , 'joe' , 'joepass' )");

    mysqli_close($con);

    echo "php end";
    ?>

    </body>
</html>

