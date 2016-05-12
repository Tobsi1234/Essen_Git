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
	<script src="http://d3js.org/d3.v3.min.js"></script>

	<style>

		.node {
			cursor: pointer;
		}

		.node circle {
			fill: #fff;
			stroke: steelblue;
			stroke-width: 3px;
		}

		.node text {
			font: 14px sans-serif;
		}

		.link {
			fill: none;
			stroke: #ccc;
			stroke-width: 2px;
		}

	</style>

	<script language="javascript">
		<!--

		var name, refDatum, refEssenErgebnis, refNeu, refChatAusgabe, refChatEingabe, essen, heute, tag, monat, jahr, datum_heute, nachricht, json1, json2, jsonNeu1, jsonNeu2;
		var essenNamen = [];
		function name_ausgeben() { //session in js variable speichern
			name = "<?php if(isset($_SESSION['username']))echo $_SESSION['username'] ?>";
			//alert("Hallo " + name);
		}

		function datum() {  //datuum init
			heute = new Date();
			tag = heute.getDate();
			monat = heute.getMonth() + 1;
			jahr = heute.getFullYear();
			datum_heute = jahr + "-0" + monat + "-" + tag;
			refDatum = document.getElementById('datum');
			//refDatum.innerHTML = datum_heute;
			//$.post('index.php', {variable: datum_heute});

		}

		var redraw, g, renderer;

		// Hole bei jedem Neuladen der Seite die Abstimmung von heute
		function holeAbstimmungenHeute() {
			$.ajax({
				type    : "POST",
				url     : "procedures.php",
				data    : {callFunction: 'getAbstimmungenHeute'},
				dataType: 'text',
				success : function (data) {
					
					var abstimmungen = JSON.parse(data);

					if(abstimmungen.toString() === '') {
						$("#essenErgebnis").attr('class', 'alert alert-danger fade in');
						$('#essenErgebnis').html("<h2>"+"Noch keine Abstimmung für heute vorhanden"+"</h2>");
					}
					else {

						// quelle: http://dracula.ameisenbar.de/



						$('#abstimmungen').html("");

						for (var i = 0; i < abstimmungen.length; i++) {

							if (abstimmungen[i]['essen1'] === abstimmungen[i]['essen2']) {
								$('#abstimmungen').append("<h4><b>" + abstimmungen[i]['username'] + "</b>" + " hat <b>doppelt</b> für das Essen " + "<b>" + abstimmungen[i]['essen1'] + "</b>" + "</b>" + " abgestimmt.</h4><br>");
							}
							else if (abstimmungen[i]['essen2'] != null) {
								$('#abstimmungen').append("<h4><b>" + abstimmungen[i]['username'] + "</b>" + " hat für die Essen " + "<b>" + abstimmungen[i]['essen1'] + "</b>" + " und " + "<b>" + abstimmungen[i]['essen2'] + "</b>" + " abgestimmt.</h4><br>");
							}
							else {
								$('#abstimmungen').append("<h4><b>" + abstimmungen[i]['username'] + "</b>" + " hat <b>nur</b> für das Essen " + "<b>" + abstimmungen[i]['essen1'] + "</b>" + "</b>" + " abgestimmt.</h4><br>");
							}
						}

						berechneErgebnisHeute();
					}
				}
			});
		}

		function berechneErgebnisHeute() {
			$.ajax({
				type    : "POST",
				url     : "procedures.php",
				data    : {callFunction: 'calculateErgebnisHeute'},
				dataType: 'text',
				success : function (data) {
					//alert(location[0]['abstimmungen']+" und "+location[0]['locname']);
					//alert(data);
					var location = JSON.parse(data);
					var linker = "";
					// alert(location['abstimmungen']+location[0]['locname']+location[1]['locname']+location[2]['locname']);

					//alert("Am Arsch");
					// Wenn Abstimmungen vorhanden sind, aber keine Location für diese Abstimmung da ist
					if(location[0]['abstimmungen'] === true && location[0]['locname'] === false) {
						$("#essenErgebnis").attr('class', 'alert alert-danger fade in');
						$('#essenErgebnis').html("<h2>"+"Für diese Abstimmungen existiert leider keine passende Location."+"</h2>");
					}
					// Wenn weder Abstimmungen noch Locations da sind
					else if (location[0]['abstimmungen'] === false){
						// do nothing
					}

					else {
						// Wenn Locations und damit auch Abstimmungen da sind
						if (location.length > 0)
							$('#essenErgebnis').append("<h2 style='text-align: center'>"+"Essensempfehlung heute:</h2><br>"+"<h1 style='text-align: center'>\""+location[0]['locname']+"\""+"</h1>");
						if (location.length > 2)
							linker = ", "+location[2]['locname'];
						if (location.length > 1)
							$('#essenErgebnis').append("<br><hr><h4>Alternative/n: "+location[1]['locname']+linker+"</h4>");
					}

				}
			});
		}



		var treeData = [
			{
				"name": "Abstimmungen",
				"children": [
					{
						"name": "Tobsi",
						"children": [
							{
								"name": "Döner"
							},
							{
								"name": "Pizza"
							}
						]
					},
					{
						"name": "Domi",
						"children": [
							{
								"name": "Döner"
							},
							{
								"name": "Pizza"
							}
						]
					}
				]

			}
		];




		-->

	</script>
</head>
<?php
include ("includes/includeBody.php");
?>




<!-- Page Content -->
<div class="container weiß" id="container" style="display: none">

	<?php
	$stmt1 = $pdo->prepare("SELECT g_ID FROM users WHERE u_ID = :u_ID");
	$stmt1->execute(array('u_ID' => $_SESSION['userid']));
	$g_ID = $stmt1->fetch();
	if(!isset($g_ID[0])) echo "";
	else {
		$stmt2 = $pdo->prepare("SELECT name FROM gruppe WHERE g_ID = :g_ID");
		$stmt2->execute(array('g_ID' => $g_ID[0]));
		$gruppenname = $stmt2->fetch();
		//echo "Deine Gruppe: " . $gruppenname[0];
	}
	?>
	<!-- First Featurette -->
	<div class="featurette" id="about">

		<br><br>
		<script> name_ausgeben(); //session in js variable speichern</script>

		<?php
		if(!isset($g_ID[0])) { //noch keine Gruppe?
		?>
		<h1>Herzlich Willkommen auf wir-haben-hunger.ddns.net</h1>
		<br><br>
		<h2>Um richtig loszulegen, gründe eine Gruppe oder lass dich von Freunden einladen.</h2>

		<?php
		}
		else { //bereits eine Gruppe
		?>

		<script> datum(); //datum init</script>
		<script>holeAbstimmungenHeute();</script>
		<div class="col-md-12">
		<div class="col-md-7">
			<div id="headline" style="text-align:center;">
				<h1>Auswertung für Gruppe "<?php echo $gruppenname[0];?>"</h1><br>
			</div>
			<div id="essenErgebnis" class="alert alert-success fade in"> </div><br>
			<div id="abstimmungenTree" style="margin-top: -50px"></div>
			<div id="abstimmungen" style="margin-top: -50px"></div>

			<br><br>
		</div>

		<div class="col-md-4 col-md-offset-1">
			<div class = "panel panel-primary" id="chat_border">
				<div class="panel-heading">Chat</div>
				<div class="panel-body">
					<div id="chat_ausgabe"></div>
					<div id="chat_eingabe" style="margin-left: 10px">
						<form class="form-inline" role="form" id="formChat" name="formChat" action="" method="post" onsubmit="chat_speichern(); return false;">
							<input class="form-control" id="nachricht" type="text" placeholder="schreiben..."/>
							<button class="btn btn-dafualt" type="submit">Senden</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		</div>
		<script>
			chat_laden(); // läd chat jede sekunde neu.
			chat_verspätet();
		</script>
			<script>

				// ************** Generate the tree diagram	 *****************
				var margin = {top: 20, right: 120, bottom: 20, left: 120},
					width = 960 - margin.right - margin.left,
					height = 500 - margin.top - margin.bottom;

				var i = 0,
					duration = 750,
					root;

				var tree = d3.layout.tree()
					.size([height, width]);

				var diagonal = d3.svg.diagonal()
					.projection(function(d) { return [d.y, d.x]; });

				var svg = d3.select("#abstimmungenTree").append("svg")
					.attr("width", width + margin.right + margin.left)
					.attr("height", height + margin.top + margin.bottom)
					.append("g")
					.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

				root = treeData[0];
				root.x0 = height / 2;
				root.y0 = 0;

				update(root);

				function update(source) {

					// Compute the new tree layout.
					var nodes = tree.nodes(root).reverse(),
						links = tree.links(nodes);

					// Normalize for fixed-depth.
					nodes.forEach(function(d) { d.y = d.depth * 180; });

					// Update the nodes…
					var node = svg.selectAll("g.node")
						.data(nodes, function(d) { return d.id || (d.id = ++i); });

					// Enter any new nodes at the parent's previous position.
					var nodeEnter = node.enter().append("g")
						.attr("class", "node")
						.attr("transform", function(d) { return "translate(" + source.y0 + "," + source.x0 + ")"; })
						.on("click", click);

					nodeEnter.append("circle")
						.attr("r", 1e-6)
						.style("fill", function(d) { return d._children ? "lightsteelblue" : "#fff"; });

					nodeEnter.append("text")
						.attr("x", function(d) { return d.children || d._children ? -13 : 13; })
						.attr("dy", ".35em")
						.attr("text-anchor", function(d) { return d.children || d._children ? "end" : "start"; })
						.text(function(d) { return d.name; })
						.style("fill-opacity", 1e-6);

					// Transition nodes to their new position.
					var nodeUpdate = node.transition()
						.duration(duration)
						.attr("transform", function(d) { return "translate(" + d.y + "," + d.x + ")"; });

					nodeUpdate.select("circle")
						.attr("r", 10)
						.style("fill", function(d) { return d._children ? "lightsteelblue" : "#fff"; });

					nodeUpdate.select("text")
						.style("fill-opacity", 1);

					// Transition exiting nodes to the parent's new position.
					var nodeExit = node.exit().transition()
						.duration(duration)
						.attr("transform", function(d) { return "translate(" + source.y + "," + source.x + ")"; })
						.remove();

					nodeExit.select("circle")
						.attr("r", 1e-6);

					nodeExit.select("text")
						.style("fill-opacity", 1e-6);

					// Update the links…
					var link = svg.selectAll("path.link")
						.data(links, function(d) { return d.target.id; });

					// Enter any new links at the parent's previous position.
					link.enter().insert("path", "g")
						.attr("class", "link")
						.attr("d", function(d) {
							var o = {x: source.x0, y: source.y0};
							return diagonal({source: o, target: o});
						});

					// Transition links to their new position.
					link.transition()
						.duration(duration)
						.attr("d", diagonal);

					// Transition exiting nodes to the parent's new position.
					link.exit().transition()
						.duration(duration)
						.attr("d", function(d) {
							var o = {x: source.x, y: source.y};
							return diagonal({source: o, target: o});
						})
						.remove();

					// Stash the old positions for transition.
					nodes.forEach(function(d) {
						d.x0 = d.x;
						d.y0 = d.y;
					});
				}

				// Toggle children on click.
				function click(d) {
					if (d.children) {
						d._children = d.children;
						d.children = null;
					} else {
						d.children = d._children;
						d._children = null;
					}
					update(d);
				}
			</script>
			<?php
		} //ende php abfrage
		?>

	</div>
	<br><br>

</div>
<div class="container weiß" id="loggedOutSeite" style="display: none">
	<h1> Willkommen auf wir-haben-hunger.ddns.net</h1>
	<br><br>
	<h2> Jetzt schnell kostenlos <a href="registrieren.php"> registrieren</a>!</h2>
</div>

<?php
include ("includes/includeFooter.php");
?>
</body>
</html>
