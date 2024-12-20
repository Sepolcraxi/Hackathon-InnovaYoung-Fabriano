<?php
$servername = "vincenzominutillo.netsons.org";
$username = "ertzzysj_wp651";
$password = "Vincenzo2005!@";
$dbname = "ertzzysj_wp651";

// Creazione connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// Controllo connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}