<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $ultimoFatturato = $_POST['lastMade'];
    $regione = $_POST['region'];
    $provincia = $_POST['province'];
    $PercProv = $_POST['percProv'];

    $sql = "INSERT INTO RAPPRESENTANTI ( nome, cognome, ultimo_fatturato, regione, provincia, percentuale_provvigione) VALUES( ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdssd", $nome, $cognome, $ultimoFatturato, $regione, $provincia, $PercProv);
    $stmt->execute();
    $result = $stmt->get_result();




}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terza Funzione - Aggiungi rappresentante</title>
    <link rel="stylesheet" href="terzaFunzione.css">
</head>
<body>
    <h1>Aggiungi un rappresentante</h1>
    <form action="terzaFunzione.php" method="post">
        <p>
            <label for="nome">Nome:</label>
            <input type="string" id="nome" name="nome" required>
            <br>
        </p>
        <p>
            <label for="cognome">Cognome:</label>
            <input type="string" id="cognome" name="cognome" required>
            <br>
        </p>
        <p>
            <label for="lastMade">Ultimo fatturato:</label>
            <input type="number" id="lastMade" name="lastMade" step="0.01" required>
            <br>
        </p>
        <p>
            <label for="region">Regione:</label>
            <input type="string" id="region" name="region" required>
            <br>
        </p>
        <p>    
            <label for="province">Provincia:</label>
            <input type="string" id="province" name="province" required>
            <br>
        </p>
        <p>
            <label for="percProv">Percentuale provvigione:</label>
            <input type="number" id="precProv" name="percProv" step="0.01" required>
            <br>
        </p>
        <button type="submit">Aggiungi</button>
    </form>
</body>
</html>