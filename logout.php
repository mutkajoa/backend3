<!DOCTYPE html>
<html>
<?php
include("smallnavbar.php");
session_start();
// remove all session variables
session_unset(); 

// destroy the session 
session_destroy();

?>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Logging out</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css"/>
    <script src="main.js"></script>
</head>
<body>
    <h1>Projekt 2</h1>
    <?php include 'navbar.php'?>
<?php
    print("<h2>Du har loggats ut</h2>");
    header("refresh:1;url=index.php");
?>
</body>
</html>