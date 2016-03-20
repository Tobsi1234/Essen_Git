<?php
session_start();
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
			window.setTimeout(scrollen, 100);
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
				json1 = XMLreq.responseText;
				json2 = JSON.parse(json1);
				refChatAusgabe.innerHTML = "";
				for(var i=0; i<Object.keys(json2).length; i++) {
					json3 = JSON.parse(json2[i]);
					refChatAusgabe.innerHTML += "<b>" + json3.name + "</b>: " + json3.nachricht + "<br>";
				}
				json3 = JSON.parse(json2[Object.keys(json2).length - 1]);
			}
		}
		XMLreq.open('GET','chat_laden.php',true);
		XMLreq.send();
	}
	
	function chat_nachladen() {
		refChatAusgabe = document.getElementById('chat_ausgabe');

		if (window.XMLHttpRequest) {
			XMLreq = new XMLHttpRequest();
		} else if (window.ActiveXObject) {
			XMLreq = new ActiveXObject("Microsoft.XMLHTTP");
		}
		XMLreq.onreadystatechange=function() {
			if (XMLreq.readyState==4 && XMLreq.status==200) {
				jsonNeu1 = XMLreq.responseText;
				jsonNeu2 = JSON.parse(jsonNeu1);
				var jsonTest = json3.nachricht;
				jsonNeu3 = JSON.parse(jsonNeu2[Object.keys(jsonNeu2).length - 1]);
				if (jsonTest != jsonNeu3.nachricht) {
					refChatAusgabe.innerHTML = "";
					chat_laden();					
					window.setTimeout(scrollen, 100);
				}
			}
		}
		XMLreq.open('GET','chat_laden.php',true);
		XMLreq.send();
		window.setTimeout(chat_nachladen, 500);
	}
		
	function chat_verspätet() {
		window.setTimeout(chat_nachladen, 500);
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
<body>

<?php


	include ("includes/includeBody.php");
?>
	
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
			chat_verspätet();
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
						$abfrage2 = "SELECT name, essen FROM tabperson, tabbez WHERE tabperson.p_ID = tabbez.p_ID AND tabbez.d_ID = '$row1->d_ID'";
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
