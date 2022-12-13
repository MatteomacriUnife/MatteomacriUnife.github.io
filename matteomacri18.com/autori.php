<!-- Connessione al database -->
<?php include 'connessione.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="Author" content="Matteo Macri">
    <meta name="description" content="Progetto Biblioteca">
    <title>Autori</title>

    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <h1>Autori</h1>
    <p>Ricerca degli autori inserendo uno o più parametri (anche parziali), in forma libera o
        eventualmente guidata (per esempio menù a tendina con i soli valori possibili).
    </p>

    <form action="autori.php" method="POST">
        <fieldset id="fs_search_autore">
            <input id="editTextAutore" type="text" placeholder="Nome Autore" style="font-size: 20px" name="nome">
            <input id="editTextAutore" type="text" placeholder="Cognome Autore" style="font-size: 20px" name="cognome">
            <input id="editTextAutore" type="date" placeholder="Data nascita" style="font-size: 20px" name="data_nascita">
            <input id="editTextAutore" type="text" placeholder="Luogo nascita" style="font-size: 20px" name="luogo_nascita">
            <input id="submitautore" type="submit" value="Cerca">
        </fieldset>
    </form>

    <!-- PHP QUERY -->
    <?php
    $sql = "SELECT * FROM AUTORE
        WHERE NOME_AUTORE LIKE '" . $_POST['nome'] . "%'
        AND COGNOME_AUTORE LIKE '" . $_POST['cognome'] . "%' 
        AND DATA_NASCITA LIKE '" . $_POST['data_nascita'] . "%'
        AND LUOGO_NASCITA LIKE '%" . $_POST['luogo_nascita'] . "%';
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
                    <th>ID autore</th>
                    <th>Nome autore</th>
                    <th>Cognome autore</th>
                    <th>Data nascita</th>
                    <th>Luogo nascita</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) : ?>
                    <tr>
                        <td><?php echo "{$row['ID_AUTORE']}"; ?></td>
                        <td><?php echo "{$row['NOME_AUTORE']}"; ?></td>
                        <td><?php echo "{$row['COGNOME_AUTORE']}"; ?></td>
                        <td><?php echo "{$row['DATA_NASCITA']}"; ?></td>
                        <td><?php echo "{$row['LUOGO_NASCITA']}"; ?></td>
                    </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    <?php endif ?>
</body>

</html>