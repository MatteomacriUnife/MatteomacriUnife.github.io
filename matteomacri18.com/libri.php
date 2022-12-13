<!-- Connessione al database -->
<?php include 'connessione.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="Author" content="Matteo Macri">
    <meta name="description" content="Progetto Biblioteca">
    <title>Libri nella Biblioteca</title>

    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <h1>Libri nella Biblioteca</h1>
    <p>Ricerca di un libro inserendo il titolo (anche parziale) - nel caso in cui nessun
        parametro venga specificato deve essere presentata la lista completa dei libri.
    </p>

    <form action="libri.php" method="POST">
        <fieldset id="fs_search">
            <input id="editText" type="text" placeholder="Title" style="font-size: 20px" name="titolo" >
            <input id="submit" type="submit" value="Cerca">
        </fieldset>
    </form>

    <!-- PHP QUERY -->
    <?php
    $sql = "SELECT * FROM LIBRO 
            WHERE TITOLO LIKE '" . '%' . $_POST['titolo'] . "%';
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
                <th>Codice</th>
                <th id="th_titolo">Titolo</th>
                <th>ISBN</th>
                <th>Lingua</th>
                <th>Anno pubblicazione</th>
                <th>Copie</th>
                <th>Codice succursale</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) : ?>
                <tr>
                    <td><?php echo "{$row['CODICE']}"; ?></td>
                    <td id="td_titolo"><?php echo "{$row['TITOLO']}"; ?></td>
                    <td><?php echo "{$row['ISBN']}"; ?></td>
                    <td><?php echo "{$row['LINGUA']}"; ?></td>
                    <td><?php echo "{$row['ANNO_PUBBLICAZIONE']}"; ?></td>
                    <td><?php echo "{$row['COPIE']}"; ?></td>
                    <td><?php echo "{$row['CODICE_SUCCURSALE']}"; ?></td>
                </tr>
            <?php endwhile ?>
        </tbody>
    </table>


</body>

</html>