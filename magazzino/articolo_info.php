<? if (file_exists('../default.php')) { include '../default.php'; } ?>
<? if (file_exists('../procedure/utility.php')) { include '../procedure/utility.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name ?> - Magazzino</title>
    <link rel="stylesheet" href="../stylesheet.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<font face="arial,helvetica,sans-serif" size="2">

<? print_top($prog_name); ?>
<? print_navigation('Articolo info','Home Page','../contents.php','Magazzino','magazzino_index.php'); ?>
<? print_title('Articolo Info'); ?>

<?
    // connessione al database
    $conn=db_connect($db_host,$db_port,$db_name,$db_user);

    // stampo il risultato
    $query="SELECT oid,* FROM magazzino WHERE oid=" . $oid;
    $result = db_execute($conn,$query);
    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
    if (!$result) {
        if ($DEBUG) { print 'file articolo_info error: cannot execute query.\n'; };
        exit;
    };

    // leggo in un array il risultato
    $arr=pg_fetch_array($result,0);

    // stampo le informazioni sul libro
    
    print '<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">';
    print '<tr>';
    print '    <td align="left" valign="top" width="70%" bgcolor="#e0e0e0">';
    print '    <font face="arial,helvetica,sans-serif" size="2">';
    print '    Informazioni complete articolo codice <b>' . $arr['codice_art'] . '</b><br><br>';

    print '    <table cellspacing="1" cellpadding="3" border="0">';
    print '    <tr>';
    print '        <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Descrizione :</font></td>';
    print '        <td>';
    print '            <font face="arial,helvetica,sans-serif" size="2">';
    print $arr['descrizione'];
    if ($arr['descrizione2'] != "") { print ' (' . $arr['descrizione2'] . ')'; }    
    print '            </font>';
    print '        </td>';
    print '    </tr>';

    print '    <tr>';
    print '        <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Quant. disponibile :</font></td>';
    print '        <td>';
    print '            <font face="arial,helvetica,sans-serif" size="2">';
    print $arr['quantita'];
    print '            </font>';
    print '        </td>';
    print '    </tr>';
    print '    <tr>';
    print '        <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Prezzo di vendita :</font></td>';
    print '        <td><font face="arial,helvetica,sans-serif" size="2">' . $arr['prezzo_ven1'] . '</font></td>';
    print '    </tr>';
    print '    <tr>';
    print '        <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Prezzo di acquisto :</font></td>';
    print '        <td><font face="arial,helvetica,sans-serif" size="2">' . $arr['prezzo_acq'] . '</font></td>';
    print '    </tr>';
    print '    <tr>';
    print '        <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Data ultimo acquisto :</font></td>';
    print '        <td><font face="arial,helvetica,sans-serif" size="2">' . $arr['data_ultimo_acq'] . '</font></td>';
    print '    </tr>';
    print '    </table>';

    print '    <br>';
/*    
    print '    <form action="articolo_info.php">';
    print '        <input type="hidden" name="cod" value="' . $arr['codice_art'] . '">';
    print '        <input type="submit" value="Visualizza lo storico dell'articolo">';
    print '    </form>';
*/    
    print '    <a href="javascript:history.back(1)">Torna</a> alla schermata precedente.';
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
    pg_close ($conn);
?>

</body>
</html>