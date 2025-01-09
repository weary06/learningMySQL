<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $valore_min = $_POST['valore_min'];
    $valore_max = $_POST['valore_max'];

    $sql = "SELECT * FROM RAPPRESENTANTE WHERE ultimo_fatturato BETWEEN ? AND ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("dd", $valore_min, $valore_max);
        $stmt->execute();

        $result = $stmt->get_result();
    } else {
        $error = "Errore nella query: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prima Funzione - Cerca Rappresentanti</title>
</head>
<body>
    <h1>Cerca Rappresentanti per Fatturato</h1>

    <!-- Form per l'inserimento dei valori -->
    <form action="primaFunzione.php" method="post">
        <label for="valore_min">Valore Minimo (€):</label>
        <input type="number" id="valore_min" name="valore_min" step="0.01" required>
        <br>
        <label for="valore_max">Valore Massimo (€):</label>
        <input type="number" id="valore_max" name="valore_max" step="0.01" required>
        <br>
        <button type="submit">Cerca</button>
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <h2>Risultati della Ricerca</h2>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php elseif ($result->num_rows > 0): ?>
            <table border="1">
                <tr>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>Ultimo Fatturato (€)</th>
                    <th>Regione</th>
                    <th>Provincia</th>
                    <th>Percentuale Provvigione (%)</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nome']); ?></td>
                        <td><?php echo htmlspecialchars($row['cognome']); ?></td>
                        <td><?php echo htmlspecialchars($row['ultimo_fatturato']); ?></td>
                        <td><?php echo htmlspecialchars($row['regione']); ?></td>
                        <td><?php echo htmlspecialchars($row['provincia']); ?></td>
                        <td><?php echo htmlspecialchars($row['percentuale_provvigione']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>Nessun rappresentante trovato per i valori specificati.</p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>

<?php
// Chiusura della connessione al database
$conn->close();
?>
