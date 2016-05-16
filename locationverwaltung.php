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
    ?>

</head>

<body>
<?php
include("includes/includeBody.php");
?>
<!-- Page Content -->
        <div id="main" class="container weiß">
            <br>
            <div class="info">
                <legend>Verwaltung</legend>
                Diese Seite enthält eine Übersicht über alle Locations und Essen. Außerdem können noch fehlende Locations oder Essen hinzugefügt werden.
            </div>
            <ul class="nav navbar-nav" id="navbarPages">
                <li><a href="#locations"><img src="https://cdn.aldingerwolf.com/wp-content/uploads/2012/06/Stuttgart_Europaviertel_2.jpg" style="height: 250px; weight: 300px;"><br> <h3>Locationsverwaltung</h3></a></li>
                <li><a href="#essen"><img src="https://media2.popsugar-assets.com/files/2016/02/08/898/n/1922398/4c2124bfd07afeca_heart-shaped-pizza-2016.xxxlarge_2x.jpg" style="height: 250px; weight: 250px;"><br><h3>Essensverwaltung</h3></a></li>
            </ul>
            <div class="clear"></div>
            <br><br>
            <div id="pageContent">
            </div>
        </div>
        <div class="clear"></div>

<?php
include("includes/includeFooter.php");
?>


</body>


</html>
