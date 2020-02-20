<!DOCTYPE html>
<?php
// Sessionshantering
include("handyfunctions.php");
include("smallnavbar.php");
?>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ny annons</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css"/>
    <script src="main.js"></script>
</head>
<body>
<h1>Här kan du skapa en ny annons</h1>
<?php include "navbar.php" ?>
<section>
    <p>Här kan du göra nya Loppis-annonser</p>
<?php
if (isset($_SESSION['username'])) {
  print("<article>
  <form action='matain.php' method='POST'>
  Säljare: ".$_SESSION['username']."<br>
  Rubrik:<br>
  <input type='text' name='rubrik'><br>
  Beskrivning: (max 300 tecken)<br>
  <input type='text' name='beskrivning'><br>
  Pris:<br>
  <input type='text' name='pris'><br>
  <input type='submit' name='matain' value='Mata in'>
  </form><br>
  </article>");
} else {
  print("<p>Du måste vara inloggad för att kunna göra annonser</p>");
}
$conn = create_conn();
if (isset($_POST['matain'])) {
  $rubrik = test_input($_POST['rubrik']);
  $beskrivning = test_input($_POST['beskrivning']);
  $saljare = $_SESSION['username'];
  $pris = test_input($_POST['pris']);
  if ($rubrik == "") {
    print("Din annons måste ha en rubrik!");
  } elseif ($beskrivning == "") {
    print("Din annons måste ha en beskrivning!");
  } elseif (strlen($beskrivning) > 300) {
    print("Din beskrivning är över 300 tecken!");
  } elseif ($pris == "") {
    print("Din annons måste ha ett pris!");
  } else {
    $pris = str_replace(",", ".", $pris);
    if (is_numeric($pris)) {
      $pris = (float)$pris;
      $sql = "INSERT INTO loppis (saljare,rubrik,beskrivning,pris)
      VALUES('$saljare','$rubrik','$beskrivning','$pris');";
      $result = $conn->query($sql);
      if ($conn->affected_rows > 0) {
          print("<p>Inmatning lyckades!</p>");
      } else {
          print("<p>Inmatning lyckades inte!</p>");
      }
    } else {
      print("Priset kan bara innehålla siffror och en punkt eller ett komma!");
    }
    $conn->close();
  }
}
?>
</section>
</body>
</html>