<?php
require 'config.php';

$rappresentanti = [];

//quando il pulsante viene premuto, recupera tutte le righe dalla tabella
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "SELECT * FROM RAPPRESENTANTE";
    $result = $conn->query($sql);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $rappresentanti[] = $row;
        }
    } else {
        echo "Errore durante il recupero dei dati: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza Rappresentanti</title>
    <link rel="stylesheet" href="stile.css">
</head>
<body>
    <h1>Visualizza tutti i Rappresentanti</h1>
    <form action="quintaFunzione.php" method="post">
        <button type="submit">Visualizza Rappresentanti</button>
    </form>

    <?php if (!empty($rappresentanti)): ?>
        <h2>Elenco Rappresentanti</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>Ultimo Fatturato</th>
                    <th>Regione</th>
                    <th>Provincia</th>
                    <th>Percentuale Provvigione</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rappresentanti as $rappresentante): ?>
                    <tr>
                        <td><?= htmlspecialchars($rappresentante['id']) ?></td>
                        <td><?= htmlspecialchars($rappresentante['nome']) ?></td>
                        <td><?= htmlspecialchars($rappresentante['cognome']) ?></td>
                        <td><?= htmlspecialchars($rappresentante['ultimo_fatturato']) ?></td>
                        <td><?= htmlspecialchars($rappresentante['regione']) ?></td>
                        <td><?= htmlspecialchars($rappresentante['provincia']) ?></td>
                        <td><?= htmlspecialchars($rappresentante['percentuale_provvigione']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <p>Nessun rappresentante trovato nella tabella.</p>
    <?php endif; ?>
</body>
</html>
