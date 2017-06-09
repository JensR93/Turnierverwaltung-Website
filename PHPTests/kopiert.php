<html>
<head>
<?php
    include 'funktionen/dbspielerabfrage.php';
    include 'funktionen/dbspieleabfrage_neu.php';
    include 'funktionen/Einfuegen.php';
    include 'menu/1.php';
    ?>

</head>

<body>
<table class="ruler matches">
    <table class="ruler matches">
        <caption>
            Match overview of Friday, June 9, 2017
        </caption><thead>
        <tr>
            <td></td><td>Time</td><td>Draw</td><td colspan="3"></td><td>Score</td><td></td><td></td><td align="right">Duration</td><td>Court</td>
        </tr>
        </thead><tbody>
        <tr>
            <td></td><td class="plannedtime" align="right">9:00 AM</td><td><a href="./draw.aspx?id=0069D58F-0DCF-4271-A904-8E5BED47E710&draw=8">XD - Qualification</a></td><td align="right"><table align="Right">
                    <tr>
                        <td align="right"><strong><a class="plynk" href="player.aspx?id=0069D58F-0DCF-4271-A904-8E5BED47E710&player=126">Jesper Kristensen</a></strong></td><td><a href="matches.aspx?id=0069D58F-0DCF-4271-A904-8E5BED47E710&c=NOR"><img src="//static.tournamentsoftware.com/images/flags/16/NOR.png" class="intext flag" width="16" height="14" alt="Norway" title="Norway" /><span class="printonly flag">[NOR] </span></a></td>
                    </tr><tr>
                        <td align="right"><strong><a class="plynk" href="player.aspx?id=0069D58F-0DCF-4271-A904-8E5BED47E710&player=4">Stine Andersen</a></strong></td><td><a href="matches.aspx?id=0069D58F-0DCF-4271-A904-8E5BED47E710&c=NOR"><img src="//static.tournamentsoftware.com/images/flags/16/NOR.png" class="intext flag" width="16" height="14" alt="Norway" title="Norway" /><span class="printonly flag">[NOR] </span></a></td>
                    </tr>
                </table></td><td align="center">-</td><td><table>
                    <tr>
                        <td><a href="matches.aspx?id=0069D58F-0DCF-4271-A904-8E5BED47E710&c=LTU"><img src="//static.tournamentsoftware.com/images/flags/16/LTU.png" class="intext flag" width="16" height="14" alt="Lithuania" title="Lithuania" /><span class="printonly flag">[LTU] </span></a></td><td><a class="plynk" href="player.aspx?id=0069D58F-0DCF-4271-A904-8E5BED47E710&player=69">Tomas Dovydaitis</a></td>
                    </tr><tr>
                        <td><a href="matches.aspx?id=0069D58F-0DCF-4271-A904-8E5BED47E710&c=LTU"><img src="//static.tournamentsoftware.com/images/flags/16/LTU.png" class="intext flag" width="16" height="14" alt="Lithuania" title="Lithuania" /><span class="printonly flag">[LTU] </span></a></td><td><a class="plynk" href="player.aspx?id=0069D58F-0DCF-4271-A904-8E5BED47E710&player=70">Vaiva Zymantaite</a></td>
                    </tr>
                </table></td><td><span class="score"><span>21-13</span> <span>21-17</span></span></td><td></td><td><a href="../ranking/headtohead.aspx?id=209B123F-AA87-41A2-BC3E-CB57133E64CC&t1p1=13900&t1p2=89906&t2p1=90234&t2p2=58577" class="icon h2h"><img src="//static.tournamentsoftware.com/images/icon_h2h.gif" class="intext" width="18" height="14" title="View Head to head"/></a></td><td align="right">0:23</td><td><a href="./court.aspx?id=0069D58F-0DCF-4271-A904-8E5BED47E710&crtid=1">Kaunas sport hall - Court1</a></td>
        </tr><tr>

                </table>

</body>
</html>
<?php
/**
 * Created by IntelliJ IDEA.
 * User: jens
 * Date: 09.06.2017
 * Time: 14:48
 *
 */


//echo $zahl = SpieleTabelleErzeugen("SELECT SpielID, Feld, Heim, Gast FROM spiel WHERE Heim = 1 or Gast = 1");
/*
SELECT spieler.VName, spieler.NName, spiel.Feld, spiel_ergebnis.Satz1_heim, spiel_ergebnis.Satz1_gast, spiel_ergebnis.Satz2_heim, spiel_ergebnis.Satz2_gast,
spiel_ergebnis.Satz3_heim, spiel_ergebnis.Satz3_gast FROM spieler INNER JOIN spiel ON spieler.SpielerID=spiel.Gast INNER JOIN spiel_ergebnis ON spiel.SpielID=spiel_ergebnis.SpielID
*/
/*
echo $a= SpieleTabelleErzeugen("SELECT spieler.VName, spieler.NName, spiel.Feld, spiel.AufrufZeit, spiel_ergebnis.Satz1_heim, spiel_ergebnis.Satz1_gast, 
spiel_ergebnis.Satz2_heim, spiel_ergebnis.Satz2_gast, spiel_ergebnis.Satz3_heim, spiel_ergebnis.Satz3_gast, spielklasse.Disziplin, spielklasse.Niveau FROM spieler 
INNER JOIN spiel ON spieler.SpielerID=spiel.Gast INNER JOIN spiel_ergebnis ON spiel.SpielID=spiel_ergebnis.SpielID INNER JOIN spielklasse on spiel.SpielklasseID=spielklasse.SpielklasseID");
*/
$joinabfrage="SELECT spiel.Feld, spiel.AufrufZeit, spiel_ergebnis.Satz1_heim, spiel_ergebnis.Satz1_gast,
 spiel_ergebnis.Satz2_heim, spiel_ergebnis.Satz2_gast, spiel_ergebnis.Satz3_heim, spiel_ergebnis.Satz3_gast, spielklasse.Disziplin, 
 spielklasse.Niveau FROM spieler INNER JOIN spiel ON spieler.SpielerID=spiel.Gast INNER JOIN spiel_ergebnis ON spiel.SpielID=spiel_ergebnis.SpielID 
 INNER JOIN spielklasse on spiel.SpielklasseID=spielklasse.SpielklasseID";

$gast = SpieleTabelleErzeugen("SELECT spieler.VName AS gast_vname, spieler.NName AS gast_nname From spieler INNER JOIN spiel ON spieler.SpielerID=spiel.Gast","gast");
$heim = SpieleTabelleErzeugen("SELECT spieler.VName AS heim_vname, spieler.NName AS heim_nname From spieler INNER JOIN spiel ON spieler.SpielerID=spiel.Heim","heim");
$join= SpieleTabelleErzeugen($joinabfrage, "join");
$ergebnis= SpieleTabelleErzeugen($joinabfrage, "erg");

for($i=0;$i<count($gast);$i++)
{
    echo "join:".$join[$i];
    echo "heim:".$heim[$i];
    echo "Gast:".$gast[$i];
   echo "Ergebnis:".$ergebnis[$i];
    echo "<br/>";
}
/*
for($i=0;$i<count($heim);$i++)
{
    echo "heim:".$heim[$i];
    echo "<br/>";
}
for($i=0;$i<count($join);$i++)
{
    echo "join:".$join[$i];
    echo "<br/>";
}
*/
?>