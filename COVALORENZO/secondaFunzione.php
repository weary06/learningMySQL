<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $regione = $_POST['regione'];

    $sql = "SELECT id, percentuale_provvigione FROM rappresentante WHERE ultimo_fatturato > 1000 AND regione = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $regione);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $newPercentuale = $row['percentuale_provvigione'] + 2;
        $updateSql = "UPDATE rappresentante SET percentuale_provvigione = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("di", $newPercentuale, $row['id']);
        $updateStmt->execute();
        $updateStmt->close();
    }

    $stmt->close();
    echo "Aggiornamento completato per la regione $regione!";

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiorna Provvigioni</title>
</head>
<body>
    <form method="POST" action="">
        <label for="region">Regione:</label>
        <select name="regione" id="region" required>
            <option disable selected value>Seleziona una regione</option>
            <option value="Valle d'Aosta">Valle d'Aosta</option>
            <option value="Piemonte">Piemonte</option>
            <option value="Liguria">Liguria</option>
            <option value="Lombardia">Lombardia</option>
            <option value="Trentino-Alto Adige">Trentino-Alto Adige</option>
            <option value="Friuli-Venezia Giulia">Friuli-Venezia Giulia</option>
            <option value="Veneto">Veneto</option>
            <option value="Emilia-Romagna">Emilia-Romagna</option>
            <option value="Toscana">Toscana</option>
            <option value="Marche">Marche</option>
            <option value="Umbria">Umbria</option>
            <option value="Lazio">Lazio</option>
            <option value="Abruzzo">Abruzzo</option>
            <option value="Molise">Molise</option>
            <option value="Campania">Campania</option>
            <option value="Puglia">Puglia</option>
            <option value="Basilicata">Basilicata</option>
            <option value="Calabria">Calabria</option>
            <option value="Sicilia">Sicilia</option>
            <option value="Sardegna">Sardegna</option>
        </select>
        <button type="submit">Aggiorna Provvigioni</button>
    </form>
</body>
</html>
