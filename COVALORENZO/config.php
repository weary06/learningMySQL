<?php
$servername = "localhost"; 
$username = "root";
$password = "";         
$dbname = "COVALORENZO";   

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}
?>

