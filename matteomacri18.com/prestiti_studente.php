<!-- Connessione al database -->
<?php include 'connessione.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="Author" content="Matteo Macri">
    <meta name="description" content="Progetto Biblioteca">
    <title>Prestiti studente</title>

    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <h1>Prestiti Studente</h1>
    <p>Ricerca di un utente della biblioteca e il suo storico dei prestiti (compresi quelli in
        corso).
    </p>

    <form action="prestiti_studente.php" method="POST">
        <fieldset id="fs_search_autore">
            <input id="editTextAutore" type="text" placeholder="ID prestito" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.key === 'Enter'" style="font-size: 20px" name="id_prestito">
            <input id="editTextAutore" type="text" placeholder="Matricola" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.key === 'Enter'" style="font-size: 20px" name="matricola">
            <input id="submitautore" type="submit" value="Cerca">
        </fieldset>
    </form>

    <!-- PHP QUERY -->
    <?php
    $sql = "SELECT * FROM PRESTITO
        WHERE ID_PRESTITO LIKE '" . $_POST['id_prestito'] . "%'
        AND CODICE_MATRICOLA LIKE '" . $_POST['matricola'] . "%';
    ";

    $query = mysqli_query($link, $sql);

    if (!$query) {
        echo "Si è verificato un errore: " . mysqli_error($link);
        exit;
    }

    mysqli_close($link);
    ?>

    <?php if (array_filter($_POST)) : ?>
        <table>
            <thead>
                <tr>
                    <th>ID prestito</th>
                    <th>Matricola</th>
                    <th>Codice libro</th>
                    <th>Codice succursale</th>
                    <th>Data uscita</th>
                    <th>Data rientro</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) : ?>
                    <tr>
                        <td><?php echo "{$row['ID_PRESTITO']}"; ?></td>
                        <td><?php echo "{$row['CODICE_MATRICOLA']}"; ?></td>
                        <td><?php echo "{$row['CODICE_LIBRO']}"; ?></td>
                        <td><?php echo "{$row['CODICE_SUCCURSALE']}"; ?></td>
                        <td><?php echo "{$row['DATA_USCITA']}"; ?></td>
                        <td><?php echo "{$row['DATA_RIENTRO']}"; ?></td>
                    </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    <?php endif ?>


</body>

</html>