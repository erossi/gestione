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
    print_title("Abilitazione clienti");

    // connessione al database
    $conn = db_connect($db_host,$db_porta,$db_nome,$db_utente);

    print '&nbsp;<img src="../icone/freccia.png" width="15" height="15" border="0" vspace="2" align="absmiddle"> Informazioni generali';

    print '<table width="90%" cellpadding="1" cellspacing="5" border="0">';
    print '<tr>';
    print '    <td align="center"><font size="2" face="arial,helvetica">';
    print "        modifica dell'oid: " . $oid . "<br>";
    switch ($listino) {
        case $nome_listino[1]:
            $list_num=1;
            break;
        case $nome_listino[2]:
            $list_num=2;
            break;
        case $nome_listino[3]:
            $list_num=3;
            break;
        default:
            $list_num=0;
    }
    print "Il listino assegnato all'utente &egrave;: <i>" . $nome_listino[$list_num] . "</i> (" . $list_num . ")<br><br>";
    print "Lo username assegnato &egrave; <i>" . $username . "</i>.<br>";
    print "La password assegnata &egrave; <i>" . $password . "</i>.<br>";

    // inizializzo la query
    $query="UPDATE clienti set password='" . $password . "', codice='" . $username .
           "', listino=" . $list_num . ", status='a' where oid=" . $oid;
    // eseguo la query
    $result = pg_exec ($conn, $query );
    if (!$result) {
        print "errore durante l'esecuzione della query.<br>" .
              "query: <b>" . $query . "</b><br>" .
              "file: <b>clienti_abilita_esegui</b><br>";
        exit;
    }

    print "        Abilitazione completata con successo.<br>";
    print '    </font></td>';
    print '</tr>';
    print '</table>';

    // inizializzo la query
    $query="SELECT email FROM clienti WHERE oid=" . $oid;
    // eseguo la query
    $result = pg_exec ($conn, $query );
    if (!$result) {
        print "errore durante l'esecuzione della query.<br>" .
              "query: <b>" . $query . "</b><br>" .
              "file: <b>clienti_abilita_esegui</b><br>";
        exit;
    }

    // leggo il risultato
    $arr=pg_fetch_array ($result, 0);

    print '&nbsp;<img src="../icone/freccia.png" width="15" height="15" border="0" vspace="2" align="absmiddle"> Messaggio da spedire';

    // preparo la form per la spedizione del messaggio
    print '<form action="clienti_abilita_messaggio.php?oid=' . $oid . '" method="post">';
    print '<table width="90%" cellpadding="1" cellspacing="5" border="0">';
    print '<tr>';
    print '    <td align="right" valign="middle"><font size="2" face="arial,helvetica">indirizzo e-mail:</font></td>';
    print '    <td align="left" valign="middle"><input type="text" size="65" name="indirizzo" value="' . $arr[email] . '"></input></td>';
    print '</tr>';
    print '<tr>';
    print '    <td align="right" valign="top"><font size="2" face="arial,helvetica">testo del messaggio:</font></td>';
    print '    <td align="left" valign="middle">';

    $testo_del_messaggio = "Siamo lieti di informarLa che la Sua richiesta di inserimento\n" .
                           "come utente registrato &egrave; stata accettata. Da questo\n" .
                           "momento Lei port&agrave; accedere ai nostri listini inserendo\n" .
                           "i seguenti dati:\n\n" .
                           "   Codice utente (username): " . $username . "\n" .
                           "   Password: " . $password . "\n\n" .
                           "Il listino che le abbiamo assegnato &egrave; il listino " . $nome_listino[$list_num] . ".\n\n" .
                           "Cordialmente,\n" .
                           "   Lamda Informatica";

    print '<textarea wrap="logical" cols="65" rows="15" name="messaggio">' . $testo_del_messaggio . '</textarea></td>';
    print '</tr>';
    print '</table><br>';
    print '<input type="submit" value="Spedisci messaggio"></input>&nbsp;<input type="reset" value="Annulla modifiche"></input>';
    print '</form>';

    // chiudo la connessione
    pg_close ($conn);
?>

</body>
</html>