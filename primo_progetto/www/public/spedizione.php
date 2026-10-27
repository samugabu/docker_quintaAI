<?php
    $spedizione = '';
    if (isset($_GET['spedizione'])) {
        $spedizione = $_GET['spedizione'];
    } elseif (isset($_POST['spedizione'])) {
        $spedizione = $_POST['spedizione'];
    }

    $nome = '';
    $peso = '';
	$errore = '';
    $aereo = false;
    $invio_modulo = false;
    $costo = 0;
    $aereo_costo = 0;
    $costo_tot = 0;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
        $peso = $_POST['peso'] ?? '';
        $aereo = isset($_POST['aereo']);

        if (empty($nome) || empty($peso)) {
            echo "<p style='color: red'> Attenzione: Compilare tutti i campi</p>" . $errore;
        } else {
            if ($spedizione === 'Espressa') {
                $costo = 5;
            } elseif ($spedizione === 'Standard') {
                $costo = 3;
            }

            if ($aereo) {
                $aereo_costo = 10;
            }

            $costo_tot = ($costo * (int)$peso) + $aereo_costo;
            $invio_modulo = true;
        }
    }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Richiesta di spedizione</title>
</head>
<body>
    <h1>Richiesta di spedizione</h1>
    <p>Tipologia di spedizione selezionata: <strong><?php echo htmlspecialchars($spedizione); ?></strong></p>

    <form action="spedizione.php" method="POST">
        <input type="hidden" name="spedizione" value="<?php echo htmlspecialchars($spedizione); ?>">

        <p>
            <label for="nome">Nome del cliente:</label>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>">
        </p>

        <p>
            <label for="peso">Peso del pacco (kg):</label>
            <select id="peso" name="peso">
                <option value=""></option>
                <?php
                for ($i = 1; $i <= 6; $i++) {
                    $selected = ($peso == $i) ? ' selected' : '';
                    echo "<option value=\"$i\"$selected>$i</option>";
                }
                ?>
            </select>
        </p>

        <p>
            <label for="aereo">Invio in aereo:</label>
            <input type="checkbox" id="aereo" name="aereo" value="1"
	            <?php if ($aereo) echo 'checked'; ?>> Sì (costo aggiuntivo)
        </p>

        <p>
            <button type="submit">Calcola prezzo</button>
        </p>
        <p><a href="home-spedizione.php">Torna alla home</a></p>
    </form>

    <?php if ($invio_modulo): ?>
        <h3>Riepilogo della richiesta di spedizione</h3>
        <table border="2">
	        <tr>
		        <td><strong>Tipologia di spedizione</strong></td>
		        <td><?php echo htmlspecialchars($spedizione); ?></td>
	        </tr>
            <tr>
                <td><strong>Nome del cliente</strong></td>
                <td><?php echo htmlspecialchars($nome); ?></td>
            </tr>
            <tr>
                <td><strong>Peso del pacco (kg)</strong></td>
                <td><?php echo htmlspecialchars($peso); ?> kg</td>
            </tr>
            <tr>
                <td><strong>Costo per chilogrammo</strong></td>
                <td><?php echo $costo; ?> euro</td>
            </tr>
            <tr>
                <td><strong>Supplemento aereo</strong></td>
                <td><?php echo $aereo_costo; ?> euro</td>
            </tr>
            <tr>
                <td><strong>Costo totale</strong></td>
                <td><strong><?php echo $costo_tot; ?> euro</strong></td>
            </tr>
        </table>
        <p>Richiesta di spedizione effettuata correttamente</p>
    <?php endif; ?>
</body>
</html>