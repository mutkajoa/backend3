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
    <title>Registrera</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css"/>
    <script src="main.js"></script>
</head>
<body>
<h1>Projekt 2</h1>
<?php include "navbar.php" ?>
<section>
<?php
if(!isset($_SESSION['username'])) {
  print("
  <article>
  <form action='registrera.php' method='POST'>
  Användarnamn: (5-20 tecken)<br>
  <input type='text' name='anvnamn' ><br>
  Epost:<br>
  <input type='email' name='epost'><br>
  Lösenord:(8-256 tecken)<br>
  <input type='password' name='losen'><br>
  Bekräfta lösenord:<br>
  <input type='password' name='losen1'><br><br>
  <input type='submit' name='registrera' value='Registrera dig'>
  </form>        
  </article>");
  
  $conn = create_conn();
  
  if (isset($_POST['registrera'])) {
    $anvnamn = test_input($_POST['anvnamn']);
    $losen = test_input($_POST['losen']);
    $losen_hash = hash("sha256",$losen);
    $losen1 = test_input($_POST['losen1']);
    $losen1_hash = hash("sha256",$losen1);
    $epost = test_input($_POST['epost']);
    $roll = "user";
    $status = "overifierad";
    if (strlen($anvnamn) < 5) {
      echo "Användarnamnet är för kort";
    } elseif (strlen($anvnamn) > 20) {
        echo "Användarnamnet är för långt";
    } elseif (strlen($losen) < 8) {
        echo "Lösenordet är för kort";
    } elseif (strlen($losen) > 256) {
        echo "Lösenordet är för långt";
    } else {
      $sql = "SELECT * FROM users WHERE namn ='$anvnamn';";
      $result_user = $conn->query($sql);
      $sql_email = "SELECT * FROM users WHERE epost ='$epost';";
      $result_email = $conn->query($sql_email);
      if ($result_user-> num_rows > 0) {
        print("<p>Användaren finns redan!</p>");
      } elseif ($result_email-> num_rows > 0) {
          ;
      } else {
        if (filter_var($epost, FILTER_VALIDATE_EMAIL)&& $losen_hash == $losen1_hash) {
          $hash = hash('sha256',rand(0,1000));      
          $sql = "INSERT INTO users (namn,losen,epost,roll,hash,status)
          VALUES('$anvnamn','$losen_hash','$epost','$roll','$hash','$status');";
          $result_user = $conn->query($sql);
        
          if ($conn->affected_rows > 0) {
            $subject = 'Verifiering av ditt konto!';
            $meddelande = '
            Du har registrerat dig till Jockes Loppis sidan!
            Aktivera ditt konto: https://cgi.arcada.fi/~mutkajoa/backend2/verifiera.php?epost='.$epost.'&hash='.$hash.'';
            $headers = 'From:noreply@loppis.fi' . "\r\n";
        
            mail($epost,$subject,$meddelande,$headers);
        
            print("<p>Registrering lyckades!<br>
            Ett e-post meddelande har skickats med en verifierings-link!
            (Kom ihåg att kolla spam-filtret)
            </p>");
          }
        } else {
          if ($losen_hash != $losen1_hash) {
            echo("<p>Lösenorden matchade inte</p>");
          } else {
            echo("<p>Registrering lyckades inte!</p>");
          }
        }
      }
    }
    $conn->close();
  }
}
?>
</section>
</body>
</html>