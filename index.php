<?php
session_start();
?>
<!DOCTYPE html>
<html lang="de">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Essen</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/one-page-wonder.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<script language="javascript">
<!--
	var username, password;	
	function myFunction() {
		username = prompt("Please enter your name");
		password = prompt("Please enter your password");

		window.location.href = "index.php?username=" + username + "&password=" + password;
		
		<?php
		if (isset($_GET["username"]) && isset($_GET["password"] )) {
		$_SESSION["username"] = $_GET["username"];
		$_SESSION["password"] = $_GET["password"];
		}
		?>	
	}   
-->
</script>
<script language="javascript"> 
<!--
	var name, refHeadline, refEssen, refDatum, refEssenErgebnis, refNeu, essen, heute, tag, monat, jahr, datum_heute;
	var essenNamen = [];
	var abbruch = 0;
	function name_ausgeben() {
		name = "<?php echo $_SESSION['username'] ?>";
		//alert("Hallo " + name);
	}

	function headline() {
		refHeadline;
		refHeadline = document.getElementById('headline');
		refHeadline.innerHTML = "<h2>Guten Appetit</h2>";
	}
	
	function form_name() {
		document.getElementById('name').value = name;
	}
	
	function form_neu() {
		if (window.XMLHttpRequest) {
			XMLreq = new XMLHttpRequest();
		} else if (window.ActiveXObject) {
			XMLreq = new ActiveXObject("Microsoft.XMLHTTP");
		}
		refNeu = document.form2.name;
		neu = refNeu.value;
		if(neu) {
			URL = 'neu_DB.php?name=' + neu;
			XMLreq.open('GET', URL, false); 
			XMLreq.send(null);
		
			alert(name + " hat " + neu + " hinzugefügt. Danke!");
		}
		else {
			alert("Keine Auswahl");
		}
		return false;
		
	}
	function form_essen() {
		
		if (window.XMLHttpRequest) {
			XMLreq = new XMLHttpRequest();
		} else if (window.ActiveXObject) {
			XMLreq = new ActiveXObject("Microsoft.XMLHTTP");
		}
		refEssen = document.form1.essen;
		essen = radioWert(refEssen);
		//alert(name + " wählt: " + essen);
		
		URL = 'essen_DB.php?name=' + name + '&essen=' + essen + '&datum=' + tag + '.' + monat + '.' + jahr;
		XMLreq.open('GET', URL, false); 
		XMLreq.send(null);
		alert(name + " hat " + essen + " gewählt. Danke!");
		return false;
	}
	
	function radioWert(rObj) {
    //gibt den ausgewählten RadioButton zurück
    for (var i=0; i<rObj.length; i++) if (rObj[i].checked) return rObj[i].value;
    return false;
	}
	
	function datum() {
		heute = new Date();
		tag = heute.getDate();
		monat = heute.getMonth() + 1;
		jahr = heute.getFullYear();
		datum_heute = tag + "." + monat + "." + jahr;
		refDatum = document.getElementById('datum');
		refDatum.innerHTML = datum_heute;
		//$.post('index.php', {variable: datum_heute});
	}
	
	function essenErgebnis() {
		refEssenErgebnis = document.getElementById('essenErgebnis');
		var count = 1, temp = 0, tempCount;
		var popular = essenNamen[0];
		for (var i = 0; i < (essenNamen.length - 1); i++)
		{
			temp = essenNamen[i];
			tempCount = 0;
			for (var j = 1; j < essenNamen.length; j++)
			{
				if (temp == essenNamen[j])
				tempCount++;
			}
			if (tempCount > count)
			{
				popular = temp;
				count = tempCount;
			}
		}
		refEssenErgebnis.innerHTML = popular;
/*		else {
			var rand = Math.floor(Math.random() * essenNamen.length);
			refEssenErgebnis.innerHTML = essenNamen[rand];
		}	*/	
	}
--> 
</script>
</head>
<body> <!-- test -->
<?php

	$currentUsername = null;
	$currentPassword = null;
	if (isset($_SESSION["username"]) && isset($_SESSION["password"] )) {

	$currentUsername = $_SESSION["username"];
	$currentPassword = $_SESSION["password"];
	}

	if ((!($currentUsername=="Tobias" and $currentPassword=="Tobias_1a2s3d")) && (!($currentUsername=="Dominik" and $currentPassword=="Dominik_1a2s3d")) && (!($currentUsername=="Quentin" and $currentPassword=="Quentin_1a2s3d"))&& (!($currentUsername=="Tilo" and $currentPassword=="Tilo_1a2s3d")))
	{
		  echo("Lädt...");
		  echo "<script type='text/javascript'>myFunction();</script>";
	}
?>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Startseite</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="edit.php">Bearbeiten</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Full Width Image Header -->
    <header class="header-image">
        <div class="headline">
            <div class="container">
				<div id="headline">
				</div>
				<div id="datum" style="float:right">
				<script> datum();</script>
				</div>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <div class="container">
        
        <!-- First Featurette -->
        <div class="featurette" id="about">
			<?php
			require('password.php');
			?>
			<br><br>
			<script> name_ausgeben(); headline();</script>

			<div>
			Ergebnis von heute : <div id="essenErgebnis"> </div><br><br>
			<?php			
			$abfrage1 = "SELECT * FROM tabdatum ORDER BY d_ID DESC";
			$ergebnis1 = mysqli_query($connection, $abfrage1);
			//$datum = mysqli_result(mysqli_query($connection, "SELECT datum FROM tabelle1 LIMIT 1"),0);
			//echo "Essenswünsche am ". $datum . "<br><br>";
			while ($row1 = mysqli_fetch_object($ergebnis1))
				{	
					?>
					<p>
					Datum: <?php echo $row1->datum; ?> <br>
					<?php
						$abfrage2 = "SELECT name, essen FROM tabname, tabbez WHERE tabname.n_ID = tabbez.n_ID AND tabbez.d_ID = '$row1->d_ID'";
						$ergebnis2 = mysqli_query($connection, $abfrage2);
						while ($row2 = mysqli_fetch_object($ergebnis2))
							{	
						?>
						<p>
						Name: <?php echo $row2->name; ?> <br>
						Essen: <?php echo $row2->essen; ?> <br> 
						<script> 
						if("<?php echo $row1->datum; ?>" == datum_heute) {
							var i = essenNamen.length;
							essenNamen[i] = "<?php echo $row2->essen; ?>" 
						}
						</script>
						</p>
						<?php
						}
					?>					
					</p>
					<hr>
					<?php
				}
			?>
			</div>
        </div>
    </div>
	<script> essenErgebnis(); </script>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"></script>


			
</body>
</html>
