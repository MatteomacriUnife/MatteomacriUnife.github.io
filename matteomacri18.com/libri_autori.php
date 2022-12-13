<!-- Connessione al database -->
<?php include 'connessione.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="Author" content="Matteo Macri">
    <meta name="description" content="Progetto Biblioteca">
    <title>Libri dell'Autore</title>

    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <h1>Libri dell'Autore</h1>
    <p>Visualizzazione di tutti i libri di un determinato autore, eventualmente suddivisi per
        anno di pubblicazione.
    </p>

    <form action="libri_autori.php" method="POST">
        <fieldset id="fs_search">
            <input id="editText" type="text" placeholder="Nome" style="font-size: 20px" name="autore">
            <input id="submit" type="submit" value="Cerca">
        </fieldset>
    </form>

    <!-- PHP QUERY: è possibile cercare l'autore per nome o cognome o nome e cognome -->
    <?php
    $sql = "SELECT AUTORE.ID_AUTORE, AUTORE.NOME_AUTORE, AUTORE.COGNOME_AUTORE, LIBRO.CODICE, LIBRO.TITOLO, LIBRO.ANNO_PUBBLICAZIONE 
            FROM SCRITTO_DA INNER JOIN AUTORE ON SCRITTO_DA.CODICE_AUTORE=AUTORE.ID_AUTORE INNER JOIN
            LIBRO ON SCRITTO_DA.CODICE_LIBRO=LIBRO.CODICE
            WHERE (AUTORE.NOME_AUTORE LIKE '" . $_POST['autore'] . "')
                OR (AUTORE.COGNOME_AUTORE LIKE '" . $_POST['autore'] . "')
                OR (CONCAT(AUTORE.NOME_AUTORE, ' ', AUTORE.COGNOME_AUTORE) LIKE '" . $_POST['autore'] . "%')
                OR (CONCAT(AUTORE.COGNOME_AUTORE, ' ', AUTORE.NOME_AUTORE) LIKE '" . $_POST['autore'] . "%')
            ORDER BY LIBRO.ANNO_PUBBLICAZIONE;
            ";
    $query = mysqli_query($link, $sql);

    if (!$query) {
        echo "Si è verificato un errore: " . mysqli_error($link);
        exit;
    }

    mysqli_close($link);
    ?>

    <?php if (!empty($_POST['autore'])) : ?>
        <table>
            <thead>
                <tr>
                    <th>ID autore</th>
                    <th>Nome autore</th>
                    <th>Cognome autore</th>
                    <th>Codice libro</th>
                    <th>Titolo</th>
                    <th>Anno pubblicazione</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) : ?>
                    <tr>
                        <td><?php echo "{$row['ID_AUTORE']}"; ?></td>
                        <td><?php echo "{$row['NOME_AUTORE']}"; ?></td>
                        <td><?php echo "{$row['COGNOME_AUTORE']}"; ?></td>
                        <td><?php echo "{$row['CODICE']}"; ?></td>
                        <td><?php echo "{$row['TITOLO']}"; ?></td>
                        <td><?php echo "{$row['ANNO_PUBBLICAZIONE']}"; ?></td>
                    </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    <?php endif ?>
</body>

</html>