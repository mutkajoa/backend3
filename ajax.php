<!DOCTYPE html>
<?php
// Sessionshantering
include("handyfunctions.php");
include("smallnavbar.php");
?>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sök annonser</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <h1>Sök annonser med hjälp av AJAX</h1>
    <?php include("navbar.php"); ?>
    <section>
        <div class="input-group">
            <span class="input-group-addon">Sök med rubrik eller beskrivning</span>
            <input type="text" name="search_text" id="search_text" placeholder="Rubrik eller beskrivning" class="form-control"/>
        </div>
        <div id="result"></div>
    </section>
</body>

</html>
<script>
    $(document).ready(function () {

        load_data();

        function load_data(query) {
            $.ajax({
                url: "fetch.php",
                method: "POST",
                data: {
                    query: query
                },
                success: function (data) {
                    $('#result').html(data);
                }
            });
        }
        $('#search_text').keyup(function () {
            var search = $(this).val();
            if (search != '') {
                load_data(search);
            } else {
                load_data();
            }
        });
    });
</script>