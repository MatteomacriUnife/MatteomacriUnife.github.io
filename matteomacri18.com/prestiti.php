<!-- Connessione al database -->
<?php include 'connessione.php'; ?>

<!DOCTYPE html>
<html>


<head>
    <meta charset="utf-8" />
    <meta name="Author" content="Matteo Macri">
    <meta name="description" content="Progetto Biblioteca">
    <title>Storico Prestiti</title>

    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <h1>Storico Prestiti</h1>
    <p>Consultare lo storico dei prestiti</p>

    <form action="prestiti.php" method="POST">
        <fieldset id="fs_search">
            <input id="editText" type="text" placeholder="Numero prestito" style="font-size: 20px" name="prestito">
            <input id="submit" type="submit" value="Cerca">
        </fieldset>
    </form>

    <!-- PHP QUERY -->
    <?php
    $sql = "SELECT * FROM PRESTITO 
            WHERE ID_PRESTITO LIKE '" . $_POST['prestito'] . "%';
            ";
    $query = mysqli_query($link, $sql);

    if (!$query) {
        echo "Si è verificato un errore: " . mysqli_error($link);
        exit;
    }

    mysqli_close($link);
    ?>

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

</body>

</html>