<? if (file_exists('../../default.php')) { include '../../default.php'; } ?>
<? if (file_exists('../../procedure/utility.php')) { include '../../procedure/utility.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name ?> - Magazzino</title>
    <link rel="stylesheet" href="../../stylesheet.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<font face="arial,helvetica,sans-serif" size="2">

<? print_top($prog_name); ?>
<? print_navigation('Cancella storico','Home Page','../contents.php','Magazzino','../magazzino_index.php'); ?>
<? print_title('Cancella storico'); ?>

<?
    // connessione al database
    $conn=db_connect($db_host,$db_port,$db_name,$db_user);

    // stampo il risultato
    $query="SELECT * FROM movimenti WHERE oid='" . $oid . "'";
    $result = db_execute($conn,$query);
    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
    if (!$result) {
        if ($DEBUG) { print 'file history_delete.php error: cannot execute query.\n'; };
        exit;
    };

    // leggo in un array il risultato
    $arr=pg_fetch_array($result,0);

    // stampo le informazioni sul libro
    print '<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">';
    print '<tr>';
    print '    <td align="left" valign="top" width="70%" bgcolor="#e0e0e0">';
    print '    <font face="arial,helvetica,sans-serif" size="2">';
    print '    Avete richiesto la cancellazione del seguente rigo di storico<br><br>';
    print '    <table cellspacing="1" cellpadding="3" border="0">';
    print '    <tr>';
    print '        <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Data</font></td>';
    print '        <td>';
    print '            <font face="arial,helvetica,sans-serif" size="2">';
    print $arr['data_movimento'];
    print '            </font>';
    print '        </td>';
    print '    </tr>';

    print '    <tr>';
    print '        <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Codice Art.</font></td>';
    print '        <td>';
    print '            <font face="arial,helvetica,sans-serif" size="2">';
    print $arr['codice_art'];
    print '            </font>';
    print '        </td>';
    print '    </tr>';
    
    print '    <tr>';
    print '        <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Descrizione</font></td>';
    print '        <td><font face="arial,helvetica,sans-serif" size="2">' . $arr['descrizione'] . '</font></td>';
    print '    </tr>';
    
    print '    <tr>';
    print '        <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Tipo di Movimento</font></td>';
    print '        <td><font face="arial,helvetica,sans-serif" size="2">' . $arr['tipo_movimento'] . '</font></td>';
    print '    </tr>';

    print '    <tr>';
    print '        <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Prezzo</font></td>';
    print '        <td><font face="arial,helvetica,sans-serif" size="2">' . $arr['prezzo'] . '</font></td>';
    print '    </tr>';

    print '    <tr>';
    print '        <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Quantita</font></td>';
    print '        <td><font face="arial,helvetica,sans-serif" size="2">' . $arr['quantita'] . '</font></td>';
    print '    </tr>';

    print '    </table>';

    print '<form action="history_delete_commit.php">';
    print '    <input type="hidden" name="oid" value="' . $oid . '">';
    print '    <input type="submit" value="ESEGUI">';
    print '</form>';
/*
    print '<form action="../articoli_list.php">';
    print '    <input type="submit" value="Oops, Annulla!">';
    print '</form>';
*/
    print '    <a href="javascript:history.back(1)">Back</a> to previous screen.';
    print '    </font>';
    print '    </td>';
    print '    <td align="justify" valign="top" width="30%" bgcolor="#ffffe0">';
    print '    <font face="arial,helvetica,sans-serif" size="2">';
    print '    <div align="justify">';
    print '    <b>On-line Help</b><br>';
    print '    <br>';
    print '    Work in progress.<br>';
    print '    </div>';
    print '    </font>';
    print '    </td>';
    print '</tr>';
    print '</table>';
   
    // chiudo la connessione
    db_close($conn);
?>

</body>
</html>