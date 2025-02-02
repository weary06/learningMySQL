<?php
require 'config.php';

$errors = "";
$regioni = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $cognome = trim($_POST['cognome']);
    $ultimoFatturato = trim($_POST['lastMade']);
    $regione = trim($_POST['regione']);
    $provincia = trim($_POST['provincia']);
    $percProv = trim($_POST['percProv']);

    if (!preg_match('/^[a-zA-ZàèìòùÀÈÌÒÙ\s]+$/', $nome)) {
        $errors = "Il nome deve contenere solo lettere.";
    } elseif (!preg_match('/^[a-zA-ZàèìòùÀÈÌÒÙ\s]+$/', $cognome)) {
        $errors = "Il cognome deve contenere solo lettere.";
    } elseif (!is_numeric($ultimoFatturato) || $ultimoFatturato <= 0) {
        $errors = "L'ultimo fatturato deve essere un numero positivo.";
    } elseif (empty($regione)) {
        $errors = "La regione è obbligatoria.";
    } elseif (empty($provincia)) {
        $errors = "La provincia è obbligatoria.";
    } elseif (!is_numeric($percProv) || $percProv < 0 || $percProv > 100) {
        $errors = "La percentuale provvigione deve essere tra 0 e 100.";
    }

    if (empty($errors)) {
        $sql = "INSERT INTO RAPPRESENTANTE (nome, cognome, ultimo_fatturato, regione, provincia, percentuale_provvigione) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssdsds", $nome, $cognome, $ultimoFatturato, $regione, $provincia, $percProv);
            if ($stmt->execute()) {
                echo "Rappresentante aggiunto con successo.";
            } else {
                echo "Errore durante l'inserimento: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Errore nella preparazione della query: " . $conn->error;
        }
    } else {
        echo $errors;
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Rappresentante</title>
    <link rel="stylesheet" href="terzaFunzione.css">
</head>
<body>
    <h1>Aggiungi un rappresentante</h1>
    <form action="terzaFunzione.php" method="post">
        <p>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
        </p>
        <p>
            <label for="cognome">Cognome:</label>
            <input type="text" id="cognome" name="cognome" required>
        </p>
        <p>
            <label for="lastMade">Ultimo fatturato:</label>
            <input type="number" id="lastMade" name="lastMade" step="0.01" required>
        </p>
        <p>
            <label for="regione">Regione:</label>
            <select name="regione" id="regione" required>
                <option disabled selected value>Seleziona una regione</option>
                <option value="Abruzzo">Abruzzo</option>
                <option value="Basilicata">Basilicata</option>
                <option value="Calabria">Calabria</option>
                <option value="Campania">Campania</option>
                <option value="Emilia-Romagna">Emilia-Romagna</option>
                <option value="Friuli Venezia Giulia">Friuli Venezia Giulia</option>
                <option value="Lazio">Lazio</option>
                <option value="Liguria">Liguria</option>
                <option value="Lombardia">Lombardia</option>
                <option value="Marche">Marche</option>
                <option value="Molise">Molise</option>
                <option value="Piemonte">Piemonte</option>
                <option value="Puglia">Puglia</option>
                <option value="Sardegna">Sardegna</option>
                <option value="Sicilia">Sicilia</option>
                <option value="Toscana">Toscana</option>
                <option value="Trentino-Alto Adige">Trentino-Alto Adige</option>
                <option value="Umbria">Umbria</option>
                <option value="Valle d'Aosta">Valle d'Aosta</option>
                <option value="Veneto">Veneto</option>
            </select>
        </p>
        <p>
            <label for="provincia">Provincia:</label>
            <select name="provincia" id="provincia" required>
                <option disabled selected value>Seleziona una provincia</option>
                <option value="Agrigento">Agrigento</option>
                <option value="Alessandria">Alessandria</option>
                <option value="Ancona">Ancona</option>
                <option value="Aosta">Aosta</option>
                <option value="Arezzo">Arezzo</option>
                <option value="Ascoli Piceno">Ascoli Piceno</option>
                <option value="Asti">Asti</option>
                <option value="Avellino">Avellino</option>
                <option value="Bari">Bari</option>
                <option value="Barletta-Andria-Trani">Barletta-Andria-Trani</option>
                <option value="Belluno">Belluno</option>
                <option value="Benevento">Benevento</option>
                <option value="Bergamo">Bergamo</option>
                <option value="Biella">Biella</option>
                <option value="Bologna">Bologna</option>
                <option value="Bolzano">Bolzano</option>
                <option value="Brescia">Brescia</option>
                <option value="Brindisi">Brindisi</option>
                <option value="Cagliari">Cagliari</option>
                <option value="Caltanissetta">Caltanissetta</option>
                <option value="Campobasso">Campobasso</option>
                <option value="Caserta">Caserta</option>
                <option value="Catania">Catania</option>
                <option value="Catanzaro">Catanzaro</option>
                <option value="Chieti">Chieti</option>
                <option value="Como">Como</option>
                <option value="Cosenza">Cosenza</option>
                <option value="Cremona">Cremona</option>
                <option value="Crotone">Crotone</option>
                <option value="Cuneo">Cuneo</option>
                <option value="Enna">Enna</option>
                <option value="Ferrara">Ferrara</option>
                <option value="Firenze">Firenze</option>
                <option value="Foggia">Foggia</option>
                <option value="Forlì-Cesena">Forlì-Cesena</option>
                <option value="Frosinone">Frosinone</option>
                <option value="Genova">Genova</option>
                <option value="Gorizia">Gorizia</option>
                <option value="Grosseto">Grosseto</option>
                <option value="Imperia">Imperia</option>
                <option value="Isernia">Isernia</option>
                <option value="L'Aquila">L'Aquila</option>
                <option value="La Spezia">La Spezia</option>
                <option value="Latina">Latina</option>
                <option value="Lecce">Lecce</option>
                <option value="Lecco">Lecco</option>
                <option value="Livorno">Livorno</option>
                <option value="Lodi">Lodi</option>
                <option value="Lucca">Lucca</option>
                <option value="Macerata">Macerata</option>
                <option value="Mantova">Mantova</option>
                <option value="Matera">Matera</option>
                <option value="Messina">Messina</option>
                <option value="Milano">Milano</option>
                <option value="Modena">Modena</option>
                <option value="Monza e Brianza">Monza e Brianza</option>
                <option value="Napoli">Napoli</option>
                <option value="Novara">Novara</option>
                <option value="Nuoro">Nuoro</option>
                <option value="Olbia-Tempio">Olbia-Tempio</option>
                <option value="Oristano">Oristano</option>
                <option value="Padova">Padova</option>
                <option value="Palermo">Palermo</option>
                <option value="Parma">Parma</option>
                <option value="Pavia">Pavia</option>
                <option value="Perugia">Perugia</option>
                <option value="Pesaro e Urbino">Pesaro e Urbino</option>
                <option value="Pescara">Pescara</option>
                <option value="Piacenza">Piacenza</option>
                <option value="Pisa">Pisa</option>
                <option value="Pistoia">Pistoia</option>
                <option value="Pordenone">Pordenone</option>
                <option value="Potenza">Potenza</option>
                <option value="Prato">Prato</option>
                <option value="Ragusa">Ragusa</option>
                <option value="Ravenna">Ravenna</option>
                <option value="Reggio Calabria">Reggio Calabria</option>
                <option value="Reggio Emilia">Reggio Emilia</option>
                <option value="Rieti">Rieti</option>
                <option value="Rimini">Rimini</option>
                <option value="Roma">Roma</option>
                <option value="Rovigo">Rovigo</option>
                <option value="Salerno">Salerno</option>
                <option value="Sassari">Sassari</option>
                <option value="Savona">Savona</option>
                <option value="Siena">Siena</option>
                <option value="Siracusa">Siracusa</option>
                <option value="Sondrio">Sondrio</option>
                <option value="Taranto">Taranto</option>
                <option value="Teramo">Teramo</option>
                <option value="Terni">Terni</option>
                <option value="Torino">Torino</option>
                <option value="Trapani">Trapani</option>
                <option value="Trento">Trento</option>
                <option value="Treviso">Treviso</option>
                <option value="Trieste">Trieste</option>
                <option value="Udine">Udine</option>
                <option value="Varese">Varese</option>
                <option value="Venezia">Venezia</option>
                <option value="Verbano-Cusio-Ossola">Verbano-Cusio-Ossola</option>
                <option value="Vercelli">Vercelli</option>
                <option value="Verona">Verona</option>
                <option value="Vibo Valentia">Vibo Valentia</option>
                <option value="Vicenza">Vicenza</option>
                <option value="Viterbo">Viterbo</option>
            </select>
        </p>
        <p>
            <label for="percProv">Percentuale provvigione:</label>
            <input type="number" id="percProv" name="percProv" step="0.01" required>
        </p>
        <button type="submit">Aggiungi</button>
    </form>
</body>
</html>