<?php
session_start();
require("includes/includeDatabase.php");
?>
<!DOCTYPE html>
<html lang="de">
<head>

<?php
	include ("includes/includeHead.php");
?>

<script language="javascript"> 
<!--

	var XMLreq, name, refDatum, refEssenErgebnis, refNeu, refChatAusgabe, refChatEingabe, essen, heute, tag, monat, jahr, datum_heute, nachricht, json1, json2, json3, jsonNeu2, jsonNeu2, jsonNeu3;
	var essenNamen = [];
	function name_ausgeben() {
		name = "<?php if(isset($_SESSION['username']))echo $_SESSION['username'] ?>";
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
	

--> 
</script>
</head>
<body>

<?php
	include ("includes/includeBody.php");
?>
	
    <!-- Full Width Image Header 
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
	-->
    <!-- Page Content -->
    <div class="container" id="container" style="display: none">
        
        <!-- First Featurette -->
        <div class="featurette" id="about">
	
			<br><br>
			<script> name_ausgeben();</script>
			<div class="col-md-7">
				<div id="headline">
				<h1>Auswertung: </h1><br>
				</div>
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
							$abfrage2 = "SELECT username, e_ID1 FROM users, tabbez WHERE users.u_ID = tabbez.u_ID AND tabbez.d_ID = '$row1->d_ID'";
							$ergebnis2 = mysqli_query($connection, $abfrage2);
							while ($row2 = mysqli_fetch_object($ergebnis2))
								{	
							?>
							<p>
							Name: <?php echo $row2->username; ?> <br>
							Essen: <?php echo $row2->e_ID1; ?> <br> 
							<script> //für Ergebnis Berechnung
							if("<?php echo $row1->datum; ?>" == datum_heute) {
								var i = essenNamen.length;
								essenNamen[i] = "<?php echo $row2->e_ID1; ?>" 
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
			<div class="col-md-4 col-md-offset-1">
				<div id="chat_border">
					<div id="chat_ausgabe"></div>
					<hr id="chat_hr"/>
					<div id="chat_eingabe" style="margin-left: 10px">
						<form class="form-inline" role="form" id="form1" name="form1" action="" method="post" onsubmit="chat_speichern(); return false;">
						<input class="form-control" id="nachricht" type="text" placeholder="schreiben..."/> 
						<button class="btn btn-dafualt" type="submit">Senden</button>
						</form>
					</div>
				</div>
			</div>
        </div>
		<br><br>

		<script> 
			chat_laden(); // läd chat jede sekunde neu.
			chat_verspätet();
			essenErgebnis(); 
			scrollen_verspätet();
		</script>
    </div>
	<div id="loggedOutSeite" style="display: none">
		<h1> Willkommen </h1>
		<h2> Bitte logge dich ein :) </h2>
	</div>

	<?php 
		include ("includes/includeFooter.php");		
	?>	
</body>
</html>
