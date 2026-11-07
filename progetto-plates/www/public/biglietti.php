<?php

require '../vendor/autoload.php';

use League\Plates\Engine;

$templates = new Engine('../templates', 'tpl');

$zone = [1 => 1.4, 2 => 1.8, 3 => 2.2];
$tipi = [
    'corsa'       => ['nome' => 'Corsa singola', 'moltiplicatore' => 1],
    'orario'      => ['nome' => 'Durata oraria', 'moltiplicatore' => 1.5],
    'giornaliero' => ['nome' => 'Giornaliero', 'moltiplicatore' => 2],
];
$max = 5;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo $templates->render('biglietti_form', [
        'zone'  => $zone,
        'tipi'  => $tipi,
        'max'   => $max,
        'errori' => [],
        'dati'  => [],
    ]);
    exit;
}

$nominativo = trim($_POST['nominativo'] ?? '');
$zona = (int)($_POST['zona'] ?? 0);
$tipo = $_POST['tipo'] ?? '';
$quantita = (int)($_POST['quantita'] ?? 0);

$errori = [];
if ($nominativo === '') {
    $errori[] = 'Inserire il nominativo';
}
if (!isset($zone[$zona])) {
    $errori[] = 'Zona non valida';
}
if (!isset($tipi[$tipo])) {
    $errori[] = 'Tipo di biglietto non valido';
}
if ($quantita < 1 || $quantita > $max) {
    $errori[] = 'La quantità deve essere tra 1 e ' . $max;
}

if ($errori) {
    echo $templates->render('biglietti_form', [
        'zone'  => $zone,
        'tipi'  => $tipi,
        'max'   => $max,
        'errori' => $errori,
        'dati'  => $_POST,
    ]);
    exit;
}

$biglietti = [];
for ($i = 0; $i < $quantita; $i++) {
    $codice = '';
    for ($j = 0; $j < 18; $j++) {
        $codice .= random_int(0, 9);
    }
    $biglietti[] = [
        'nominativo' => $nominativo,
        'data'       => (new DateTime())->format('d/m/Y H:i:s'),
        'costo'      => round($zone[$zona] * $tipi[$tipo]['moltiplicatore'], 2),
        'codice'     => $codice,
        'zona'       => $zona,
        'tipo'       => $tipi[$tipo]['nome'],
    ];
}

echo $templates->render('biglietti', ['biglietti' => $biglietti]);
