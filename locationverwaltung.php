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
<div class="bigcontainer">
        <br><br>
        <div id="main" class="container">
            <ul class="nav navbar-nav">
                <li><a href="#locations">Location hinzufügen</a></li>
                <li><a href="#essen">Essen hinzufügen</a></li>
            </ul>
            <div class="clear"></div>
            <div id="pageContent">
                Hallo, auf dieser Seite können Sie neue Locations und Essen anlegen.
            </div>
        </div>
        <div class="clear"></div>
</div>

<?php
include("includes/includeFooter.php");
?>


</body>


</html>
