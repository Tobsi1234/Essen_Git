<!DOCTYPE html>
<html lang="de">
<head>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Essen</title>

    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Bootstrap Core CSS -->

    <!-- Custom CSS -->
    <link href="css/one-page-wonder.css" rel="stylesheet">
    
	<!-- CSS für Login -->
    <link href="css/login.css" rel="stylesheet">
	
	<!-- jQuery -->
    <script src="js/jquery.js"></script>
	<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"></script>
	
	<!-- Page Swapper Ajax -->
	<script type="text/javascript" src="js/pages.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<script language="javascript">
	$(document).ready(function(){
		$('#login-trigger').click(function() {
			$(this).next('#login-content').slideToggle();
			$(this).toggleClass('active');                    
			
			if ($(this).hasClass('active')) $(this).find('span').html('&#x25B2;')
				else $(this).find('span').html('&#x25BC;')
			})
	});
	
	function chat_speichern() {
		if (window.XMLHttpRequest) {
			XMLreq = new XMLHttpRequest();
		} else if (window.ActiveXObject) {
			XMLreq = new ActiveXObject("Microsoft.XMLHTTP");
		}
		refChatEingabe = document.forms['formChat'].nachricht;
		nachricht = refChatEingabe.value;
		if(nachricht) {
			URL = 'chat_speichern.php?nachricht=' + nachricht + '&name=' + name;
			XMLreq.open('GET', URL, false); 
			XMLreq.send(null);
		
			//alert(name + " hat " + nachricht + " hinzugefügt. Danke!");
			chat_laden();
			refChatEingabe.value = "";
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
		XMLreq.open('GET','chat_laden.php',false);
		XMLreq.send();
		if (XMLreq.readyState==4 && XMLreq.status==200) {
			json1 = XMLreq.responseText;
			json2 = JSON.parse(json1);
			refChatAusgabe.innerHTML = "";
			for(var i=0; i<Object.keys(json2).length; i++) {
				json3 = JSON.parse(json2[i]);
				refChatAusgabe.innerHTML += "<b>" + json3.name + "</b>: " + json3.nachricht + "<br>" + "<p style=\"font-size: 10px\" > am: " + json3.ts + "</p>";
			}
			json3 = JSON.parse(json2[Object.keys(json2).length - 1]);
		}
		scrollen();
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
					//window.setTimeout(scrollen, 100);
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
		if(name) {
			refChatAusgabe = document.getElementById('chat_ausgabe');
			refChatAusgabe.scrollTop = refChatAusgabe.scrollHeight;	
		}
	}
	
	function scrollen_verspätet(){
		window.setTimeout(scrollen, 200);
	}</script>

</head>
</html>