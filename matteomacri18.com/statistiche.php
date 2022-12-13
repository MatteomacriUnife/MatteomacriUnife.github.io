<!-- Connessione al database -->
<?php include 'connessione.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="Author" content="Matteo Macri">
    <meta name="description" content="Progetto Biblioteca">
    <title>Statistiche</title>

    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <h1>Calcolo di statistiche relative a libri e autori:</h1>
    <form action="statistiche.php" method="POST">
        <fieldset id="fs_search_autore">
            <input id="editTextAutore" type="text" placeholder="Anno pubblicazione yyyy" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.key === 'Enter'" style="font-size: 20px" name="anno">
            <input id="editTextAutore" type="text" placeholder="Nome autore" style="font-size: 20px" name="autore">
            <input id="editTextAutore" type="text" placeholder="Nome succursale" style="font-size: 20px" name="succursale">
            <input id="submit" type="submit" value="Cerca">
        </fieldset>
    </form>

    <!-- PHP QUERY -->
    <?php
    $sql_anno = "SELECT * FROM LIBRO 
            WHERE ANNO_PUBBLICAZIONE LIKE '" . $_POST['anno'] . "%'
            ;
            ";
    $query_anno = mysqli_query($link, $sql_anno);

    $sql_autore = "SELECT AUTORE.ID_AUTORE, AUTORE.NOME_AUTORE, AUTORE.COGNOME_AUTORE, LIBRO.CODICE, LIBRO.TITOLO, LIBRO.ANNO_PUBBLICAZIONE 
            FROM SCRITTO_DA INNER JOIN AUTORE ON SCRITTO_DA.CODICE_AUTORE=AUTORE.ID_AUTORE INNER JOIN
            LIBRO ON SCRITTO_DA.CODICE_LIBRO=LIBRO.CODICE
            WHERE (AUTORE.NOME_AUTORE LIKE '" . $_POST['autore'] . "')
                OR (AUTORE.COGNOME_AUTORE LIKE '" . $_POST['autore'] . "')
                OR (CONCAT(AUTORE.NOME_AUTORE, ' ', AUTORE.COGNOME_AUTORE) LIKE '" . $_POST['autore'] . "%')
                OR (CONCAT(AUTORE.COGNOME_AUTORE, ' ', AUTORE.NOME_AUTORE) LIKE '" . $_POST['autore'] . "%');
            ";
    $query_autore = mysqli_query($link, $sql_autore);

    $sql_succursale = "SELECT * FROM PRESTITO 
            INNER JOIN LIBRO ON PRESTITO.CODICE_LIBRO=LIBRO.CODICE 
            INNER JOIN SUCCURSALE ON SUCCURSALE.ID_SUCCURSALE=LIBRO.CODICE_SUCCURSALE
            WHERE SUCCURSALE.NOME_SUCCURSALE LIKE '" . $_POST['succursale'] . "%';
           ";

    $query_succursale = mysqli_query($link, $sql_succursale);

    if (!$query_anno || !$query_autore || !$query_succursale) {
        echo "Si è verificato un errore: " . mysqli_error($link);
        exit;
    }

    mysqli_close($link);
    ?>

    <?php
    if (!empty($_POST['anno'])) : ?>
        <p style="margin: 50px;">Numero di libri nell'Anno pubblicazione <?php echo $_POST['anno']; ?> sono <?php echo mysqli_num_rows($query_anno); ?> libri</p>
    <?php endif ?>

    <?php
    if (!empty($_POST['autore'])) : ?>
        <p style="margin: 50px;"><?php echo $_POST['autore']; ?> ha scritto <?php echo mysqli_num_rows($query_autore); ?> libri</p>
    <?php endif ?>

    <?php
    if (!empty($_POST['succursale'])) : ?>
        <p style="margin: 50px;">Numero prestiti effettuati nella succursale <?php echo $_POST['succursale']; ?> sono <?php echo mysqli_num_rows($query_succursale); ?></p>
    <?php endif ?>

</body>

</html>