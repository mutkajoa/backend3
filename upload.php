<?php
session_start();
include("handyfunctions.php");

    if(isset($_POST['uploadoprofilepic'])){
        $file = $_FILES['FileToUpload'];

        $filename = $_FILES['fileToUpload']['name'];
        $fileTmpname = $_FILES['fileToUpload']['tmp_name'];
        $fileSize = $_FILES['fileToUpload']['size'];
        $fileError = $_FILES['fileToUpload']['error'];
        $fileType = $_FILES['fileToUpload']['type'];
        
        $fileExt = explode(".", $filename);
        $fileExtlow = strtolower(end($fileExt));

        $allowed = array("jpg", "jpeg", "png", "gif");

        if(in_array($fileExtlow,$allowed)){
            if($fileError === 0){
                if($fileSize < 2000000){
                    $filenameNew = $_SESSION['username']."profilepic.".$fileExtlow;
                    $filedest = "files/".$filenameNew;
                    move_uploaded_file($fileTmpname, $filendest);
                    header("Location: profil.php?picupload=true");
                    $conn = create_conn();
                    $prflsql = "INSERT INTO ";
                }else{
                    echo("Filen är för stor!");
                }

            }else{
                echo("Ett problem uppstod med filuppladdningen");
            }
        }else{
            echo("Fel Filformat!");
        }
    }

?>