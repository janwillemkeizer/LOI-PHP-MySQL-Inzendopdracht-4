<?php
include 'connection.php';

// Initialize error strings to empy strings
$error = TRUE;
$naam_error = '';
$boodschap_error = '';
$sport_error = '';

// Filter input form $_POST
$verzend = filter_input(INPUT_POST, 'Verzend', FILTER_SANITIZE_STRING);
$naam = trim(filter_input(INPUT_POST, 'Naam', FILTER_SANITIZE_STRING));
$boodschap = trim(nl2br(filter_input(INPUT_POST, 'Boodschap', 
        FILTER_SANITIZE_STRING)));
$sport = filter_input(INPUT_POST, 'Sport', FILTER_SANITIZE_STRING);
$beoefenaar = filter_input(INPUT_POST, 'Beoefenaar', 
        FILTER_SANITIZE_NUMBER_INT);

// If the form has been submitted, validate input:
if (!empty($verzend)) {
    $error = FALSE;
    if (!isset($naam) || strlen(trim($naam)) === 0) {
    $naam_error = 'Het veld Naam is niet ingevuld.';
    $error = TRUE;
    } 
    if (!isset($boodschap) || strlen(trim($boodschap)) === 0) {
    $boodschap_error = 'Het veld Boodschap is niet ingevuld.';
    $error = TRUE;
    }
    if (!isset($sport)) {
    $sport_error = 'Het veld Sport is niet ingevuld.';
    $error = TRUE;
    }
    if(!isset($beoefenaar)) { 
    $beoefenaar = 0;
    }
} 

if(!$error) {
    // Insert form input into database table Guestbook    
    $sql = "INSERT INTO Guestbook (Naam, Boodschap, Datum, Sport, Beoefenaar)
    VALUES ('$naam','$boodschap', now(), '$sport','$beoefenaar')";

    mysqli_query($connection, $sql);
    mysqli_close($connection);
    // Redirect back to index.
    header('Location: index.php');
    }
?>
<html>
    <head>
        <title>Inzendopdracht 051R4</title>
    </head>
    <body>
    <form action="process.php" method="POST">     
            Naam:*<br>
            <input type="text" name="Naam"> <?php echo $naam_error; ?><br>
            Boodschap:* <?php echo $boodschap_error; ?><br>
            <textarea name="Boodschap" rows="10" cols="20"></textarea><br>
            Sport:*<br>
            <select name="Sport">
            <option disabled selected value> -- selecteer een sport -- </option>
            <option value="Tennis">Tennis</option>
            <option value="Voetbal">Voetbal</option>
            <option value="Running">Running</option>
            <option value="Tafeltennis">Tafeltennis</option>
            <option value="Squash">Squash</option>
            <option value="Wielrennen">Wielrennen</option>
            <option value="Boksen">Boksen</option>
            </select> <?php echo $sport_error; ?><br>
            Beoefenaar:<br>
            <input type="radio" name="Beoefenaar" value=1><br> 
            <input type="submit" name="Verzend" value="Verzend">
            </form>
            *verplicht veld.           
    </body>
</html>