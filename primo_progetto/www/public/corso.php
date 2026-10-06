<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cognome = isset($_POST['cognome']) ? trim($_POST['cognome']) : '';
        $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $corso = isset($_POST['corso']) ? $_POST['corso'] : '';
        $livello = isset($_POST['livello']) ? $_POST['livello'] : '';
        $richieste = isset($_POST['richieste']) ? trim($_POST['richieste']) : 'nessuna';
        $orari = isset($_POST['orario']) ? $_POST['orario'] : [];

        if (empty($cognome) || empty($nome) || empty($email) || empty($corso) || empty($livello)) {
            die("<p style='color:red;'>Errore: Compilare tutti i campi obbligatori. </p>");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("<p style='color:red;'>Errore: L'indirizzo e-mail inserito non è valido.</p>");
        }

        $orari_testo = !empty($orari) ? implode(", ", $orari) : "Nessuna preferenza specificata";
        echo "<p>Gentile " . htmlspecialchars($cognome) . " " . htmlspecialchars($nome) . "</p>";
        echo "<p>Lei ha richiesto l'iscrizione al corso " . htmlspecialchars($corso) . " livello " . htmlspecialchars($livello) . " con orari:</p>";
        echo "<p>" . htmlspecialchars($orari_testo) . "</p>";
        echo "<p><strong>Altre richieste:</strong><br>" . nl2br(htmlspecialchars($richieste)) . "</p>";
        echo "<p>Stiamo verificando tutti i dati, le invieremo la risposta a " . htmlspecialchars($email) . "</p>";

    } else {
        header("Location: index.php");
        exit();
    }
?>