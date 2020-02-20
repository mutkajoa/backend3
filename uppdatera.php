<?php
// Sessionshantering
include("handyfunctions.php");
include("smallnavbar.php");
?>

<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Uppdatera</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <h1>Här uppdaterar du din annons</h1>
<?php include("navbar.php");?>

<section>
<?php
$conn = create_conn();

if ((isset($_POST['id'])) and (isset($_POST['rubrik'])) and (isset($_POST['beskrivning'])) and (isset($_POST['pris']))) {
    $id = $_POST['id'];
    $rubrik = $_POST['rubrik'];
    $beskrivning = $_POST['beskrivning'];
    $pris = $_POST['pris'];
    echo "<table border=1>
    <thead>
    <tr>
    <th>ID</th>
    <th>Rubrik</th>
    <th>Beskrivning</th>
    <th>Pris €</th>
    <th>Uppdatera</th>
    </tr>
    </thead>";
    echo "<tbody>";
    echo "<tr>";
    echo "<form action='uppdatera.php' method='POST'>";
    echo "<td>".$id."</td>";
    echo "<input type=hidden name=id value=$id>";
    echo "<td>"."<input type=text name=rub value=$rubrik>"."</td>";
    echo "<td>"."<input type=text name=besk value=$beskrivning>"."</td>";
    echo "<td>"."<input type=text name=pri value=$pris>"."</td>";
    echo "<td>"."<input type='submit' name='update' value='Uppdatera'>"."</td>";
    echo "</form>";
    echo "</tr>";
    echo "</tbody>";
    echo "</table>";
}
if (isset($_POST['update'])) {
    $rubrik = test_input($_POST['rub']);
    $beskrivning = test_input($_POST['besk']);
    $pris = test_input($_POST['pri']);
    $id = ($_POST['id']);
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
        $sql = "UPDATE loppis SET rubrik = '$rubrik', beskrivning = '$beskrivning', pris = $pris WHERE id = $id";
        $conn->query($sql);
        if ($conn->affected_rows > 0) {
            print("<p>Uppdatering lyckades!</p>");
        } else {
            print("<p>Uppdatering lyckades inte!</p>");
        }
        } else {
        print("Priset kan bara innehålla siffror och en punkt eller ett komma!");
        }
    }
}
$conn->close();
?>
</section>
</body>
</html>