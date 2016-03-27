<?php
session_start();
require("includes/includeDatabase.php");
?>
<!DOCTYPE html>
<html lang="de">
<head>

<?php
	include ("includes/includeHead.php");
	include ("procedures.php");
?>

<script language="javascript"> 
<!--
	var XMLreq, referenz, meinEssen, name, element, box, error, locname, locpage, essenName;
	var locessen = [];
	var essenDropdown = [];

	function loc_anlegen() {
		// alert("Ich lege eine Location an!");
		locname = document.getElementById("locname").value;
		locpage = document.getElementById("locpage").value;
		box = document.getElementById("gewaehlte_essen");
		for (var i = 0; i<box.options.length; i++) {
			locessen[i] = box.options[i].text;
					// alert ("Name: "+locname+" Page: "+locpage+" Essensarray: "+locessen[i]);	
		}

		$.ajax({
			type: "POST",
			url: "procedures.php",
			data: {callFunction: 'insertLocation', p1: locname, p2: locpage, p3: locessen},
			dataType: 'text',
			success:function(data) {
				alert(data);
			}
		});
	}
	
	function essen_anlegen() {
		essenName = document.getElementById("essenName").value;
		
		$.ajax({
			type: "POST",
			url: "procedures.php",
			data: {callFunction: 'insertEssen', p1: essenName},
			dataType: 'text',
			success:function(data) {
				window.location.reload();
			}
		});
		
		// window.location.reload();
		
	}

	function essen_laden() {
		box = document.getElementById("verfuegbare_essen");
		
		essenDropdown = <?php echo json_encode(reloadEssen(), JSON_PRETTY_PRINT);?>;
		
		for (var i = 0; i<essenDropdown.length; i++) {
			element = document.createElement("option");
			element.appendChild(document.createTextNode(essenDropdown[i]['name']));
			box.appendChild(element);
		}
	}
	
	function essen_zuweisen() {
		// alert("Ich füge der Location ein Essen hinzu!");
		if (window.XMLHttpRequest) {
			XMLreq = new XMLHttpRequest();
		} else if (window.ActiveXObject) {
			XMLreq = new ActiveXObject("Microsoft.XMLHTTP");
		}
		referenz = document.newloc.verfuegbare_essen;
		meinEssen = referenz.value;
		
		box = document.getElementById("gewaehlte_essen");
		error = false;

		for (var i = 0; i<box.options.length; i++) {
			if (box.options[i].text == meinEssen) {
				error = true;
			}
		}
		if(meinEssen && box.options.length < 5 && error == false) {
			element = document.createElement("option");
			element.appendChild(document.createTextNode(meinEssen));
			box.appendChild(element);
		}
		else {
			alert("Höchstens 5 Essen pro Location, keine doppelten Essen und keine leeren Essen hinzufügen, bitte!!");
		}
		
		return false;
	}
	
	function essen_entfernen() {
		box = document.getElementById("gewaehlte_essen");
		box.remove(box.selectedIndex);
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
            <div class="container">
				<br><br><br>
            </div>
    </header>

    <!-- Page Content -->
    <div class="container">
        
        <!-- First Featurette -->
        <div class="featurette" id="about">
			<?php
			require('includes/includeDatabase.php');
			?>
			<br><br>
			<div>
			<h2>Location hinzufügen</h2>
			<div> </div><br><br>

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
			
			</div>
			<div id ="neuesEssen">
				<br><br>
				<h2>Essen hinzufügen</h2>
				<br><br>
				<form id="newessen" name="newessen" action="" method="post" onsubmit="essen_anlegen(); return false;">
				<label for="essenName">Name des Essens:</label> 
				<input type="text" id="essenName" maxlength="30" value="" style="margin-left:23px;">
				<button type="submit">Essen speichern</button>
				<br><br><br><br><br><br><br><br><br><br>
				</form>
			</div>
        </div>
    </div>
<script>essen_laden();</script>
	<?php
		include ("includes/includeFooter.php");
	?>			
</body>
</html>
