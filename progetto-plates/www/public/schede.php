<?php

require '../vendor/autoload.php';

use League\Plates\Engine;

$template = new Engine('../templates', 'tpl');

$persone = [
    'mario',
    'anna',
    'giulia'
];

echo $template->render('schede',
    [
        'titolo' => 'Pietre d\'Inciampo',
        'persone' => $persone,
    ]
);

