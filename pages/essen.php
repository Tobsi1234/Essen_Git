<script>
    <!--
    var essenName;
    function essen_anlegen() {
        essenName = document.getElementById("essenName").value;

        $.ajax({
            type    : "POST",
            url     : "procedures.php",
            data    : {callFunction: 'insertEssen', p1: essenName},
            dataType: 'text',
            success : function (data) {
                window.location.reload();
            }
        });
    }

    function getEssen() {
        $.ajax({
            type    : "POST",
            url     : "procedures.php",
            data    : {callFunction: 'getEssen'},
            dataType: 'text',
            success : function (data) {
                var essen= JSON.parse(data);
                $('#demoThree').html("");
                for(i=0; i<essen.length; i++) {
                    $('#demoThree').append("<li>"+ essen[i] +"</li>");
                    //$('#sDeleteEssen').append("<option value=" + essen[i] + ">" + essen[i] + "</option>");
                }
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

    function deleteEssen() {
        var selectedEssen = $('#sDeleteEssen :selected').text();

        $.ajax({
            type    : "POST",
            url     : "procedures.php",
            data    : {callFunction: 'deleteEssen', p1: selectedEssen},
            dataType: 'text',
            success : function (data) {
                alert(data);
                alert("Vorher");
                window.location.reload();
                alert("Nachher");

            }
        });
    }

    function removeBilder() {
        $('#navbarPages').html("<li><a href=\"#locations\"> <h3>Locationverwaltung</h3></a></li><li><a href=\"#essen\"><h3>Essensverwaltung</h3></a></li>");
    }
    -->
</script>
<script>removeBilder();</script>
<div class="col-md-5">
    <div class="col-md-12" id="neuesEssen">
        <h2>Essen hinzufügen</h2>
        <br>
        <form id="newessen" name="newessen" action="" method="post" onsubmit="essen_anlegen(); return false;">
            <table class="usertable">
                <tbody>
                <tr>
                    <td><label for="essenName">Name des Essens:</label></td>
                    <td><input type="text" class="fancyform" id="essenName" maxlength="30" value="" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit" class="btn btn-primary">Essen speichern</button></td>
                </tr>
            </table>

        </form><br>
    </div>
    <!--<div class="col-md-12" id="deleteEssen">
        <h2>Essen löschen</h2>
        <br>
        <form id="deleteFood" name="deleteFood" action="" method="post" onsubmit="deleteEssen(); return false;">
            <table class="usertable">
                <tbody>
                <tr>
                    <td></td>
                    <td><select id="sDeleteEssen"></select></td>
                    <td><button type="submit" class="btn btn-primary">Essen löschen</button></td>
                </tr>

            </table>

        </form><br>
    </div>-->
</div>
<!-- Alphabet -->
<div class="col-md-7">
    <br>
    <div id="tabpage_3" class="col-md-12">

        <div class="listWrapper">

            <ul id="demoThree" class="demo">
            </ul>
            <script> getEssen(); </script>
            <br>
        </div>
    </div>
</div>

<script src="js/jquery-listnav.js"></script>
<script src="js/vendor.js"></script>
