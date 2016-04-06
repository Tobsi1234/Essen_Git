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

    -->
</script>

<div id="neueLocation">
    <h2>Location hinzufügen</h2>
    <div></div>
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
    </form>

</div>


<script>essen_laden();</script>
