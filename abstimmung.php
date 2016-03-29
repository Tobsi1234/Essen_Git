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
	var XMLreq, name, refEssen, refDatum, refNeu, refMenu1, refVerfügbar, selectedEssen, essen, heute, tag, monat, jahr, datum_heute;
	function name_ausgeben() {
		name = "<?php echo $_SESSION['username'] ?>";
		u_ID = "<?php echo $_SESSION['userid'] ?>";

		//alert("Hallo " + name);
	}
	
	function form_name() {
		document.getElementById('name').value = name;
	}
	
	function form_essen() {
		
		if (window.XMLHttpRequest) {
			XMLreq = new XMLHttpRequest();
		} else if (window.ActiveXObject) {
			XMLreq = new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		var essenArr = [];
		refEssen = document.forms['form1'].essen;
		essenArr = checkboxWert(refEssen);
		var datum = tag + '.' + monat + '.' + jahr;
		if(essenArr.length > 0 && essenArr.length < 3) {
			if(essenArr.length == 1) {
				$.ajax({
					type: "POST",
					url: "procedures.php",
					data: {callFunction: 'abstimmen', u_ID: u_ID, essen1: essenArr[0], datum: datum},
					dataType: 'text',
					success:function(data) {
						//alert(data);
					}
				});
			}
			else {
			$.ajax({
					type: "POST",
					url: "procedures.php",
					data: {callFunction: 'abstimmen', u_ID: u_ID, essen1: essenArr[0], essen2: essenArr[1], datum: datum},
					dataType: 'text',
					success:function(data) {
						//alert(data);
					}
				});
			}

			alert(name + " hat " + essenArr[0] + " und " + essenArr[1] + " gewählt. Danke!");
		}
		else {
			alert("Bitte wähle mindestens ein, höchstens zwei Essen aus.");
		}

		return false; 
	}
	
	function checkboxWert(rObj) {
		//gibt die ausgewählten Checkboxen zurück
		var arr = []
		for (var i=0; i<rObj.length; i++) {
			if (rObj[i].checked) {
				if(rObj[i].value == "Sonstiges1") {
					arr[arr.length] = $('#verfuegbare_essen').val();
				}
				else if(rObj[i].value == "Sonstiges2") {
					arr[arr.length] = $('#verfuegbare_essen2').val();
				}
				else {
					arr[arr.length] = rObj[i].value;
				}
			}
		}
		return arr;
	}
	
	// zeigt zweiten Selector nur an, wenn erster bereits ausgewählt wurde
	function validate(){

		if ($('#sonstiges1').is(':checked')){
			$('#sonstiges2').css('display', 'inline-block');
			$('#verfuegbare_essen2').css('display','inline-block');

		}else{
			$('#sonstiges2').css('display', 'none');
			$('#verfuegbare_essen2').css('display','none');
		}
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
		require('includes/includeDatabase.php');
		if (isset($_GET["name"])) {
		$name = htmlspecialchars($_GET["name"]);
		$sqli1 = "INSERT INTO tabessen (name) VALUES ('$name')";
		$result1 = mysqli_query($connection, $sqli1);
		}
	?>
    <!-- Full Width Image Header 
    <header class="header-image">
            <div class="container">
				<br><br><br>
				<div id="datum" style="float:right">
				<script> f_datum();</script>
				</div>
            </div>
    </header> -->

    <!-- Page Content -->
    <div class="container">

        <!-- First Featurette -->
        <div class="featurette" id="about">
		 	<br><br>
			<script> name_ausgeben(); </script>
			<?php
			require('includes/includeDatabase.php');
			?>
			<div>
				<div class="col-md-7">
					<div id="headline">
					<h1>Abstimmung: </h1><br>
					</div>
				    <div style="float:left; width:30px;"><label>Datum: </label>
					</div>
					<div class="dropdown" style="margin-left:68px;">
						<button class="btn btn-default dropdown-toggle" id="menu1" type="button" data-toggle="dropdown">Datum
						<span class="caret"></span></button>
						<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)" onclick="f_datum_heute();">Heute</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)" onclick="f_datum_morgen();">Morgen</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)" onclick="f_datum_uebermorgen();">Übermorgen</a></li>   
						</ul>
					</div>
					<br>
					<script> f_datum_heute();</script>
					<form class="form-inline" id="form1" name="form1" action="" method="post" onsubmit="form_essen(); return false;">
						<div class="form-group">
							<label for="name"> Name: </label> 
							<input class="form-control" type="text" id="name" maxlength="30" value="Name" disabled="disabled" style="margin-left:20px;">
						</div>
						<script> form_name(); </script> <br><br>
						<label for="name"> Essensmöglichkeiten: </label> 
						<input class="form-control" type="checkbox" id="bäcker" name="essen" value="Bäcker" style="margin-left:15px"> <label for="">Bäcker </label>
						<input class="form-control" type="checkbox" id="döner" name="essen" value="Döner" style="margin-left:15px"> <label for="">Döner </label>
						<input class="form-control" type="checkbox" id="pizza" name="essen" value="Pizza" style="margin-left:15px"> <label for="">Pizza </label>
						<input class="form-control" type="checkbox" id="sonstiges1" name="essen" value="Sonstiges1" style="margin-left:15px" onclick="validate();"> <label for=""></label>
						
						<select class="form-control" id="verfuegbare_essen">
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

						<input class="form-control" type="checkbox" id="sonstiges2" name="essen" value="Sonstiges2" style="margin-left:15px; display:none;" >

						<select class="form-control" id="verfuegbare_essen2" style="display:none">
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
						<button type="submit" class="btn btn-primary">Auswahl speichern</button>
					</form>

					<br><br>
				</div>
				<div class="col-md-4 col-md-offset-1">
					<div id="chat_border">
						<div id="chat_ausgabe">
						</div>
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
			</div>
        </div>
		<script> 
			chat_laden(); // läd chat jede sekunde neu.
			chat_verspätet();
			essenErgebnis(); 
			scrollen_verspätet();
		</script>
    </div>
	<?php
		include ("includes/includeFooter.php");
	?>			
</body>
</html>
