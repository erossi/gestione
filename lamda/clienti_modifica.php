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
    print_title("Modifica informazioni clienti");

    // connessione al database
    $conn = db_connect($db_host,$db_porta,$db_nome,$db_utente);

    print '&nbsp;<img src="../icone/freccia.png" width="15" height="15" border="0" vspace="2" align="absmiddle"> Informazioni generali';

    print '<table width="730" cellpadding="1" cellspacing="5" border="0">';
    print '<tr>';
    print '    <td><font size="2" face="arial,helvetica">';
    print "        Modifica dell'oid: " . $oid . "<br>";
    if ($tipo=='a') {
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
        print "        Il listino assegnato all'utente &egrave;: <i>" . $nome_listino[$list_num] . "</i> (" . $list_num . ")<br><br>";
    } else {
        print "        Non verranno aggiornati username, password, listini<br><br>";
    }
    print '    </font></td>';
    print '</tr>';
    print '</table>';

    // inizializzo la query
    $query="UPDATE clienti SET ragsoc='" . $rag_soc         . "', " .
                                "piva='" . $part_iva        . "', " .
                             "respcom='" . $resp_nome       . "', " .
                               "email='" . $resp_mail       . "', " .
                            "sede_via='" . $sede_indirizzo  . "', " .
                         "sede_civico='" . $sede_civico     . "', " .
                          "sede_citta='" . $sede_citta      . "', " .
                           "sede_prov='" . $sede_prov       . "', " .
                            "sede_cap='" . $sede_cap        . "', " .
                            "sede_tel='" . $sede_tel        . "', " .
                            "sede_fax='" . $sede_fax        . "', " .
                          "sede_stato='" . $sede_stato      . "', " .
                          "sede_via_2='" . $altre_indirizzo . "', " .
                       "sede_civico_2='" . $altre_civico    . "', " .
                        "sede_citta_2='" . $altre_citta     . "', " .
                       "sede_civico_2='" . $altre_civico    . "', " .
                         "sede_prov_2='" . $altre_prov      . "', " .
                          "sede_cap_2='" . $altre_cap       . "', " .
                          "sede_tel_2='" . $altre_tel       . "', " .
                          "sede_fax_2='" . $altre_fax       . "', " .
                        "sede_stato_2='" . $altre_stato     . "', " .
                            "attivita='" . $attivita        . "'  ";

    // se il cliente e` gia`  stato attivato e` possibile aggiornare anche username, password e listini
    if ($tipo=='a') {
        $query = $query . ", listino= " . $list_num        . " , " .
                             "codice='" . $username        . "', " .
                           "password='" . $password        . "'  ";
    }
    $query = $query . " where oid=" . $oid . "; " ;

    // per debug decommentare la riga sotto
    // print "query: <b>" . $query . "</b><br>";

    // eseguo la query
    $result = pg_exec ($conn, $query);
    if (!$result) {
        print "errore durante l'esecuzione della query.<br>" .
              "query: <b>" . $query . "</b><br>" .
              "file: <b>clienti_modifica</b><br>";
        exit;
    }

    print '&nbsp;<img src="../icone/freccia.png" width="15" height="15" border="0" vspace="2" align="absmiddle"> Modifica completata con succcesso';

    print '<form action="clienti_info.php">';
    print '    <input type="hidden" name="tipo" value="' . $tipo . '"></input>';
    print '    <input type="hidden" name="oid" value="' . $oid . '"></input>';
    print '    <input type="submit" value="Ritorna alla pagina informazioni"></input>';
    print '</form>';

    // chiudo la connessione
    pg_close ($conn);
?>

</body>
</html>