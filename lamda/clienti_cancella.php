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
    $query="SELECT oid,* FROM clienti WHERE oid=$oid";
    // eseguo la query
    $result = pg_exec ($conn, $query );
    if (!$result) {
        print "errore durante l'esecuzione della query.<br>" .
              "query: <b>" . $query . "</b><br>" .
              "file: <b>clienti_info</b><br>";
        exit;
    }

    // leggo il risultato
    $arr=pg_fetch_array ($result, 0);

    print '&nbsp;<img src="../icone/freccia.png" width="15" height="15" border="0" vspace="2" align="absmiddle"> Conferma cancellazione';

    // stampo tutta la tabella
    print '<form action="clienti_cancella_esegui.php" method="post">';
    print '<table width="90%" cellpadding="1" cellspacing="5" border="0">';
    //
    print '<tr>';
    print '    <td align="right" valign="middle">';
    print '        <font size="2" face="arial,helvetica">';
    print '            Codice unico identificativo del database (oid):<br>';
    print '            Data di iscrizione:<br>';
    print '            Stato:<br><br>';
    print '            Ragione sociale:<br>';
    print '            Partita IVA:<br>';
    print '            Responsabile commerciale:<br>';
    print '            E-mail:<br>';
    print '        </font>';
    print '    </td>';
    print '    <td align="left" valign="middle">';
    print '        <font size="2" face="arial,helvetica">';
    print '            <i>' . $arr["oid"] . '</i> (non modificabile)<br>';
    print '            <i>' . $arr["iscrdata"] . '</i> (non modificabile)<br>';
    if ($arr["stato"]=="a") {
        print '            <i>Abilitato</i><br><br>';   // non dovrebbe esserlo ma non si sa mai
    } else {
        print '            <i>In attesa di registrazione</i><br><br>';
    }
    print '            <i>' . $arr["ragsoc"] . "</i><br>";
    print '            <i>' . $arr["piva"] . "</i><br>";
    print '            <i>' . $arr["respcom"] . "</i><br>";
    print '            <i>' . $arr["email"] . "</i><br>";
    print '        </font>';
    print '    </td>';
    print '</tr>';
    print '</table><br>';
    print '<input type="hidden" name="tipo" value="' . $tipo . '"></input>';
    print '<input type="hidden" name="oid" value="' . $oid . '"></input>';
    print '<input type="submit" value="Ok, cancella"></input>';
    print '</form>';

    print '<form action="clienti_elenca.php" method="post">';
    print '<input type="hidden" name="tipo" value="' . $tipo . '"></input>';
    print '<input type="submit" value="Annulla">';
    print '</form>';

    // chiudo la connessione
    pg_close ($conn);
?>

</body>
</html>