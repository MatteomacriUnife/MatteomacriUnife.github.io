<!-- verifico connessione al database -->
<?php //include 'connessione.php'; ?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8" />
    <meta name="Author" content="Matteo Macri">
    <meta name="description" content="Progetto Biblioteca">
    <title>Biblioteca</title>

    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <h1>Biblioteca Università degli Studi di Ferrara</h1>

    <!-- indice della pagina -->
    <fieldset id="fs_index">
        <ol>
            <li><a href="libri.php">LIBRI nella BIBLIOTECA</a></li>
            <li><a href="libri_autori.php">LIBRI dell'AUTORE</a></li>
            <li><a href="autori.php">AUTORI</a></li>
            <li><a href="studenti.php">STUDENTI della BIBLIOTECA</a></li>
            <li><a href="prestiti_studente.php">PRESTITI STUDENTE</a></li>
            <li><a href="prestiti.php">STORICO PRESTITI</a></li>
            <li><a href="prestiti_scadenza.php">PRESTITI in SCADENZA</a></li>
            <li><a href="statistiche.php">STATISTICHE</a></li>
            </br>
            <li style="list-style: none">QUERY AGGIUNTIVE:</li>
            <li><a href="classifica_studenti.php">CLASSIFICA STUDENTI</a></li>
            <li><a href="hot_books.php">HOT BOOKS</a></li>
        </ol>
    </fieldset>
</body>


</html>