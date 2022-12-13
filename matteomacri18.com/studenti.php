<!-- Connessione al database -->
<?php include 'connessione.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="Author" content="Matteo Macri">
    <meta name="description" content="Progetto Biblioteca">
    <title>Studenti</title>

    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <h1>Studenti</h1>
    <p>Consultare l’elenco degli utenti della biblioteca (con le informazioni principali).</p>

    <form action="studenti.php" method="POST">
        <fieldset id="fs_search_autore">
            <input id="editTextAutore" type="text" placeholder="Matricola" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.key === 'Enter'" style="font-size: 20px" name="matricola">
            <input id="editTextAutore" type="text" placeholder="Nome Studente" style="font-size: 20px" name="nome">
            <input id="editTextAutore" type="text" placeholder="Cognome Studente" style="font-size: 20px" name="cognome">
            <input id="editTextAutore" type="text" placeholder="Indirizzo" style="font-size: 20px" name="indirizzo">
            <input id="editTextAutore" type="text" placeholder="Numero di telefono" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.key === 'Enter'" style="font-size: 20px" name="telefono">
            <input id="submitautore" type="submit" value="Cerca">
        </fieldset>
    </form>

    <!-- PHP QUERY -->
    <?php
    $sql = "SELECT * FROM STUDENTE
           WHERE MATRICOLA LIKE '" . $_POST['matricola'] . "%'
           AND NOME LIKE '" . $_POST['nome'] . "%'
           AND COGNOME LIKE '" . $_POST['cognome'] . "%'
           AND INDIRIZZO LIKE '%" . $_POST['indirizzo'] . "%'
           AND NUMERO_TELEFONICO LIKE '" . $_POST['telefono'] . "%'
           ORDER BY NOME;";
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
                <th>Matricola</th>
                <th>Nome studente</th>
                <th>Cognome studente</th>
                <th>Indirizzo</th>
                <th>Numero telefonico</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) : ?>
                <tr>
                    <td><?php echo "{$row['MATRICOLA']}"; ?></td>
                    <td><?php echo "{$row['NOME']}"; ?></td>
                    <td><?php echo "{$row['COGNOME']}"; ?></td>
                    <td><?php echo "{$row['INDIRIZZO']}"; ?></td>
                    <td><?php echo "{$row['NUMERO_TELEFONICO']}"; ?></td>
                </tr>
            <?php endwhile ?>
        </tbody>
    </table>

</body>

</html>