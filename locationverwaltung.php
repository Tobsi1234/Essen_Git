<?php
session_start();
require("includes/includeDatabase.php");
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <link rel="stylesheet" href="css/demo.css">
    <link rel="stylesheet" href="css/listnav.css">

    <?php
    include("includes/includeHead.php");
    // include("procedures.php");
    ?>
    
</head>

<body>
<?php
include("includes/includeBody.php");
?>
<!-- Page Content -->
<div class="bigcontainer">

    <!-- First Featurette -->
    <div class="leftcontainer" id="about">
        <?php
        require('includes/includeDatabase.php');
        ?>
        <br><br>

        <div id="main" class="container">
            <ul class="nav navbar-nav">
                <li><a href="#page1">Location hinzufügen</a></li>
                <li><a href="#page2">Essen hinzufügen</a></li>
            </ul>
            <div class="clear"></div>
            <div id="pageContent">
                Hallo, auf dieser Seite können Sie neue Locations und Essen anlegen.
            </div>
        </div>
        <div class="clear"></div>


        <!--<div id="neueLocation">
            <h2>Location hinzufügen</h2>
            <div></div>
            <br><br>

            <form id="newloc" name="newloc" action="" method="post" onsubmit="loc_anlegen(); return false;">
                <label for="locname">Name der Location:</label>
                <input type="text" id="locname" maxlength="30" value="" style="margin-left:23px;">
                <br><br>
                <label for="locpage">Homepage: </label>
                <input type="text" id="locpage" maxlength="100" value="" style="margin-left:23px;">
                <br><br>
                <label for="verfuegbare_essen">Essensmöglichkeiten:</label>
                <select id="verfuegbare_essen" name="verfuegbare_essen">
                </select>
                <button type="button" onclick="essen_zuweisen();">Hinzufügen</button>
                <br><br>
                <select id="gewaehlte_essen" name="gewaehlte_essen" size="5">
                </select>
                <button type="button" onclick="essen_entfernen();">Entfernen</button>
                <br><br>

                <br><br>
                <button type="submit">Location speichern</button>
            </form>

        </div> -->
        <!--<div id="neuesEssen">
            <br><br>
            <h2>Essen hinzufügen</h2>
            <br><br>
            <form id="newessen" name="newessen" action="" method="post" onsubmit="essen_anlegen(); return false;">
                <label for="essenName">Name des Essens:</label>
                <input type="text" id="essenName" maxlength="30" value="" style="margin-left:23px;">
                <button type="submit">Essen speichern</button>

            </form>
        </div> -->
    </div>

    <!-- Alphabet -->
    <div class="rightcontainer">

        <div id="tabpage_3" class="tabContainer">

            <div class="listWrapper">
                
                <ul id="demoThree" class="demo">
                    <?php
                    $abfrage1 = "SELECT name,link FROM location ORDER BY name ASC";
                    $ergebnis1 = mysqli_query($connection, $abfrage1);

                    while ($row1 = mysqli_fetch_object($ergebnis1))
                    {
						if(strpos($row1->link, 'http') !== false) $linker = $row1->link;
                        else $linker = "http://". $row1->link;
                        ?> <li><a href="#" data-trigger="focus" data-toggle="popover" title="<?php echo $row1->name;?>" data-content="Link: <?php if($linker != "")echo "<a href='" . $linker . "'>$linker</a>";?>" data-html="true"><?php echo $row1->name;?></a></li> <?php
                    }
                    ?>
                </ul>
            </div>
    </div>
</div>


<?php
include("includes/includeFooter.php");
?>

<script src="js/jquery-listnav.js"></script>
<script src="js/vendor.js"></script>
<script>
    $(function(){
        $('#demoThree').listnav({
            initLetter: 'all',
            includeNums: true,
            allText: 'Alle',
            noMatchText: 'Keine Einträge für diesen Buchstaben vorhanden.'
        });
    });
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();
    });
</script>
</body>


</html>
