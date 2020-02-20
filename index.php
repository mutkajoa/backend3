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
    <title>Loppis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css"/>
    <script src="main.js"></script>
</head>
<body>
    <h1>Projekt 2</h1>
    <?php include 'navbar.php'?>
<?php
if (isset($_SESSION['username'])) {
    print("<p>Välkommen till Jockes och Knappes Loppis Sida. Man kan laga annonser, och se en lista på användare.<br>
    Använd linkarna i nav-baren för att navigera.<br>
    </p><br><br><br><h2>Det finns tre stycken färdiga användare åt dennis :></h2><br><h3>Username: admin password: password</h3><br><h3>Username: editor password: password</h3><br><h3>Username: user password: password</h3>");
} else {
    print("<p>Välkommen, du har inte loggat in. <br>
    Om du inte har ett användarkonto kan du laga ett.<br> 
    Till det behöver du en GILTIG epost-adress(epost-adressen måste verifieras före du kan logga in) för att kunna logga in.<br>
    </p><br><br><br><h2>Det finns tre stycken färdiga användare åt dennis :></h2><br><h3>Username: admin password: password</h3><br><h3>Username: editor password: password</h3><br><h3>Username: user password: password</h3>");
}
?>
<br>
<div>
<h3>Rapport för Projekt2</h3>

<h4>Specifikation för Projekt2</h4>
<p>För projekt två valde vi att inte vara så kreativa och fortsatte på loppis idén från kursen 2019<br>
dels för att det var samma som i fjol och dels för att Jocke hade en grund för projektet kvar från året innan.<br></p>

<p>Det finns tre olika roller på Loppis sidan, "user" som är vanliga användare, "editor" som kan editera andra användares loppis-annonser<br>
och "admin" som kan ta bort och editera andra användares annonser och ta bort andra användare.</p>

<p>Sidans design är inte väldigt vacker eller modern, men eftersom kursen är Back-End programering, har vi försökt att<br>
satsa mera på att ha en fungerande backend på vår sida. För tillfället kommer designen bara från en väldigt simpel .css fil.<br></p>

<p>Några saker som att editor och admin kan inte för tillfället ennu editera andra användares annonser. Också "grief repporting", "forgot password"<br>
och funktionalitet för att ladda upp bilder är ennu work in progress eller upcoming features coming soon&trade;.</p>

<p>Användare kan dock ändra på sina egna annonser, och byta sitt lösenord och uppdatera sin epost. Detta under linkarna<br>
"Min Profil" och "Mina Annonser", därav kan man alltså uppdatera data i både användar och annons tabellen.</p>

<h4>Bilder och specifikationer på SQL tabellerna för annonser och användare:</h4>

<h5>Användartabell</h5>

<p>Tabellen för användare har 8 fält;<br>
<b>id</b> för att skapa en unik siffra för varje användare. <br>
<b>namn</b> är användarens användarnamn på loppisen, detta kollas också att det är unikt.<br>
<b>losen</b> är användarens lösenord, givetvis i hashat format.<br>
<b>epost</b> är användarens epost, eposten måste vara giltig för att användaren skall få tillgång till sidan.<br>
<b>roll</b> det finns tre roller på Loppis sidan, för tillfället kan man inte ändra roller på sidan.(future feature for admin maybe?)<br>
<b>hash</b> används vid verifieringen av användare<br>
<b>status</b> är först "overifierad" när användaren registrerar sig, och efter att användaren verifierat sin epost så ändras den till "verifierad" och användaren får tillgång till loppisen.<br>
<b>datum</b> är en tidsstämpel på när användarens data nått databasen, aka. när användaren registrerat sig.</p>

<img src="files/usersSQL.jpg" alt="Bild på användar tabell" width=50% height=50%>
<br>

<h5>Annonstabell</h5>
<p>Tabellen för annonser har 6 fält;<br> 
<b>id</b> för att skapa en unik siffra för varje annons. <br>
<b>saljare</b> är namnet på användaren som har laddat upp annonsen<br>
<b>rubrik</b> är rubriken på annonsen.<br>
<b>beskrivning</b> är en beskrivning på annonsen, vad det är man försöker sälja.<br>
<b>pris</b> är priset på det man försöker sälja, man kan mata in decimaltal eller vanliga heltal och de blir automatiskt ändrade till decimaltal.<br>
<b>datum</b> är en tidsstämpel på när annonsdata har anlänt till databasen, aka. när annonsen har laddats upp.</p>
<img src="files/loppisSQL.jpg" alt="Bild på annons tabell" width=50% height=50%>
<br>
<h4>Feedback för Projekt2</h4>
<p>Jocke: Bara för att repetera så är det fortfarande tredje gången jag går den här kursen, den funkar helt bra och det känns som att man lätt får hjälp när det behövs.<br>
Får se hur det går när vi kommer till projekt3 som jag inte har någon grund på från i fjol. Men på samma gång känns det som att det vi har hittils går ganska<br>
bra att expandera och bygga frammåt på.</p>
<p>Knappe: Jag har nog lärt mig helt massor om PHP och SQL dethär projektet. Synd att vi inte han få allt så fungerande som vi ville. <br>
Satte många dagar på bara att få en administartionssida att funka var man skulle kunna delete och editera på samma sida, utan att måsta hoppa till en annan sida. <br>
Det är säkert bara mera jquery...<br>
Ser fram emot projekt 3. </p>
</div>
</body>
</html>