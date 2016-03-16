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
	var XMLreq, name, refDatum, refEssenErgebnis, refNeu, refChatAusgabe, refChatEingabe, essen, heute, tag, monat, jahr, datum_heute, nachricht;
	var essenNamen = [];
	function name_ausgeben() {
		name = "<?php echo $_SESSION['username'] ?>";
		//alert("Hallo " + name);
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
	
	function chat_speichern() {
		if (window.XMLHttpRequest) {
			XMLreq = new XMLHttpRequest();
		} else if (window.ActiveXObject) {
			XMLreq = new ActiveXObject("Microsoft.XMLHTTP");
		}
		refChatEingabe = document.form1.nachricht;
		nachricht = refChatEingabe.value;
		if(nachricht) {
			URL = 'chat_speichern.php?nachricht=' + nachricht + '&name=' + name;
			XMLreq.open('GET', URL, false); 
			XMLreq.send(null);
		
			//alert(name + " hat " + nachricht + " hinzugefügt. Danke!");
			chat_laden();
			refChatEingabe.value = "";
			window.setTimeout(scrollen, 400);
		}
		else {
			//alert("Keine Nachricht :( ");
		}
		return false;
	}
	
	function chat_laden() {
		refChatAusgabe = document.getElementById('chat_ausgabe');

		if (window.XMLHttpRequest) {
			XMLreq = new XMLHttpRequest();
		} else if (window.ActiveXObject) {
			XMLreq = new ActiveXObject("Microsoft.XMLHTTP");
		}
		XMLreq.onreadystatechange=function() {
			if (XMLreq.readyState==4 && XMLreq.status==200) {
				refChatAusgabe.innerHTML = XMLreq.responseText;
			}
		}
		XMLreq.open('GET','chat_laden.php',true);
		XMLreq.send();
		window.setTimeout(chat_laden, 1000); //läd chat_laden() jede sekunde aus
	}
	function scrollen() {
		refChatAusgabe = document.getElementById('chat_ausgabe');
		refChatAusgabe.scrollTop = refChatAusgabe.scrollHeight;	
	}
	
	function scrollen_verspätet(){
		window.setTimeout(scrollen, 200);
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
                        <a href="edit.php">Abstimmung</a>
                    </li>
					<li>
                        <a href="">Essen hinzufügen</a>
                    </li>
					<li>
                        <a href="">Verlauf</a>
                    </li>
					<li>
                        <a href="">Einstellungen</a>
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
				<h2>Guten Appetit</h2>
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
			<script> name_ausgeben();</script>
			<div id="chat_border" style="border: 1px black solid; width: 400px; height: 300px; overflow: auto">
				<div id="chat_ausgabe" style="height:265px; overflow:auto;"></div>
				<hr style="width: 100%; height: 1px; margin: 0 auto; background: black;" />
				<div id="chat_eingabe">
					<form id="form1" name="form1" action="" method="post" onsubmit="chat_speichern(); return false;">
					<input id="nachricht" type="text" placeholder="schreiben..." /> 
					<button type="submit">Senden</button>
					</form>
				</div>
			</div>
			<script>
			chat_laden(); // läd chat jede sekunde neu.
			</script> 
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
	<script> essenErgebnis(); 
	scrollen_verspätet();
	</script>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"></script>


			
</body>
</html>
