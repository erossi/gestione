<? if (file_exists('../../default.php')) { include '../../default.php'; } ?>
<? if (file_exists('../../procedure/utility.php')) { include '../../procedure/utility.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<META HTTP-EQUIV="REFRESH" CONTENT="1; URL=../articoli_list.php">

<html>
<head>
    <title><? print $prog_name ?> - Magazzino</title>
    <link rel="stylesheet" href="../../stylesheet.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<font face="arial,helvetica,sans-serif" size="2">

<? print_top($prog_name); ?>
<? print_navigation('Modifica articolo','Home Page','../contents.php','Magazzino','../magazzino_index.php'); ?>
<? print_title('Modifica articolo'); ?>

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
 print '$prezzo_acq	: ' . $prezzo_acq . '<BR>';
 print '$prezzo_ven1	: ' . $prezzo_ven1 . '<BR>';
 print '$data_ultimo_acq: ' . $data_ultimo_acq . '<BR>';

 }
 
    // imposto la tabella e controllo i valori inseriti
//    print '<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">';
    print '<tr>';
    print '    <td align="left" valign="top" width="70%" bgcolor="#e0e0e0">';
    print '    <font face="arial,helvetica,sans-serif" size="2">';
   
    $errori=0;
    if ($descrizione == '' || $quantita == '')
     {
     print '<b>Attenzione:</b> 
     Dovete compilare almeno i campi codice, descrizione, quantita.<br>';
     $errori++; }
    $codice_art=strtoupper($codice_art);
    $descrizione=strtolower($descrizione);
    $descrizione2=strtolower($descrizione2);
    
    if ($data_ultimo_acq == '') {$data_ultimo_acq='now';}
    
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
    
    $query="UPDATE magazzino SET
	    descrizione='" . $descrizione . "',
	    descrizione2='" . $descrizione2 . "',
	    quantita=" . $quantita . ",
	    prezzo_acq='" . $prezzo_acq . "',
	    prezzo_ven1='" . $prezzo_ven1 . "',
	    data_ultimo_acq='" . $data_ultimo_acq . "' WHERE oid=" . $oid;

    if ($DEBUG) { print 'Insert query: <b>' . $query . '</b><br>'; };
    $result = db_execute($conn,$query);

    if (!$result) {
        if ($DEBUG) { print 'file articles_insert_commit error: cannot execute query.\n'; };
        exit;
    };

    // chiudo la connessione
    db_close($conn);
    


?>
    <ul>
    <li>&nbsp;Articolo modificato. Adesso potete:<br>
    <ul>
    <li>&nbsp;<a href="../articoli_list.php">Tornare alla lista degli articoli.</a>
    <li>&nbsp;<a href="../articolo_index.php">Tornare all indice di Magazzino.</a>
    </ul>
    </ul>
    </tr>
    </table>

</body>
</html>
