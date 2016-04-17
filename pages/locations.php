<script>
    <!--
    var referenz, meinEssen, name, element, box, error, locname, locpage;

    var locessen = [];
    var essenDropdown = [];

    function loc_anlegen() {
        // alert("Ich lege eine Location an!");
        locname = document.getElementById("locname").value;
        locpage = document.getElementById("locpage").value;
        box     = document.getElementById("gewaehlte_essen");
        for (var i = 0; i < box.options.length; i++) {
            locessen[i] = box.options[i].text;
            // alert ("Name: "+locname+" Page: "+locpage+" Essensarray: "+locessen[i]);
        }

        $.ajax({
            type    : "POST",
            url     : "procedures.php",
            data    : {callFunction: 'insertLocation', p1: locname, p2: locpage, p3: locessen},
            dataType: 'text',
            success : function (data) {
				// alert("Es wurde die Location "+data+" angelegt. Danke!");
				window.location.reload();
            }
        });
    }

    function essen_laden() {
        box = document.getElementById("verfuegbare_essen");

        $.ajax({
            type    : "POST",
            url     : "procedures.php",
            data    : {callFunction: 'reloadEssen'},
            dataType: 'text',
            success : function (data) {
                essenDropdown = JSON.parse(data);

                for (var i = 0; i < essenDropdown.length; i++) {
                    element = document.createElement("option");
                    element.appendChild(document.createTextNode(essenDropdown[i]['name']));
                    box.appendChild(element);
                }
            }
        });

    }

    function essen_zuweisen() {
        // alert("Ich füge der Location ein Essen hinzu!");
        referenz  = document.newloc.verfuegbare_essen;
        meinEssen = referenz.value;

        box   = document.getElementById("gewaehlte_essen");
        error = false;

        for (var i = 0; i < box.options.length; i++) {
            if (box.options[i].text == meinEssen) {
                error = true;
            }
        }
        if (meinEssen && box.options.length < 5 && error == false) {
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

    function locations_abfragen() {

        $.ajax({
            type    : "POST",
            url     : "procedures.php",
            data    : {callFunction: 'insertEssen'},
            dataType: 'text',
            success : function (data) {
                window.location.reload();
            }
        });
        // window.location.reload();
    }

    function getLocations() {
        $.ajax({
            type    : "POST",
            url     : "procedures.php",
            data    : {callFunction: 'getLocations'},
            dataType: 'text',
            success : function (data) {
                var locations= JSON.parse(data);
                $('#demoThree').html("");
                for(i=0; i<locations.length; i++) {
                    var location = JSON.parse(locations[i]);
                    $('#demoThree').append("<li><a href=\"#locations\" data-trigger=\"focus\" data-toggle=\"popover\" title=\""+location['name']+"\" data-content=\"Link: <a href=\'"+location['link']+"\' >"+location['link']+"</a> \" data-html=\"true\">" + location['name'] +"</a></li>");
                }
                $('[data-toggle="popover"]').popover();
                $(function(){
                    $('#demoThree').listnav({
                        initLetter: 'all',
                        includeNums: true,
                        allText: 'Alle',
                        noMatchText: 'Keine Einträge für diesen Buchstaben vorhanden.'
                    });
                });
            }
        });
    }

    -->
</script>

<?php
require("includes/includeDatabase.php");
?>

<div class="col-md-6">
    <div class="col-md-12">

    <h2>Location hinzufügen</h2>
    <br>
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
    </form><br>
    </div>
</div>
<!-- Alphabet -->
<div class="col-md-6">
    <br>
    <div id="tabpage_3" class="col-md-12">

        <div class="listWrapper">

            <ul id="demoThree" class="demo">
            </ul>
            <script> getLocations(); </script>

        </div>
     </div>
</div>

<script src="js/jquery-listnav.js"></script>
<script src="js/vendor.js"></script>

<script>essen_laden();</script>
