<?php
require 'config.php';

$errors= "";
$regioni = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $cognome = trim($_POST['cognome']);
    $ultimoFatturato = trim($_POST['lastMade']);
    $regione = trim($_POST['region']);
    $provincia = trim($_POST['province']);
    $PercProv = trim($_POST['percProv']);

    if (!preg_match('/^[a-zA-ZàèìòùÀÈÌÒÙ\s]+$/', $nome)) {
        $errors= "Il nome deve contenere solo lettere.";
        echo $errors;
    }
    elseif (!preg_match('/^[a-zA-ZàèìòùÀÈÌÒÙ\s]+$/', $cognome)) {
        $errors= "Il cognome deve contenere solo lettere.";
        echo $errors;
    }
    elseif (!is_numeric($ultimoFatturato) || $ultimoFatturato <= 0) {
        $errors = "L'ultimo fatturato deve essere un numero positivo.";
        echo $errors;
    }
    elseif (!preg_match('/^[a-zA-ZàèìòùÀÈÌÒÙ\s]+$/', $regione)){
        $errors= "La regione deve contenere almeno 2 caratteri.";
        echo $errors;
    }
    elseif (strlen($provincia) !== 2) {
        $errors = "La provincia deve essere esattamente di 2 lettere.";
        echo $errors;
    }
    elseif (!is_numeric($PercProv) || $PercProv < 0 || $PercProv > 100) {
        $errors = "La percentuale provvigione deve essere tra 0 e 100.";
        echo $errors;
    }
    else{
        $sql = "INSERT INTO RAPPRESENTANTE ( nome, cognome, ultimo_fatturato, regione, provincia, percentuale_provvigione) VALUES( ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdssd", $nome, $cognome, $ultimoFatturato, $regione, $provincia, $PercProv);
        $stmt->execute();
        $result = $stmt->get_result();
    }




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
            <input type="text" id="nome" name="nome" required>
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
            <br>
        </p>
        <p>    
        <label for="province">Provincia:</label>
            <select name="provincia" id="province" required>
                <option disabled selected value>Seleziona una provincia</option>
                
                <optgroup label="Abruzzo">
                    <option value="L'Aquila">L'Aquila</option>
                    <option value="Chieti">Chieti</option>
                    <option value="Pescara">Pescara</option>
                    <option value="Teramo">Teramo</option>
                </optgroup>
                
                <optgroup label="Basilicata">
                    <option value="Matera">Matera</option>
                    <option value="Potenza">Potenza</option>
                </optgroup>
                
                <optgroup label="Calabria">
                    <option value="Catanzaro">Catanzaro</option>
                    <option value="Cosenza">Cosenza</option>
                    <option value="Crotone">Crotone</option>
                    <option value="Reggio Calabria">Reggio Calabria</option>
                    <option value="Vibo Valentia">Vibo Valentia</option>
                </optgroup>
                
                <optgroup label="Campania">
                    <option value="Avellino">Avellino</option>
                    <option value="Benevento">Benevento</option>
                    <option value="Caserta">Caserta</option>
                    <option value="Napoli">Napoli</option>
                    <option value="Salerno">Salerno</option>
                </optgroup>
                
                <optgroup label="Emilia-Romagna">
                    <option value="Bologna">Bologna</option>
                    <option value="Ferrara">Ferrara</option>
                    <option value="Forlì-Cesena">Forlì-Cesena</option>
                    <option value="Modena">Modena</option>
                    <option value="Parma">Parma</option>
                    <option value="Piacenza">Piacenza</option>
                    <option value="Ravenna">Ravenna</option>
                    <option value="Reggio Emilia">Reggio Emilia</option>
                    <option value="Rimini">Rimini</option>
                </optgroup>
                
                <optgroup label="Friuli Venezia Giulia">
                    <option value="Gorizia">Gorizia</option>
                    <option value="Pordenone">Pordenone</option>
                    <option value="Trieste">Trieste</option>
                    <option value="Udine">Udine</option>
                </optgroup>
                
                <optgroup label="Lazio">
                    <option value="Frosinone">Frosinone</option>
                    <option value="Latina">Latina</option>
                    <option value="Rieti">Rieti</option>
                    <option value="Roma">Roma</option>
                    <option value="Viterbo">Viterbo</option>
                </optgroup>
                
                <optgroup label="Liguria">
                    <option value="Genova">Genova</option>
                    <option value="Imperia">Imperia</option>
                    <option value="La Spezia">La Spezia</option>
                    <option value="Savona">Savona</option>
                </optgroup>
                
                <optgroup label="Lombardia">
                    <option value="Bergamo">Bergamo</option>
                    <option value="Brescia">Brescia</option>
                    <option value="Como">Como</option>
                    <option value="Cremona">Cremona</option>
                    <option value="Lecco">Lecco</option>
                    <option value="Lodi">Lodi</option>
                    <option value="Mantova">Mantova</option>
                    <option value="Milano">Milano</option>
                    <option value="Monza e Brianza">Monza e Brianza</option>
                    <option value="Pavia">Pavia</option>
                    <option value="Sondrio">Sondrio</option>
                    <option value="Varese">Varese</option>
                </optgroup>
                
                <optgroup label="Marche">
                    <option value="Ancona">Ancona</option>
                    <option value="Ascoli Piceno">Ascoli Piceno</option>
                    <option value="Fermo">Fermo</option>
                    <option value="Macerata">Macerata</option>
                    <option value="Pesaro e Urbino">Pesaro e Urbino</option>
                </optgroup>
                
                <optgroup label="Molise">
                    <option value="Campobasso">Campobasso</option>
                    <option value="Isernia">Isernia</option>
                </optgroup>
                
                <optgroup label="Piemonte">
                    <option value="Alessandria">Alessandria</option>
                    <option value="Asti">Asti</option>
                    <option value="Biella">Biella</option>
                    <option value="Cuneo">Cuneo</option>
                    <option value="Novara">Novara</option>
                    <option value="Verbano-Cusio-Ossola">Verbano-Cusio-Ossola</option>
                    <option value="Vercelli">Vercelli</option>
                    <option value="Torino">Torino</option>
                </optgroup>
                
                <optgroup label="Puglia">
                    <option value="Bari">Bari</option>
                    <option value="Barletta-Andria-Trani">Barletta-Andria-Trani</option>
                    <option value="Brindisi">Brindisi</option>
                    <option value="Foggia">Foggia</option>
                    <option value="Lecce">Lecce</option>
                    <option value="Taranto">Taranto</option>
                </optgroup>
                
                <optgroup label="Sardegna">
                    <option value="Cagliari">Cagliari</option>
                    <option value="Carbonia-Iglesias">Carbonia-Iglesias</option>
                    <option value="Medio Campidano">Medio Campidano</option>
                    <option value="Nuoro">Nuoro</option>
                    <option value="Olbia-Tempio">Olbia-Tempio</option>
                    <option value="Oristano">Oristano</option>
                    <option value="Sassari">Sassari</option>
                </optgroup>
                
                <optgroup label="Sicilia">
                    <option value="Agrigento">Agrigento</option>
                    <option value="Caltanissetta">Caltanissetta</option>
                    <option value="Catania">Catania</option>
                    <option value="Enna">Enna</option>
                    <option value="Messina">Messina</option>
                    <option value="Palermo">Palermo</option>
                    <option value="Ragusa">Ragusa</option>
                    <option value="Siracusa">Siracusa</option>
                    <option value="Trapani">Trapani</option>
                </optgroup>
                
                <optgroup label="Toscana">
                    <option value="Arezzo">Arezzo</option>
                    <option value="Firenze">Firenze</option>
                    <option value="Grosseto">Grosseto</option>
                    <option value="Livorno">Livorno</option>
                    <option value="Lucca">Lucca</option>
                    <option value="Massa-Carrara">Massa-Carrara</option>
                    <option value="Pisa">Pisa</option>
                    <option value="Pistoia">Pistoia</option>
                    <option value="Prato">Prato</option>
                    <option value="Siena">Siena</option>
                </optgroup>
                
                <optgroup label="Trentino-Alto Adige">
                    <option value="Bolzano">Bolzano</option>
                    <option value="Trento">Trento</option>
                </optgroup>
                
                <optgroup label="Umbria">
                    <option value="Perugia">Perugia</option>
                    <option value="Terni">Terni</option>
                </optgroup>
                
                <optgroup label="Valle d'Aosta">
                    <option value="Aosta">Aosta</option>
                </optgroup>
                
                <optgroup label="Veneto">
                    <option value="Belluno">Belluno</option>
                    <option value="Padova">Padova</option>
                    <option value="Rovigo">Rovigo</option>
                    <option value="Treviso">Treviso</option>
                    <option value="Venezia">Venezia</option>
                    <option value="Verona">Verona</option>
                    <option value="Vicenza">Vicenza</option>
                </optgroup>
            </select>
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