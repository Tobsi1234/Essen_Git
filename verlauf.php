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

// Methode aus dem Internet, wo man ein Datum reingibt, um die aktuelle Kalenderwoche als Zahl zu bekommen
	function getWeekNumber(date) {
		date = new Date(+date);
		date.setHours(0,0,0);
		date.setDate(date.getDate() + 4 - (date.getDay()||7));
		var yearStart = new Date(date.getFullYear(),0,1);
		var weekNo = Math.ceil(( ( (date - yearStart) / 86400000) + 1)/7);
		date.setMilliseconds(0);
		return [weekNo, date.getFullYear()];
	}

// Methode aus dem Internet, wo man ein Daum reingibt, um die aktuelle Kalenderwoche in Tagen zu bekommen
	function getDaysOfWeek(curr) {

		var first = (curr.getDate() - curr.getDay())+1;
		var last = first + 6;

		var firstday = new Date(curr.setDate(first));
		var lastday = new Date(curr.setDate(last));

		return [firstday, lastday];
	}
	function woche_abholen() {
		// hole alle Datumswerte, für die es Einträge in der Tabelle "abstimmung_ergebnis" gibt
		$.ajax({
			type    : "POST",
			url     : "procedures.php",
			data    : {callFunction: 'getDatesFromAbstimmung'},
			dataType: 'text',
			success : function (data) {
				var allDates = JSON.parse(data);
				for (var i = 0; i<allDates.length; i++) {
					var date = new Date(allDates[i]['datum']);
					var weeknumber = getWeekNumber(date);
					var weeknumberString = weeknumber[0]+", "+weeknumber[1];

					var week = getDaysOfWeek(new Date('2016-04-13'));
					var firstdate = week[0].getDate()+"."+(week[0].getMonth()+1);
					var lastdate = week[1].getDate()+"."+(week[1].getMonth()+1);

					var dropdownInhalt = "KW "+weeknumberString+" ("+firstdate+" - "+lastdate+")";
					// alert (dropdownInhalt);
					var exists = false;

					$('#woche').each(function() {
						if (this.value == dropdownInhalt) {
							exists = true;
							return false;
						}
					});
					// Überprüfung, ob Woche bereits in Dropdown-Liste
					if (exists == false) {
						$('#woche').append($('<option>', {
							text: dropdownInhalt
						}));
					}
				}
			}
		});
	}

	function datum_refreshen() {
		// schaue nach, was für eine Woche in der Dropdown-Liste steht und hole die entsprechenden Einträge aus der DB
	}


-->
</script>
</head>
<body>

<?php
	include ("includes/includeBody.php");
?>
<div class="container" id="container" style="display: none">

	<!-- First Featurette -->
	<div class="featurette" id="about">

		<br><br>
		<div class="col-md-7">
			<div>
				<h1>Verlauf</h1>
				<div></div>
				<br><br>

				<form id="verlauf" name="verlauf" action="" method="post" onsubmit="datum_refreshen();">
					<label for="woche">Woche auswählen:</label>
					<select id="woche" name="woche">
					</select>
					<button type="submit">Anwenden</button>
					<div></div>


				</form>

			</div>

		</div>
	</div>
</div>
<script>woche_abholen()</script>
	<?php
		include ("includes/includeFooter.php");
	?>
</body>
</html>
