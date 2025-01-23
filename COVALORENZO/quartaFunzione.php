<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rappresentanteId = trim($_POST['id_rappresentante']);

    if (!is_numeric($rappresentanteId) || $rappresentanteId <= 0) {
        echo "ID non valido. Inserire un numero positivo.";
    } else {
        $sql = "DELETE FROM RAPPRESENTANTE WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $rappresentanteId);
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    echo "Rappresentante eliminato con successo.";
                } else {
                    echo "Nessun rappresentante trovato con l'ID specificato.";
                }
            } else {
                echo "Errore durante l'eliminazione: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Errore nella preparazione della query: " . $conn->error;
        }
    }
}

// Recupero elenco rappresentanti dal database per il menù a tendina
$rappresentanti = [];
$sql = "SELECT id, nome, cognome FROM RAPPRESENTANTE";
$result = $conn->query($sql);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $rappresentanti[] = $row;
    }
} else {
    echo "Errore durante il recupero dei rappresentanti: " . $conn->error;
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elimina Rappresentante</title>
    <link rel="stylesheet" href="stile.css">
</head>
<body>
    <h1>Elimina un Rappresentante</h1>
    <form action="eliminaRappresentante.php" method="post">
        <p>
            <label for="id_rappresentante">Seleziona il rappresentante:</label>
            <select name="id_rappresentante" id="id_rappresentante" required>
                <option disabled selected value>Seleziona un rappresentante</option>
                <?php foreach ($rappresentanti as $rappresentante): ?>
                    <option value="<?= $rappresentante['id'] ?>">
                        <?= htmlspecialchars($rappresentante['nome'] . ' ' . $rappresentante['cognome']) ?> (ID: <?= $rappresentante['id'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </p>
        <button type="submit">Elimina</button>
    </form>
</body>
</html>