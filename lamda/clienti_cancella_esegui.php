<? if (file_exists('../default.php')) { include('../default.php'); } ?>
<? if (file_exists('./procedure/utility.php')) { include('./procedure/utility.php'); } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title>Gestione Web</title>
</head>
<body bgcolor="white" text="black" link="#000080" alink="#000080" vlink="#000080">

<font face="arial,helvetica,sans-serif" size="2">
<div align="left">
<br>

<?
    print_title("Cancellazione cliente");

    // connessione al database
    $conn = db_connect($db_host,$db_porta,$db_nome,$db_utente);

    // inizializzo la query
    $query="DELETE FROM clienti WHERE oid=" . $oid;
    // eseguo la query
    $result = pg_exec ($conn, $query );
    if (!$result) {
        print "errore durante l'esecuzione della query.<br>" .
              "query: <b>" . $query . "</b><br>" .
              "file: <b>clienti_abilita_esegui</b><br>";
        exit;
    }

    // chiudo la connessione
    pg_close ($conn);

    print '&nbsp;<img src="../icone/freccia.png" width="15" height="15" border="0" vspace="2" align="absmiddle"> Cancellazione completata con successo.';

    print '<form action="clienti_elenca.php">';
    print '    <input type="hidden" name="tipo" value="' . $tipo . '">';
    print '    <input type="submit" value="Ritorna all\'elenco utenti">';
    print '</form>';
?>

</body>
</html>