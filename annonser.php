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
    <title>Annonser</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css"/>
</head>
<body>
    <h1>Här ser du alla annonser på vår loppis</h1>
<?php include("navbar.php"); ?>

<section>

<?php
$conn = create_conn();
if (!isset($_GET['user'])) {
    print("<p>Här ser du annonser från databasen</p>");
    $sql = "SELECT * FROM loppis";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            print("
            <p><b>Rubrik:</b> ".$row['rubrik']."<br>
            <b>Beskrivning:</b> ".$row['beskrivning']."<br>
            <b>Säljare:</b> ".$row['saljare']."<br>
            <b>Pris:</b> ".$row['pris']."€<br>
            <b>Annonsen uppladdad:</b> ".date("d.m.Y H:i:s", strtotime($row['datum']))."<br></p>");
        }
    } else {
        print("<p>Det finns inga annonser i databasen</p>");
    }
} elseif (isset($_GET['user']) && !empty($_GET['user'])) {
    $user = test_input($_GET['user']);
    print("<p>Här ser du annonser från databasen av användaren ".$user."</p>");
    $sql = "SELECT * FROM loppis WHERE saljare='".$user."';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            print("<p><b>Rubrik:</b> ".$row['rubrik']."<br>
            <b>Beskrivning:</b> ".$row['beskrivning']."<br>
            <b>Säljare:</b> ".$row['saljare']."<br>
            <b>Pris:</b> ".$row['pris']."€<br>
            <b>Annonsen uppladdad:</b> ".date("d.m.Y H:i:s", strtotime($row['datum']))."</p>");
        }
    } else {
        print("<p>Användaren har inga annonser</p>");
    }
}
// Kom ihåg att stänga databasuppkopplingen
$conn->close();
?>
</section>
</body>
</html>