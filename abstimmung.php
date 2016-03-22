<?php
session_start();
if(!isset($_SESSION['userid'])) {
	die('Bitte zuerst <a href="index.php">einloggen</a>');
}
?>
<!DOCTYPE html>
<html lang="de">
<head>

<?php
	include ("includes/includeHead.php");
?>  

<script language="javascript"> 
<!--
	var XMLreq, name, refEssen, refDatum, refNeu, refMenu1, refVerfügbar, selectedEssen, essen, heute, tag, monat, jahr, datum_heute;
	function name_ausgeben() {
		name = "<?php echo $_SESSION['username'] ?>";
		//alert("Hallo " + name);
	}
	
	function form_name() {
		document.getElementById('name').value = name;
	}
	
	function form_neu() {

		refNeu = document.form2.name;
		neu = refNeu.value;
		if(neu) {
			window.location.href = "edit.php?name=" + neu;		
			//alert(name + " hat " + neu + " hinzugefügt. Danke!");
			
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

	function essen_zuweisen() {
		var essenArr = [];
		refEssen = document.form1.essen;
		essenArr = checkboxWert(refEssen);

		var box = document.getElementById("gewaehlte_essen");
		for(var i=0; i<essenArr.length; i++) {
			var meinEssen = essenArr[i];
			
			var error = false;

			for (var j = 0; j<box.options.length; j++) {
				if (box.options[j].text == meinEssen) {
					error = true;
				}
			}
			if(error == false) {
				if(meinEssen && box.options.length < 2) {
					element = document.createElement("option");
					element.appendChild(document.createTextNode(meinEssen));
					box.appendChild(element);
				}
				else {
					alert("Höchstens 2 Essen pro Location");
				}
			}
		}
		return false;
	}
	
	function essen_entfernen() {
		box = document.getElementById("gewaehlte_essen");
		box.remove(box.selectedIndex);
	}
	
	function checkboxWert(rObj) {
		//gibt die ausgewählten Checkboxen zurück
		var arr = []
		for (var i=0; i<rObj.length; i++) {
			if (rObj[i].checked) {
				if(rObj[i].value == "Sonstiges") {
					refVerfügbar = document.form1.verfuegbare_essen;
					selectedEssen = refVerfügbar.value;
					arr[arr.length] = selectedEssen;
				}
				else {
					arr[arr.length] = rObj[i].value;
				}
			}
		}
		return arr;
	}
	
	function f_datum_heute() {
		heute = new Date();
		tag = heute.getDate();
		monat = heute.getMonth() + 1;
		jahr = heute.getFullYear();
		datum_heute = tag + "." + monat + "." + jahr;
		//refDatum = document.getElementById('datum');
		//refDatum.innerHTML = datum_heute;
		refMenu1 = document.getElementById('menu1');
		refMenu1.innerHTML = datum_heute;
		return false;
	}
	function f_datum_morgen() {
		heute = new Date();
		tag = heute.getDate() + 1;
		monat = heute.getMonth() + 1;
		jahr = heute.getFullYear();
		datum_morgen = tag + "." + monat + "." + jahr;
		//refDatum = document.getElementById('datum');
		//refDatum.innerHTML = datum_heute;
		refMenu1 = document.getElementById('menu1');
		refMenu1.innerHTML = datum_morgen;
		return false;
	}
	function f_datum_uebermorgen() {
		heute = new Date();
		tag = heute.getDate() + 2;
		monat = heute.getMonth() + 1;
		jahr = heute.getFullYear();
		datum_uebermorgen = tag + "." + monat + "." + jahr;
		//refDatum = document.getElementById('datum');
		//refDatum.innerHTML = datum_heute;
		refMenu1 = document.getElementById('menu1');
		refMenu1.innerHTML = datum_uebermorgen;
		return false;
	}
	
	function f_datum() {
		heute = new Date();
		tag = heute.getDate();
		monat = heute.getMonth() + 1;
		jahr = heute.getFullYear();
		datum_heute = tag + "." + monat + "." + jahr;
		refDatum = document.getElementById('datum');
		refDatum.innerHTML = datum_heute;
		return false;
	}
	
--> 
</script>
</head>
<body>
<?php
	include ("includes/includeBody.php");
?>

	<?php
		require('password.php');
		if (isset($_GET["name"])) {
		$name = htmlspecialchars($_GET["name"]);
		$sqli1 = "INSERT INTO tabessen (name) VALUES ('$name')";
		$result1 = mysqli_query($connection, $sqli1);
		}
	?>
    <!-- Full Width Image Header -->
    <header class="header-image">
            <div class="container">
				<br><br><br>
				<div id="datum" style="float:right">
				<script> f_datum();</script>
				</div>
            </div>
    </header>

    <!-- Page Content -->
    <div class="container"><br>
        <div style="float:left; width:30px;"><label>Datum: </label></div><div class="dropdown" style="margin-left:68px;">
			<button class="btn btn-primary dropdown-toggle" id="menu1" type="button" data-toggle="dropdown">Datum
			<span class="caret"></span></button>
			<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
				<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)" onclick="f_datum_heute();">Heute</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)" onclick="f_datum_morgen();">Morgen</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)" onclick="f_datum_uebermorgen();">Übermorgen</a></li>   
			</ul>
		</div>
		<br>
		<script> f_datum_heute();</script>
        <!-- First Featurette -->
        <div class="featurette" id="about">
			<?php
			require('password.php');
			?>
			<div>
				<form id="form1" name="form1" action="" method="post" onsubmit="form_essen(); return false;">
				<label for="name"> Name: </label> 
				<input type="text" id="name" maxlength="30" value="Name" disabled="disabled" style="margin-left:20px;">
				<script> form_name(); </script> <br><br>
				<label for="name"> Essensmöglichkeiten: </label> 
				<input type="checkbox" id="essen" name="essen" value="Bäcker" style="margin-left:15px"> <label for="">Bäcker </label>
				<input type="checkbox" id="essen" name="essen" value="Döner" style="margin-left:15px"> <label for="">Döner </label>
				<input type="checkbox" id="essen" name="essen" value="Pizza" style="margin-left:15px"> <label for="">Pizza </label>
				<input type="checkbox" id="essen" name="essen" value="Sonstiges" style="margin-left:15px"> <label for=""></label>
				
				<select id="verfuegbare_essen">
				<?php
				$abfrage0 = "SELECT * FROM tabessen ORDER BY name ASC";
				$ergebnis0 = mysqli_query($connection, $abfrage0);
				while ($row0 = mysqli_fetch_object($ergebnis0))
					{
						?>
						<!--<input type="checkbox" id="essen" name="essen" value="<?php echo $row0->name; ?>" style="margin-left:15px"> <label for=""><?php echo $row0->name; ?> </label>-->
						
						<option><?php echo $row0->name; ?> </option>
						<?php
					}
					?>
					</select>

				<br><br>
				<button type="button" onclick="essen_zuweisen();">Hinzufügen</button>
				<br><br>
				<select id="gewaehlte_essen" name="gewaehlte_essen" size="5">
				</select>
				<button type="button" onclick="essen_entfernen();">Entfernen</button>

				<br><br>
				<button type="submit">Auswahl speichern</button>
				</form>
				<br><br><br>
				<form id="form2" name="form2" action="" method="post" onsubmit="form_neu(); return false;">
				<label for="name"> Neue Essensmöglichkeit: </label> 
				<input type="text" id="name" maxlength="30" value="" style="margin-left:23px;">
				<br><br>
				<button type="submit">Essensmöglichkeit hinzufügen</button>
				</form><br><br>
			</div>
			<br><br>
			<script> name_ausgeben(); </script>
			</div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"></script>


			
</body>
</html>
