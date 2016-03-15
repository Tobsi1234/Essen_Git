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
		$_SESSION['username'] = $_GET['username'];
		$_SESSION['password'] = $_GET['password'];
		}
		?>	
	}
-->
</script>
<script language="javascript"> 
<!--
	var XMLreq, name, refEssen, refDatum, refNeu, refMenu1, essen, heute, tag, monat, jahr, datum_heute;
	function name_ausgeben() {
		name = "<?php echo $_SESSION['username'] ?>";
		//alert("Hallo " + name);
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
	if ((!($_SESSION['username']=="Tobias" and $_SESSION['password']=="Tobias_1a2s3d")) && (!($_SESSION['username']=="Dominik" and $_SESSION['password']=="Dominik_1a2s3d")) && (!($_SESSION['username']=="Quentin" and $_SESSION['password']=="Quentin_1a2s3d")) && (!($_SESSION['username']=="Tilo" and $_SESSION['password']=="Tilo_1a2s3d")))
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
				<?php
				$abfrage0 = "SELECT * FROM tabessen";
				$ergebnis0 = mysqli_query($connection, $abfrage0);
				while ($row0 = mysqli_fetch_object($ergebnis0))
					{
						?>
						<input type="radio" id="essen" name="essen" value="<?php echo $row0->essen; ?>" checked="checked" style="margin-left:15px"> <label for=""><?php echo $row0->essen; ?> </label>
						<?php
					}
					?>
				<br><br>
				<button type="submit">Auswahl speichern</button>
				</form><br><br><br>
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
