<?php
// Sessionshantering
include("handyfunctions.php");

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $conn = create_conn();
    $sql = "DELETE FROM loppis WHERE id=".$id;
    $conn->query($sql);
    $conn->close();
    echo 1;
    exit;
}
echo 0;
?>