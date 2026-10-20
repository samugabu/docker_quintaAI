<?php
$veicolo = '';
if (isset($_GET['veicolo'])) {
    $veicolo = $_GET['veicolo'];
} elseif (isset($_POST['veicolo'])) {
    $veicolo = $_POST['veicolo'];
}

$nome = '';
$ore = '';
$errore = '';
$costo_orario = '';
$costo_totale = '';
$invio = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
    $ore = isset($_POST['ore']) ? $_POST['ore'] : '';

    if (empty($nome) || empty($ore)) {
        $errore = "Compilare tutti i campi obbligatori per proseguire.";
    } else {
        $invio = true;

        if ($veicolo === 'Automobile') {
            $costo_orario = 2;
        } elseif ($veicolo === 'Motocicletta') {
            $costo_orario = 1;
        }

        $costo_totale = $costo_orario * (int)$ore;
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Prenotazione Parcheggio</title>
</head>
    <body>
        <h1>Prenotazione parcheggio</h1>

        <form action="prenota.php" method="POST">
            <input type="hidden" name="veicolo" value="<?php echo htmlspecialchars($veicolo); ?>">

            <p>
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>">
            </p>

            <p>
                <label for="ore">Numero di ore:</label>
                <select id="ore" name="ore">
                    <option value="">Numero Ora</option>
                        <?php
                            for ($i = 1; $i <= 6; $i++):
                                echo "<option value=" . $i;
                                if ($ore == $i)
                                    echo 'selected'. $i;
                                echo "</option>"?>
                </select>
            </p>

            <p>
                <button type="submit">Calcola prezzo</button>
            </p>
            <p><a href="home-parcheggio.html">Torna alla home</a></p>
        </form>

        <?php if ($invio) ?>
            <h3>Riepilogo della prenotazione</h3>
            <table border="2">
                <tr>
                    <td><strong>Nome cliente</strong></td>
                    <td><?php echo htmlspecialchars($nome); ?></td>
                </tr>
                <tr>
                    <td><strong>Tipologia di veicolo</strong></td>
                    <td><?php echo htmlspecialchars($veicolo); ?></td>
                </tr>
                <tr>
                    <td><strong>Numero di ore</strong></td>
                    <td><?php echo htmlspecialchars($ore); ?></td>
                </tr>
                <tr>
                    <td><strong>Costo orario</strong></td>
                    <td><?php echo $costo_orario; ?> euro</td>
                </tr>
                <tr>
                    <td><strong>Costo totale</strong></td>
                    <td><?php echo $costo_totale; ?> euro</td>
                </tr>
            </table>

            <p>Prenotazione effettuata correttamente!</p>
            <p><a href="home-parcheggio.html">Torna alla home</a></p>
    </body>
</html>