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

    -->
</script>
<div class="col-md-6">
    <div class="col-md-12" id="neuesEssen">
        <h2>Essen hinzufügen</h2>
        <br>
        <form id="newessen" name="newessen" action="" method="post" onsubmit="essen_anlegen(); return false;">
            <label for="essenName">Name des Essens:</label>
            <input type="text" id="essenName" maxlength="30" value="" style="margin-left:23px;" required>
            <button type="submit">Essen speichern</button>

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
            <script> getEssen(); </script>

        </div>
    </div>
</div>

<script src="js/jquery-listnav.js"></script>
<script src="js/vendor.js"></script>
