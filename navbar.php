<nav id="navbar">
<?php
if (isset($_SESSION['username'])) {
        //inloggad user
        if ($_SESSION['roll'] == 'user') {
            print("
            <a href='index.php'>Home</a>
            <a href='lista.php'>Användare</a>
            <a href='annonser.php'>Annonser</a>
            <a href='matain.php'>Ny annons</a>
            <a href='ajax.php'>Sök annonser</a>");
        } elseif ($_SESSION['roll'] == 'editor') {
            print("
            <a href='index.php'>Home</a>
            <a href='lista.php'>Användare</a>
            <a href='annonser.php'>Annonser</a>
            <a href='matain.php'>Ny annons</a>
            <a href='ajax.php'>Sök annonser</a>");
        } elseif ($_SESSION['roll'] == 'admin') {
            print("
            <a href='index.php'>Home</a>
            <a href='lista.php'>Användare</a>
            <a href='annonser.php'>Annonser</a>
            <a href='matain.php'>Ny annons</a>
            <a href='adminsida.php'>Administrationssida</a>
            <a href='ajax.php'>Sök annonser</a>");
        }
} else {
    print("
    <a href='index.php'>Home</a>
    <a href='login.php'>Logga In</a>
    <a href='registrera.php'>Registrera dig</a>");
}
?>
</nav>