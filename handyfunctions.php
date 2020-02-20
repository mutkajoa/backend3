<?php
//sessionshantering
session_start();


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function create_conn() {
  $servername = "localhost";
  $username = "test";
  $password ="password";
  $dbname ="projekt2";
  $conn = new mysqli($servername,$username,$password,$dbname);
  $conn->set_charset('utf8');
  if ($conn->connect_error) {
    die("<p>CONNECTION FAILED: ".$conn->connect_error."</p>");
  } else { 
      return $conn;
  };
}
//skickar upladdade filens namn till databas
function update_files_inDB($filnamn) {
  $filnamn = 
  $forfattare = $_SESSION['username'];
  $score = 1;

  $conn = create_conn();
  $sql = "INSERT INTO filer (filnamn,forfattare,score) VALUES ('$filnamn','$forfattare','$score');";
  $conn->query($sql);
  $conn->close();
}
?>