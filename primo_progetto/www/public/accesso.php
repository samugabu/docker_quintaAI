<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $utente = isset($_POST['utente']) ? trim($_POST['utente']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $errori = [];

    if ($password < 8) {
        $errori[] = "La password deve contenere almeno 8 caratteri.";
    }

    if (!preg_match('/[A-Z]/', $password)) {
        $errori[] = "La password deve contenere almeno una lettera maiuscola.";
    }

    if (!preg_match('/[0-9]/', $password)) {
        $errori[] = "La password deve contenere almeno una cifra.";
    }

    if (!empty($errori)) {
        echo "<!DOCTYPE html>";
        echo "<html lang='it'>";
        echo "<head><meta charset='UTF-8'><title>Accesso negato</title></head>";
        echo "<body>";
        echo "<h1>Accesso negato</h1>";
        echo "<p>La password non rispetta i requisiti richiesti.</p>";
        echo "<br>";
        echo "<a href='accesso.html'>Indietro</a>";
        echo "</body>";
        echo "</html>";
    } else {
        header("Location: areaRiservata.php");
        exit();
    }
} else {
    header("Location: accesso.html");
    exit();
}