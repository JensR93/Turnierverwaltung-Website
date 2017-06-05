<html>
<head>
    <title>PHP-Test</title>
    <script src="jquery-3.2.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $("button").click(function(){
                $("p").toggle();
            });
        });
    </script>

</head>

<body>
<button>Toggle between hiding and showing the paragraphs</button>

<p>This is a paragraph with little content.</p>
<p>This is another small paragraphsssssssssssssssssssssssssssss.</p>


<?php echo '<p>Hallo Welt</p>';


?>
</body>
</html>