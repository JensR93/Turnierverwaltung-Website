<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Horizontale Navigation mit Overflow</title>
    <style>
        <link rel="stylesheet" href="css/bootstrap.css">
        body {
            margin:0;
            padding:0.5rem;
            font-family:tahoma;
        }
        .suchtextbox{
            max-width: 12rem;
            font-size: large;
            padding-top: 1.25rem;
            vertical-align: top;
            text-align: center;
            color: black;



        }
        .sucheheader{
            font-family: tahoma;
            font-size: x-large;
            font-style: normal;
        }
        nav {
            background:slategrey;
            width:100%;
            padding-top:0.5rem;
            font-size: large;
            overflow-x:auto;
            font-family: tahoma;
            -webkit-overflow-scrolling: touch;
        }

.suchbutton{
    background: image("imgs/flags/Deutschland.png");
}
        nav ul {
            margin:0;
            list-style:none;
            padding:0;

        }
        .suchtextboxclass{
            float: right;


            padding-top: 0px;
        }
        nav li {
            float:left;
            margin: 0 1rem;
        }


        nav a {
            color:white;
            text-decoration:none;
        }
        .aktuellesTurnier{

            float: inherit;

            color: white;
            font-weight: bold;
            font-size:x-large;

        }
        .menue{

            float: inherit;
            color: white;
            font-family: tahoma;
            font-size: x-large;

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
        <?php
        include "Funktionen/dbspieleabfrage_neu.php";

        $menue[0]="<li><a href=\"turnieruebersicht.php";
        $menue[1]="<li><a href=\"spielklassen.php";
        $menue[2]="<li><a href=\"spielklassen.php";
        $menue[3]="<li><a href=\"turnierbaum.php";

        if(isset($_GET['turnierid'])&&$_GET['turnierid']!="")
        {
            $turnierid=$_GET['turnierid'];
            for($i=0;$i<count($menue);$i++)
            {
                $menue[$i].="?turnierid=".$turnierid;
            }

            if(isset($_GET['spielklasseid'])&&$_GET['spielklasseid']!="") {
                $spielklasseid=$_GET['spielklasseid'];
                for($i=0;$i<count($menue);$i++)
                {
                    $menue[$i].="&spielklasseid=".$spielklasseid;
                }
            }
        }

        else
        {

        }

        $menue[0].="\">Turniersuche</a></li>";
        $menue[1].="\">Spielklassen</a></li>";
        $menue[2].="\">Spielübersicht</a></li>";
        $menue[3].="\">Turnierbaum</a></li>";



        echo"<nav class='menue'><ul><li>";
        for($i=0;$i<count($menue);$i++)
        {
            if($i==3)
            {
                if(isset($_GET["turnierid"]))
                {
                    echo $menue[$i];
                }
            }
            else{
            echo $menue[$i];
            }

        }
       echo"</li>";
        echo"<li class='suchtextboxclass'>";
        echo"<form class='sucheheader' action='spieleruebersicht.php?turnierid=&vname=&nname='>
   <input class='suchbutton' type='image' src='imgs/search-icon.png' value=''  >
        <input class ='suchtextbox' placeholder='Vorname' id=\"vname\" name=\"vname\">
   
    
        <input class ='suchtextbox' placeholder='Nachname' id=\"nname\" name=\"nname\">";
         /*<input  type='hidden' id=\"turnierid\" name=\"turnierid\" value='";
        if(isset($_GET['turnierid'])){
            echo $_GET['turnierid'];
        }
        else{
            echo "";
        }

        '>*/
    echo "
   

    
</form>";

        echo"</li></ul></nav>";
        if(isset($_GET['turnierid'])&&$_GET['turnierid']!="") {
            $turnierid = $_GET['turnierid'];
            $turniernameabfrage = "Select turnier.name from turnier where turnier.TurnierID=" . $_GET["turnierid"];
            $turniername = SpieleTabelleErzeugen($turniernameabfrage, "turniername");
            echo "<nav><ul><li class='aktuellesTurnier'>" . $turniername["turniername"][0];

            if (isset($_GET['spielklasseid']) && $_GET['spielklasseid'] != "") {
                $spielklasseid = $_GET['spielklasseid'];
                $spielklasseabfrage = "Select spielklasse.Disziplin, spielklasse.Niveau from spielklasse where spielklasse.SpielklasseID=" . $_GET["spielklasseid"];
                $spielklasse = SpieleTabelleErzeugen($spielklasseabfrage, "spielklassename");
                echo " - " . $spielklasse["spielklassename"][0];
            }
            echo "</li></ul></nav>";
        }
        else{
            echo "<nav><ul><li class='aktuellesTurnier'>KEIN TURNIER AUSGEWAEHLT</li></ul></nav>";
        }





/*
        if(!isset($_GET['turnierid']))
        {
            // echo "<li><a href='spielklassen.php?turnierid='>Spielklassentabelle_neu</a></li>";
            echo"<li><a href=\"spielklassen.php\">Spielklassentabelle_alt</a></li>";
        }
        if(isset($_GET['turnierid']) &&$_GET['turnierid']!="" && isset($_GET['spielklasseid']) ){
            $spielklasseabfrage = "Select spielklasse.Disziplin, spielklasse.Niveau from spielklasse where spielklasse.SpielklasseID=".$_GET["spielklasseid"];
            $spielklasse = SpieleTabelleErzeugen($spielklasseabfrage,"spielklassename");

            echo"<li><a href='turnierbaum.php?turnierid=".$_GET['turnierid']."&spielklasseid=".$_GET['spielklasseid']."'>Turnierbaum</a></li>";
        }
        else
        {

        }

        echo"<li><a href=\"spieleruebersicht.php?vname=&nname=\">Spielerübersicht</a></li>
        <li><a href=\"spieluebersichtfuerspieler.php\">spieluebersichtfuerspieler</a></li>
        ";
        echo"<li><a href=\"turnieruebersicht.php\">Turniersuche</a></li>";
        if(isset($_GET['turnierid'])&&$_GET['turnierid']!="") {

            $turniernameabfrage = "Select turnier.name from turnier where turnier.TurnierID=".$_GET["turnierid"];
            $turniername = SpieleTabelleErzeugen($turniernameabfrage,"turniername");


            echo "<li><a href='spielklassen.php?turnierid=" . $_GET['turnierid'] . "'>Spielklassentabelle_neu</a></li>";
        }

        */?>
    </ul>
    <?php
/*

    */?>
</nav>
</body>
</html>
