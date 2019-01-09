<?php
$connection = mysqli_connect('localhost', 'root', 'WKWsJVZcemt7UHzp') or die
                ("Fout met de verbinding naar de server.");
mysqli_select_db($connection, 'dbLOI') or die
        ("Fout met de verbinding naar de database.");
?>