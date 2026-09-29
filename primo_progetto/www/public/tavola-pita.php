<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Tavola Pitagorica</title>
    <style>
        table {
            border-collapse: collapse;
        }
        td, th {
            border: 1px solid #333;
            width: 30px;
            height: 30px;
            text-align: center;
        }
        th {
            background-color: #ddd;
        }
    </style>
</head>
<body>
<div>
    <h1>Tavola Pitagorica</h1>
    <table>
        <?php
        $dimensione = 10;

        echo "<tr><th>X</th>";
        for ($colonna = 1; $colonna <= $dimensione; $colonna++) {
            echo "<th>" . $colonna . "</th>";
        }
        echo "</tr>";

        for ($riga = 1; $riga <= $dimensione; $riga++) {
            echo "<tr>";
            echo "<th>" . $riga . "</th>";
            for ($colonna = 1; $colonna <= $dimensione; $colonna++) {
                echo "<td>" . ($riga * $colonna) . "</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
</div>
</body>
</html>
