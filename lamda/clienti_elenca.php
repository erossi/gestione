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
    print_title("Elenco clienti " . ($tipo=='r' ? "in attesa di registrazione" : "attivi"));
    
    // controlla il tipo di ordinamento
    switch ($ord) {
        case  "r": $order='ragsoc'; break;
        case  "p": $order='piva'; break;
        case  "c": $order='oid'; break;
	default: $order='ragsoc'; break;
    }

    // connessione al database
    $conn = db_connect($db_host,$db_porta,$db_nome,$db_utente);

    // inizializzo la query
    $query="SELECT oid,* FROM clienti WHERE status='" . $tipo . "' ORDER BY " . $order;
    // eseguo la query
    $result = pg_exec ($conn, $query );
    if (!$result) {
        echo "errore durante l'esecuzione della query.<br>" .
             "query: <b>" . $query . "</b><br>" .
             "file: <b>clienti_elenca</b><br>";
        exit;
    }

    // leggo il numero di righe risultanti
    $numero_clienti=pg_numrows($result);

    // stampo il risultato
    print "<table width=\"90%\" cellpadding=\"1\" cellspacing=\"0\" border=\"0\">";
    print '<tr>' .
          '<td><font face="arial,helvetica" size="2">' .
          '<a href="clienti_elenca.php?tipo=' . $tipo . '&ord=c">Codice OID</a><br><br>' .
          '</font></td>' .
          '<td><font face="arial,helvetica" size="2">' .
          '<a href="clienti_elenca.php?tipo=' . $tipo . '&ord=r">Ragione sociale</a><br><br>' .
          '</font></td>' .
          '<td><font face="arial,helvetica" size="2">' .
          '<a href="clienti_elenca.php?tipo=' . $tipo . '&ord=p">Partita IVA</a><br><br>' .
          '</font></td>' .
          '<td><font face="arial,helvetica" size="2">&nbsp<br><br></font></td>' .
          '</tr>';

    for ($indice=0; $indice<$numero_clienti; $indice++) {
        $arr = pg_fetch_array ($result, $indice);
        if (($indice % 2)) {
            $attributi = " bgcolor=\"#e0e0e0\"";
        } else {
            $attributi = "";
        }
        print '<tr>';
        print '<td' . $attributi . '><font face="arial,helvetica" size="2">&nbsp;' . $arr["oid"]    . '</font></td>';
        print '<td' . $attributi . '><font face="arial,helvetica" size="2">&nbsp;<a href="clienti_info.php?oid=' . $arr[oid] . '&tipo=' . $tipo . '">' . $arr["ragsoc"] . '</a></font></td>';
        print '<td' . $attributi . '><font face="arial,helvetica" size="2">&nbsp;' . $arr["piva"]   . '</font></td>';
        print '<td' . $attributi . '>';
        if ($tipo=='r') {
            print '<a href="clienti_abilita.php?oid=' . $arr[oid] . '">Abilita</a>&nbsp;';
        } else {
            print '&nbsp;';
        }
        print '<a href="clienti_cancella.php?tipo=' . $tipo . '&oid=' . $arr[oid] . '">Cancella</a>';
        print '</td></tr>';
    }
    print '</table>';

    // chiudo la connessione
    pg_close ($conn);
?>

</body>
</html>