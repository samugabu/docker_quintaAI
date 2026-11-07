<!doctype html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Acquisto biglietti</title>
</head>
<body>
    <h1>Acquisto biglietti autobus</h1>

    <?php if ($errori): ?>
        <ul>
            <?php foreach ($errori as $errore): ?>
                <li><?= $this->e($errore) ?></li>
            <?php endforeach ?>
        </ul>
    <?php endif ?>

    <form method="post" action="biglietti.php">
        <p>
            <label for="nominativo">Nominativo acquirente</label>
            <input type="text" id="nominativo" name="nominativo" required
                   value="<?= $this->e($dati['nominativo'] ?? '') ?>">
        </p>

        <p>
            <label for="zona">Zona</label>
            <select id="zona" name="zona" required>
                <?php foreach ($zone as $z => $base): ?>
                    <option value="<?= $z ?>" <?= (int)($dati['zona'] ?? 0) === $z ? 'selected' : '' ?>>
                        Zona <?= $z ?> (base <?= number_format($base, 2, ',', '') ?> €)
                    </option>
                <?php endforeach ?>
            </select>
        </p>

        <fieldset>
            <legend>Tipo di biglietto</legend>
            <?php foreach ($tipi as $chiave => $tipo): ?>
                <label>
                    <input type="radio" name="tipo" value="<?= $chiave ?>" required
                        <?= ($dati['tipo'] ?? '') === $chiave ? 'checked' : '' ?>>
                    <?= $this->e($tipo['nome']) ?>
                </label>
            <?php endforeach ?>
        </fieldset>

        <p>
            <label for="quantita">Numero di biglietti (max <?= $max ?>)</label>
            <input type="number" id="quantita" name="quantita" min="1" max="<?= $max ?>" required
                   value="<?= $this->e($dati['quantita'] ?? 1) ?>">
        </p>

        <button type="submit">Genera biglietti</button>
    </form>
</body>
</html>
