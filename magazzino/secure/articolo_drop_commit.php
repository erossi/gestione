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
<? print_navigation('Scarica articolo','Home Page','../contents.php','Magazzino','../magazzino_index.php'); ?>
<? print_title('Scarica articolo'); ?>

<?

// Un po' di debugging

if ($DEBUG)
 {
 print 'Variabili in uso:<BR>';
 print '$oid		: ' . $oid . '<BR>';
 print '$codice_art	: ' . $codice_art . '<BR>';
 print '$descrizione	: ' . $descrizione . '<BR>';
 print '$descrizione2	: ' . $descrizione2 . '<BR>';
 print '$quantita	: ' . $quantita . '<BR>';
 print '$quantita_scarico: ' . $quantita_scarico . '<BR>';
 print '$prezzo_acq	: ' . $prezzo_acq . '<BR>';
 print '$prezzo_ven	: ' . $prezzo_ven1 . '<BR>';
 print '$data: ' . $data_vendita . '<BR>';

 }
 
    // imposto la tabella e controllo i valori inseriti
//    print '<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">';
    print '<tr>';
    print '    <td align="left" valign="top" width="70%" bgcolor="#e0e0e0">';
    print '    <font face="arial,helvetica,sans-serif" size="2">';
   
    $errori=0;
    if ($codice_art == '' || $quantita_scarico == '' || $prezzo_ven1 == '')
     {
     print '<b>Attenzione:</b> 
     Dovete compilare almeno i campi codice, quantita o prezzo vendita.<br>';
     $errori++; }

    if ($data_vendita == '') {$data_vendita='now';}
    
    // termina con un messaggio se ci sono errori
    if ($errori > 0 ) {
        print '     <br>Ci sono <b>' . $errori . '</b> errori. Please go <a href="javascript:history.back(1)">back</a> and modify insert string.';
        print '    </font>';
        print '    </td>';
        print '</tr>';
        print '</table>'; 
        exit;
    }
    
    // connessione al database
    $conn=db_connect($db_host,$db_port,$db_name,$db_user);
    
    if ($errori > 0 ) {
        print '     <br>Ci sono <b>' . $errori . '</b> errori. Please go <a href="javascript:history.back(1)">back</a>';
        print '    </font>';
        print '    </td>';
        print '</tr>';
        print '</table>'; 
        exit;
    }
    print '</ul>';
    
    // leggo gli articoli
    $query="SELECT quantita FROM magazzino WHERE codice_art='" . $codice_art ."'";
    $result = db_execute($conn,$query);

    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };

    if (!$result) {
        print 'file articolo_load error: cannot execute query.\n';
        exit;
    };

    // leggo in un array il risultato
    $arr=pg_fetch_array($result,0);
    $quantita = $arr['quantita'] - $quantita_scarico;
    
 print '<BR>Quantita attuale : <b>' . $arr['quantita'] . '</b><br>';
 print 'Quantita scarico  : <b>' . $quantita_scarico . '</b><br>';
 print 'Quantita totale  : <b>' . $quantita . '</b><br>';

    $query="UPDATE magazzino SET
	    quantita=" . $quantita . "
	    WHERE codice_art='" . $codice_art . "'";

    if ($DEBUG) { print 'Insert query: <b>' . $query . '</b><br>'; };
    $result = db_execute($conn,$query);

    if (!$result) {
        if ($DEBUG) { print 'file articles_drop_commit error: cannot execute query.\n'; };
        exit;
    };

    $query="INSERT INTO movimenti
	(codice_art, descrizione, tipo_movimento, quantita, prezzo, data_movimento)
	VALUES
	('" . $codice_art . "',
	'" . $note . "',
	'scarico di magazzino',
	" . $quantita_scarico . ",
	'" . $prezzo_ven1 . "',
	'" . $data_vendita . "')";
	
    if ($DEBUG) { print 'Insert query: <b>' . $query . '</b><br>'; };
    $result = db_execute($conn,$query);

    if (!$result) {
        if ($DEBUG) { print 'file articles_drop_commit error: cannot execute query.\n'; };
        exit;
    };

    // chiudo la connessione
    db_close($conn);
    


?>
    <ul>
    <li>&nbsp;Articolo scaricato. Adesso potete:<br>
    <ul>
    <li>&nbsp;<a href="../articoli_list.php">Tornare alla lista degli articoli.</a>
    <li>&nbsp;<a href="../articolo_index.php">Tornare all indice di Magazzino.</a>
    </ul>
    </ul>
    </tr>
    </table>

</body>
</html>
