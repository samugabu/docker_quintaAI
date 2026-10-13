<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sistemazione = isset($_POST['sistemazione']) ? trim($_POST['sistemazione']) : '';
        $pizza = isset($_POST['pizza']) ? ($_POST['pizza']) : '';
        $livello = isset($_POST['livello']) ? $_POST['livello'] : '';
        $aggiunte = isset($_POST['aggiunte']) ? $_POST['aggiunte'] : [];

        if (empty($sistemazione) || empty($pizza)) {
            die("<p>Errore: Compilare tutti i campi obbligatori.</p>");
        }
    }

    $aggiunte_testo = !empty($aggiunte) ? implode(", ", $aggiunte) : "nessuna aggiunta specificata";

    echo "<p> La pizza " . htmlspecialchars($pizza) . " con impasto " . htmlspecialchars($livello) .
        " e con aggiunte di: " . htmlspecialchars($aggiunte_testo) . "</p>";
    echo "<p> E' stata correttamnte prenotata in: " . htmlspecialchars($sistemazione);
?>