<!-- Connessione al database -->
<?php include 'connessione.php'; ?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" />
    <meta name="Author" content="Matteo Macri">
    <meta name="description" content="Progetto Biblioteca">
    <title>Prestiti in scadenza</title>

    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <h1>Prestiti in scadenza</h1>
    <p>Ricerca dei prestiti effettuati in un range di date - nel caso in cui non vengano
        inserite date deve mostrare i prossimi in scadenza (quelli che scadranno in futuro).
    </p>

    <form action="prestiti_scadenza.php" method="POST">
        <fieldset id="fs_search">
            <label style="margin-left: 5px;">Data uscita</label>
            <input id="editTextAutore" type="date" placeholder="Data inizio yyyy-mm-dd" style="font-size: 20px" name="data_inizio">
            <label>Data rientro</label>
            <input id="editTextAutore" type="date" placeholder="Data fine yyyy-mm-dd" style="font-size: 20px" name="data_fine">
            <input id="submit" type="submit" value="Cerca" style="margin-left:270px;">
        </fieldset>
    </form>

    <?php if (!empty($_POST['data_inizio'])) : ?>
        <p>Data uscita: <?php echo $_POST['data_inizio']; ?></p>
    <?php endif ?>

    <?php if (!empty($_POST['data_fine'])) : ?>
        <p>Data rientro: <?php echo $_POST['data_fine']; ?></p>
    <?php endif ?>

    <!-- manca solo con data uscita o rientro e senza che mostra solo le date future -->
    <!-- PHP QUERY -->
    <?php
    $from = date('Y-m-d', strtotime($_POST['data_inizio']));
    $to = date('Y-m-d', strtotime($_POST['data_fine']));


    if (!empty($_POST['data_inizio']) || !empty($_POST['data_fine'])) {
        $sql = "SELECT * FROM PRESTITO 
            WHERE (DATA_USCITA >= '$from' AND `DATA_RIENTRO` <= '$to')
            ;
            ";
        $query = mysqli_query($link, $sql);

        if (!$query) {
            echo "Si è verificato un errore: " . mysqli_error($link);
            exit;
        }
    
    }else{
        $sql = "SELECT * FROM PRESTITO 
            WHERE DATA_RIENTRO >= CURDATE();;
            ;
            ";
        $query = mysqli_query($link, $sql);

        if (!$query) {
            echo "Si è verificato un errore: " . mysqli_error($link);
            exit;
        }

        echo "<p>Prestiti prossimi alla scadenza:</p>";
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