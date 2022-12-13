<!-- Connessione al database -->
<?php include 'connessione.php'; ?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" />
    <meta name="Author" content="Matteo Macri">
    <meta name="description" content="Progetto Biblioteca">
    <title>Classifica studenti</title>

    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <h1>Classifica Studenti</h1>
    <p>Classifica degli studenti che ha effettuato più prestiti</p>

    <!-- PHP QUERY: è possibile cercare l'autore per nome o cognome o nome e cognome -->
    <?php
    $sql_studente = "SELECT STUDENTE.MATRICOLA, STUDENTE.NOME, STUDENTE.COGNOME
                    FROM PRESTITO INNER JOIN STUDENTE ON PRESTITO.CODICE_MATRICOLA=STUDENTE.MATRICOLA 
                    GROUP BY STUDENTE.MATRICOLA, STUDENTE.NOME, STUDENTE.COGNOME
                    HAVING COUNT(*) >= 1
                    ORDER BY COUNT(*) DESC;
                    ";
    $query_studente = mysqli_query($link, $sql_studente);

    $sql_count = "SELECT COUNT(*)
                    FROM PRESTITO INNER JOIN STUDENTE ON PRESTITO.CODICE_MATRICOLA=STUDENTE.MATRICOLA
                    GROUP BY STUDENTE.MATRICOLA
                    ORDER BY COUNT(*) DESC;";

    $query_count =  mysqli_query($link, $sql_count);

    if (!$query_studente || !$query_count) {
        echo "Si è verificato un errore: " . mysqli_error($link);
        exit;
    }

    mysqli_close($link);
    ?>

    <table>
        <thead>
            <tr>
                <th>Matricola</th>
                <th>Nome</th>
                <th>Cognome</th>
                <th>No. Prestiti</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_array($query_studente, MYSQLI_ASSOC)) :
                $row_c = mysqli_fetch_array($query_count, MYSQLI_ASSOC) ?>
                <tr>
                    <td><?php echo "{$row['MATRICOLA']}"; ?></td>
                    <td><?php echo "{$row['NOME']}"; ?></td>
                    <td><?php echo "{$row['COGNOME']}"; ?></td>
                    <td><?php echo "{$row_c['COUNT(*)']}"; ?></td>
                </tr>
            <?php endwhile ?>
        </tbody>
    </table>

</body>

</html>