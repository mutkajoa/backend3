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
    <title>Logga in</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css"/>
</head>
<body>
<h1>Logga In</h1>
<?php include("navbar.php"); ?>
<section>
<form action="login.php" method="POST">
Användarnamn:<br>
<input type="text" name="anvnamn" autofocus required/><br>
Lösenord:<br>
<input type="password" name="losen" required/><br><br>
<input type="submit" name="loggain" value="Logga in"/>
<?php
if (isset($_SESSION['username'])) {
    //om man redan är inloggad
    header("Location:index.php");
} else {
// Create & check connection
$conn = create_conn();
//Om man klickat logga in
if (isset($_POST['loggain'])) {
    // Input validation
    $anvnamn = test_input($_POST['anvnamn']);
    $losen = test_input($_POST['losen']);
    $losen = hash("sha256",$losen);

    // Kolla ifall användaren redan finns
    $sql = "SELECT * FROM users WHERE namn='$anvnamn';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($losen == strtolower($row['losen']) && $row['status'] == 'verifierad') {
            $_SESSION['roll'] = $row['roll'];
            $_SESSION['username'] = $row['namn'];
            $_SESSION['ip'] = $_SERVER["REMOTE_ADDR"];

            // Rollhantering
            print("<br><p>Du loggade in som: ".$_SESSION['username']."<br>");
            print("Du har rollen: ".$_SESSION['roll']."<br>");
            print("Sidan omredigerar dig till framsidan om 3 sekunder.</p>");
            header("refresh:3;url=index.php");
        } elseif ($losen != strtolower($row['losen'])) {
            print("<p>Fel Användarnamn eller lösenord!</p>");
        } elseif ($losen == strtolower($row['losen']) && $row['status'] != 'verifierad') {
            print("<p>Ditt användarkonto har inte verifierats, kolla din e-post (kom ihåg att kolla spam-filtret)</p>");
        }
    } else {
        print("<p>Fel Användarnamn eller lösenord!</p>");
    }
    $conn->close();
    } else {
        print("<p>Var god fyll i dina inloggningsuppgifter</p>");
    }
}
?>
</section>
</body>
</html>