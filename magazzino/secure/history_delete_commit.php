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
<? print_navigation('Cancella storico','Home Page','../contents.php','Magazzino','../articolo_index.php'); ?>
<? print_title('Cancella storico'); ?>

<?
    // connessione al database
    $conn=db_connect($db_host,$db_port,$db_name,$db_user);

    // cancello l'articolo
    $query="DELETE FROM movimenti WHERE oid='" . $oid . "'";
    $result = pg_exec ($conn,$query);

    if ($debug) { print 'query: <b>' . $query . '</b><br>'; };

    if (!$result) {
        if ($debug) { print 'file history_delete_commit error: cannot execute query.\n'; };
        exit;
    };

    // chiudo la connessione
    db_close($conn);

    // imposto la tabella e stampo un messaggio
    print '<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">';
    print '<tr>';
    print '    <td align="left" valign="top" width="70%" bgcolor="#e0e0e0">';
    print '    <font face="arial,helvetica,sans-serif" size="2">';
    print '    Rigo di storico cancellato.';
    print '    <form action="../articoli_list.php">';
    print '        <input type="submit" value="Torna alla lista articoli">';
    print '    </form>';
    print '    </font>';
    print '    </td>';
    print '</tr>';
    print '</table>'; 
    
?>

</body>
</html>
