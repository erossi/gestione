<? if (file_exists('../default.php')) { include('../default.php'); } ?>
<? if (file_exists('./procedure/utility.php')) { include('./procedure/utility.php'); } ?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title>Gestione Web</title>
    <link rel="stylesheet" href="../lamda.css">
</head>
<body text="black" bgcolor="white" link="#ffa000" alink="#ffa000" vlink="#ffa000" leftmargin="0" topmargin="0">

<font face="arial" size="2">
<div align="left">
<br>

<?
    print_title('Listino attuale');

    // connessione al database
    $conn = db_connect($db_host,$db_porta,$db_nome,$db_utente);

    // imposto la query
    $query="SELECT count(*) FROM articoli";

    // eseguo la query
    $result = pg_exec ($conn, $query );
    if (!$result)
    {
       echo "Errore durante la query: <b>" . $query . "</b>.\n";
       exit;
    }

    // leggo il numero di articoli
    $arr = pg_fetch_array ($result, 0);

    print '&nbsp;<img src="../icone/freccia.png" width="15" height="15" border="0" vspace="2" align="absmiddle"> totale articoli nel listino: ' . $arr[0] .'<br>';

    // se non ci sono articoli esci!!
    if ($arr[0] == 0) {
        print '&nbsp;<img src="../icone/freccia.png" width="15" height="15" border="0" vspace="2" align="absmiddle"> non ci sono articoli in listino<br>';
        exit;
    }

    // -------------------------------------------------
    // elenco gli articoli per categoria
    // -------------------------------------------------

    // imposto la query
    $query="SELECT * FROM categorie";
    // eseguo la query
    $result_categorie = pg_exec ($conn, $query);
    if (!$result)
    {
       echo "si &egrave; verificato un errore durante la query.\n";
       exit;
    }
    // leggo il risultato e il numero di righe
    $numero_righe=pg_numrows($result_categorie);
    // controllo se c'e` almeno una categoria
    if ($numero_righe == 0) {
        print '&nbsp;<img src="../icone/freccia.png" width="15" height="15" border="0" vspace="2" align="absmiddle"> Non ci sono categorie.<br>';
    } else {
        for ($indice=0; $indice<$numero_righe; $indice++) {
            $categoria = pg_fetch_array ($result_categorie, $indice);

            $titolo = $categoria["categoria"];

            // reimposto la query
            $query="SELECT * FROM articoli WHERE categoria='" . $categoria["categoria"] ."'";
            // eseguo la query
            $result = pg_exec ($conn, $query);
            if (!$result)
            {
               echo "Errore durante la query: <b>" . $query . "</b>.\n";
               exit;
            }

            print_articles($result,$categoria['categoria']);

        } // fine loop articoli per categoria
    } // fine loop categorie


    // -------------------------------------------------
    // elenco gli orfani
    // -------------------------------------------------

    // ricerco gli orfani
    $query="SELECT * FROM articoli WHERE categoria NOT IN (SELECT categoria FROM categorie)";
    // eseguo la query
    $result = pg_exec ($conn, $query);
    if (!$result)
    {
       echo "Si &egrave; verificato un errore durante la query.\n";
       exit;
    }

    print_articles($result,"Articoli non presenti in nessuna categoria");

    // chiudo la connessione
    pg_close ($conn);
?>

</body>
</html>