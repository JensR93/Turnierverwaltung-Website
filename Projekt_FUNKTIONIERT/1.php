<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Horizontale Navigation mit Overflow</title>
<style>

body {
	margin:0;
	font-family:Arial, sans-serif;
}

nav {
	background:slategrey;
	float:left;
	width:100%;
	padding:1em 0;
	overflow-x:auto;
	-webkit-overflow-scrolling: touch;
}


nav ul {
	margin:0;
	list-style:none;
	padding:0;
	width:698px;
}

nav li {
	float:left;
	margin: 0 1em;
}

nav a {
	color:white;
	text-decoration:none;
}

@media screen and (max-width:698px) {
	
	nav {
		box-shadow: inset -16px 0 20px -16px black;	
	}
	
}

</style>
</head>

<body>
<nav>
    <ul>
        <li><a href="#">Startseite</a></li>
        <li><a href="#">Bücher</a></li>
        <li><a href="#">Video-Trainings</a></li>
        <li><a href="#">Jobs</a></li>
        <li><a href="#">Kontakt</a></li>
        <li><a href="#">Newsletter</a></li>
        <li><a href="#">Impressum</a></li>
    </ul>
    <?php
    include 'suchleiste.php';

    ?>
</nav>
</body>
</html>
