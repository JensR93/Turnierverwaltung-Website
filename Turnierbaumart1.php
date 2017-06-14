<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>.: Brackets :.</title>
<?php
    include 'Projekt_FUNKTIONIERT/Funktionen/dbspieleabfrage_neu.php';?>
</head>
<body>


<?php
$spielklasseid=1;
$gastabfrage = "SELECT  spieler.SpielerID, spieler.VName AS gast_vname, spieler.NName AS gast_nname, spiel.RundenID, spiel.NextSpiel From spieler 
    INNER JOIN spiel ON spieler.SpielerID=spiel.Gast WHERE spiel.SpielklasseID=" . $spielklasseid;
$heimabfrage = "SELECT  spieler.SpielerID, spieler.VName AS heim_vname, spieler.NName AS heim_nname From spieler 
    INNER JOIN spiel ON spieler.SpielerID=spiel.Heim WHERE spiel.SpielklasseID=" . $spielklasseid;


$gast = SpieleTabelleErzeugen($gastabfrage, "gast_neu");
$heim = SpieleTabelleErzeugen($heimabfrage, "heim");

$spielabfrage= "select spiel.RundenID,spiel.NextSpiel, spiel.SpielklasseID from spiel where RundenID LIKE \"13%\"";
$spiel= SpieleTabelleErzeugen($spielabfrage,"spielabfrage");
$erg=array_merge($spiel,$gast,$heim);

for ($i = 0; $i < count($erg["rundenid"]); $i++) {

    echo "i=".$i;}
    ?>
    <script>
        var titles = ['Ronda 1', 'Ronda 2', 'Ronda 3', 'Ronda 4'];
        var rounds;
        rounds = [ [

            {
                player1: { name: "Player 113", winner: true, ID: 113 },
                player2: { name: "Player 218", winner: true, ID: 218 },
            },
        ],
            //-- Champion
            [

                {
                    player1: { name: "Player 113", winner: true, ID: 113 },
                },
            ],

        ];
    </script>
    <?php





$i=0;

/*
while($erg["rundenid"][$i]!="ABBRUCH") {
    echo "Aktuell:".$aktuellesSpiel."<br/>";
    $spielabfrage= "select spiel.RundenID,spiel.NextSpiel, spiel.SpielklasseID from spiel where NextSpiel =".$erg["nextspiel"][$i];

$i++;
}

while($erg["rundenid"][$i]!="ABBRUCH")
{




    echo "Aktuell:".$aktuellesSpiel."<br/>";
    $spielabfrage= "select spiel.RundenID,spiel.NextSpiel, spiel.SpielklasseID from spiel where NextSpiel =".$erg["nextspiel"][$i];
    $spiel= SpieleTabelleErzeugen($spielabfrage,"spielabfrage");
    $aktuellesSpiel =$spiel["rundenid"][$i];
    $erg=array_merge($erg,$spiel);
    echo "Inhalt".$erg["rundenid"][0];
    if($erg["rundenid"][$i]=="ABBRUCH")
    {
        echo"<br/>". "Fertig";
        echo "Inhalt".$erg["rundenid"][0];
    }
    else
    {


    echo"<br/>". $i;
    }
    $i++;
}

    //$anzahlspielabfrage= "SELECT count(spiel.SpielID) FROM spiel WHERE SpielklasseID=".$erg["SpielklasseID"][0];


    $erg=array_merge($erg,$spiel);
    $anzahlspiele =SpieleTabelleErzeugen($anzahlspielabfrage,"anzahlspielabfrage");*/



/*for ($i = 0; $i < count($gast["gastid"]); $i++) {

    echo $erg["rundenid"][$i]."<br/>";
    echo $erg["nextspiel"][$i]."<br/>";
    echo $erg["gast"][$i]."<br/>";
    echo $erg["gastid"][$i]."<br/>";
    echo $erg["heimid"][$i]."<br/>";



}*/

?>


<h1 class="title">.: Brackets :.</h1>

<div class="wrapper">

    <div class="brackets">
    </div>

</div>

<script src="js/jquery-1.11.3.js"></script>
<script src="js/brackets.min.js"></script>

<script>

   /* var rounds;

    rounds = [


        //-- ronda 1
        [

            {
                player1: { name: "Player 111", winner: true, ID: 111, url: 'http://www.google.com' },
                player2: { name: "Player 211", ID: 211 }
            },

            {
                player1: { name: "Player 112", winner: true, ID: 112 },
                player2: { name: "Player 212", ID: 212 }
            },

            {
                player1: { name: "Player 113", winner: true, ID: 113 },
                player2: { name: "Player 213", ID: 213 }
            },

            {
                player1: { name: "Player 114", winner: true, ID: 114 },
                player2: { name: "Player 214", ID: 214 }
            },

            {
                player1: { name: "Player 115", winner: true, ID: 115, url: 'goggle.com' },
                player2: { name: "Player 215", ID: 215 }
            },

            {
                player1: { name: "Player 116", winner: true, ID: 116 },
                player2: { name: "Player 216", ID: 216 }
            },

            {
                player1: { name: "Player 117", winner: true, ID: 117 },
                player2: { name: "Player 217", ID: 217 }
            },

            {
                player1: { name: "Player 118", winner: true, ID: 118 },
                player2: { name: "Player 218", ID: 218 }
            },
        ],

        //-- ronda 2
        [

            {
                player1: { name: "Player 111", winner: true, ID: 111 },
                player2: { name: "Player 212", ID: 212 }
            },

            {
                player1: { name: "Player 113", winner: true, ID: 113 },
                player2: { name: "Player 214", ID: 214 }
            },

            {
                player1: { name: "Player 115", winner: true, ID: 115 },
                player2: { name: "Player 216", ID: 216 }
            },

            {
                player1: { name: "Player 117", winner: true, ID: 117 },
                player2: { name: "Player 218", ID: 218 }
            },
        ],

        //-- ronda 3
        [

            {
                player1: { name: "Player 111", winner: true, ID: 111 },
                player2: { name: "Player 113", ID: 113 }
            },

            {
                player1: { name: "Player 115", winner: true, ID: 115 },
                player2: { name: "Player 218", ID: 218 }
            },
        ],

        //-- ronda 4
        [

            {
                player1: { name: "Player 113", winner: true, ID: 113 },
                player2: { name: "Player 218", winner: true, ID: 218 },
            },
        ],
        //-- Champion
        [

            {
                player1: { name: "Player 113", winner: true, ID: 113 },
            },
        ],

    ];

    var titles = ['Ronda 1', 'Ronda 2', 'Ronda 3', 'Ronda 4', 'Ronda 5'];

*/
    ;(function($){

        $(".brackets").brackets({
            titles: titles,
            rounds: rounds,
            color_title: 'black',
            border_color: '#00F',
            color_player: 'black',
            bg_player: 'white',
            color_player_hover: 'white',
            bg_player_hover: 'blue',
            border_radius_player: '10px',
            border_radius_lines: '10px',
        });

    })(jQuery);
</script>

</body>
</html>