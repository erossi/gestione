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
    print_title("Elenco categorie");

    // controlla il tipo di ordinamento
    switch ($ord) {
        case "c": $order='categoria'; break;
        case "d": $order='descrizione'; break;
	default: $order='categoria'; break;
    }
    
    // connessione al database
    $conn = db_connect($db_host,$db_porta,$db_nome,$db_utente);

    // inizializzo la query
    $query="SELECT oid,* FROM categorie ORDER BY " . $order;
    // eseguo la query
    $result = pg_exec ($conn, $query );
    if (!$result) {
        echo "errore durante l'esecuzione della query.<br>" .
             "query: <b>" . $query . "</b><br>" .
             "file: <b>categorie_elenca</b><br>";
        exit;
    }

    // leggo il numero di righe risultanti
    $numero_clienti=pg_numrows($result);

    // stampo il risultato
    print "<table width=\"90%\" cellpadding=\"1\" cellspacing=\"0\" border=\"0\">";
    print '<tr>' .
          '<td><font face="arial,helvetica" size="2">' .
          '<a href="categorie_elenca.php?ord=c">Categoria</a><br><br>' .
          '</font></td>' .
          '<td><font face="arial,helvetica" size="2">' .
          '<a href="categorie_elenca.php?ord=d">Descrizione</a><br><br>' .
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
        print '<td' . $attributi . '><font face="arial,helvetica" size="2">&nbsp;' . $arr["categoria"]    . '</font></td>';
        print '<td' . $attributi . '><font face="arial,helvetica" size="2">&nbsp;' . $arr["descrizione"]   . '</font></td>';
        print '<td' . $attributi . '>';
        print '<a href="categorie_cancella.php?oid=' . $arr[oid] . '">Cancella</a>';
        print '</td>';
        print '</tr>';
    }
    print '</table>';

    // chiudo la connessione
    pg_close ($conn);
?>

</body>
</html>