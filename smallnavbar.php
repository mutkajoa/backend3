<nav id="smallnavbar">
<?php
if (isset($_SESSION['username'])) {
    print("
    <div class='loggedDiv'>
    Loggad in som: <b>".$_SESSION['username']."</b>
    <u><a href='profil.php'>Min profil</a></u>
    <u><a href='minaannonser.php'>Mina annonser</a></u>
    <u><a href='logout.php'>Logga ut</a></u></div>");

}
?>
</nav>