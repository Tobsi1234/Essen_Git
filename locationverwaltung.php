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
	var XMLreq, referenz, meinEssen, name, element, box, error, locname, locpage, essenDropdown;
	var locessen = [];

	function loc_anlegen() {
		// alert("Ich lege eine Location an!");
		locname = document.getElementById("locname").value;
		locpage = document.getElementById("locpage").value;
		box = document.getElementById("gewaehlte_essen");
		for (var i = 0; i<box.options.length; i++) {
			locessen[i] = box.options[i].text;
					// alert ("Name: "+locname+" Page: "+locpage+" Essensarray: "+locessen[i]);	
		}
		// alert ("Nun zum PHP-Teil"); // bis hierher kommt er

		$.ajax({
			type: "POST",
			url: "procedures.php",
			data: {callFunction: 'insertLocation', p1: locname, p2: locpage, p3: locessen},
			dataType: 'text',
			success:function(data) {
				alert(data);
			}
		});
		// window.location.href = "procedures.php";
		// alert ("Ich bin durchgesprungen");
	}

	function reloadEssen() {
		box = document.getElementById("gewaehlte_essen");
		alert ("Essen-laden");

		essenDropdown = "<?php echo reloadEssen();?>";
		alert (essenDropdown);
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
<script type="text/javascript">reloadEssen();</script>
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
			<div id="essenErgebnis"> </div><br><br>

			<form id="newloc" name="newloc" action="" method="post" onsubmit="loc_anlegen(); return false;">
				<label for="locname">Name der Location:</label> 
				<input type="text" id="locname" maxlength="30" value="" style="margin-left:23px;">
				<br><br>
				<label for="locpage">Homepage: </label> 
				<input type="text" id="locpage" maxlength="100" value="" style="margin-left:23px;">
				<br><br>
				<label for="verfuegbare_essen">Essensmöglichkeiten:</label>
				<select id="verfuegbare_essen" name="verfuegbare_essen">
					<option>Guten Morgen</option>
					<option>Burger</option>
					<option>Guten Abend</option>
					<option>Salami</option>
					<option>Döner</option>
					<option>Pizza</option>
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
			<div>
				<h2>Essen hinzufügen</h2>
			</div>
        </div>
    </div>
	<?php
		include ("includes/includeFooter.php");
	?>			
</body>
</html>
