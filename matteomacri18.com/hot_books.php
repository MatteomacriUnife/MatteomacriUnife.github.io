<!-- Connessione al database -->
<?php include 'connessione.php'; ?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" />
    <meta name="Author" content="Matteo Macri">
    <meta name="description" content="Progetto Biblioteca">
    <title>Hot Books</title>

    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <h1>Hot Books</h1>
    <p>Classifica dei libri piu preso in prestito</p>

    <!-- PHP QUERY: è possibile cercare l'autore per nome o cognome o nome e cognome -->
    <?php
    $sql_studente = "SELECT LIBRO.TITOLO
	                FROM PRESTITO INNER JOIN LIBRO ON PRESTITO.CODICE_LIBRO=LIBRO.CODICE 
	                GROUP BY LIBRO.TITOLO
                    HAVING COUNT(*)>=1
                    ORDER BY COUNT(*) DESC;
                    ";
    $query_studente = mysqli_query($link, $sql_studente);

    $sql_count = "SELECT COUNT(*)
	              FROM PRESTITO INNER JOIN LIBRO ON PRESTITO.CODICE_LIBRO=LIBRO.CODICE
                  GROUP BY LIBRO.CODICE
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
                <th>Titolo</th>
                <th>No. Prestiti</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_array($query_studente, MYSQLI_ASSOC)) :
                $row_c = mysqli_fetch_array($query_count, MYSQLI_ASSOC) ?>
                <tr>
                    <td><?php echo "{$row['TITOLO']}"; ?></td>
                    <td><?php echo "{$row_c['COUNT(*)']}"; ?></td>
                </tr>
            <?php endwhile ?>
        </tbody>
    </table>

</body>

</html>