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
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css"/>
    <script src="main.js"></script>
</head>
<body>
<h1>Verifierings-sida</h1>

<section>
<?php
    if (isset($_GET['epost']) && !empty($_GET['epost']) && isset($_GET['hash']) && !empty($_GET['hash'])) {
        // Verify data
        $epost = test_input($_GET['epost']); // Set email variable
        $hash = test_input($_GET['hash']); // Set blaze it variable
        $conn = create_conn();
        $sql = "SELECT epost, hash, status FROM users WHERE epost='".$epost."' AND hash='".$hash."' AND status='overifierad';";
        $result = $conn->query($sql);
       
        if ($result->num_rows > 0) {
            $sql = "UPDATE users SET status='verifierad' WHERE epost='".$epost."' AND hash='".$hash."' AND status='overifierad';";
            $conn->query($sql);
            print("<p>Ditt konto har aktiverats! Du kan nu logga in</p>");
            print("<a href='login.php'>Logga In</a>");
        } else {
            print("<p>Ogiltig link! Ditt användarkonto är redan verifierat eller kontakta Administratören!</p>");
        }
        $conn->close();
    } else {
      print("<p>Ogiltig ankomst, andvänd linken i e-post meddelandet!<br>
      Du returneras till framsidan!</p>");
      header("refresh:3;url=index.php");
    }
?>
</section>
</body>
</html>