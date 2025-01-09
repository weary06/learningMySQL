<?php
$servername = "localhost"; 
$username = "root";       
$password = "";            

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS COVALORENZO";
if ($conn->query($sql) === TRUE) {
    echo "Database 'COVALORENZO' creato con successo.<br>";
} else {
    die("Errore nella creazione del database: " . $conn->error);
}

$conn->select_db("COVALORENZO");

$sql = "
    CREATE TABLE IF NOT EXISTS RAPPRESENTANTE (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(50) NOT NULL,
        cognome VARCHAR(50) NOT NULL,
        ultimo_fatturato DECIMAL(10, 2) NOT NULL,
        regione VARCHAR(50) NOT NULL,
        provincia VARCHAR(50) NOT NULL,
        percentuale_provvigione DECIMAL(5, 2) NOT NULL
    );
";
if ($conn->query($sql) === TRUE) {
    echo "Tabella 'RAPPRESENTANTE' creata con successo.<br>";
} else {
    die("Errore nella creazione della tabella: " . $conn->error);
}

$sql = "
    INSERT INTO RAPPRESENTANTE (nome, cognome, ultimo_fatturato, regione, provincia, percentuale_provvigione) VALUES
    ('Mario', 'Rossi', 10000.50, 'Lombardia', 'Milano', 5.5),
    ('Luigi', 'Verdi', 20000.75, 'Lazio', 'Roma', 7.0),
    ('Anna', 'Bianchi', 15000.00, 'Veneto', 'Venezia', 6.5),
    ('Paolo', 'Neri', 12000.25, 'Sicilia', 'Palermo', 5.0),
    ('Sara', 'Blu', 18000.80, 'Campania', 'Napoli', 6.0);
";

if ($conn->query($sql) === TRUE) {
    echo "Dati di esempio inseriti con successo nella tabella 'RAPPRESENTANTE'.<br>";
} else {
    die("Errore nel popolamento della tabella: " . $conn->error);
}

$conn->close();
?>
