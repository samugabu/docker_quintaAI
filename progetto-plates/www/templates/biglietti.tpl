<!doctype html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Biglietti</title>
</head>
<body>
    <?php foreach ($biglietti as $b): ?>
        <div>
            <img src="img/logo.svg" alt="BUS SPA">
            <p>Nominativo: <?= $this->e($b['nominativo']) ?></p>
            <p>Zona <?= $b['zona'] ?> - <?= $this->e($b['tipo']) ?></p>
            <p>Acquisto: <?= $b['data'] ?></p>
            <p>Costo: <?= number_format($b['costo'], 2, ',', '') ?> €</p>
            <p>Codice: <?= $b['codice'] ?></p>
        </div>
        <hr>
    <?php endforeach ?>
</body>
</html>
