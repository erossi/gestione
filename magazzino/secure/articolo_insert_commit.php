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
<? print_navigation('Inserisci un nuovo articolo','Home Page','../contents.php','Magazzino','../magazzino_index.php'); ?>
<? print_title('Inserisci un nuovo articolo'); ?>

<?
// Un po' di debugging
if ($prezzo_ven1 == '' && $ricarico_vendita)
 {
 $temp = $prezzo_acq * $ricarico_vendita / 100;
 $prezzo_ven1 = bcadd($prezzo_acq,$temp,2);
 };
 
if ($DEBUG)
 {
 print 'Variabili in uso:<BR>';
 print '$codice_art	: ' . $codice_art . '<BR>';
 print '$descrizione	: ' . $descrizione . '<BR>';
 print '$descrizione2	: ' . $descrizione2 . '<BR>';
 print '$quantita	: ' . $quantita . '<BR>';
 print '$prezzo_acq	: ' . $prezzo_acq . '<BR>';
 print '$prezzo_ven1	: ' . $prezzo_ven1 . '<BR>';
 print '$data_ultimo_acq: ' . $data_ultimo_acq . '<BR>';
 print '$ricarico	: ' . $ricarico_vendita . '<BR>';
 print '$temp		: ' . $temp . '<BR>';
 
 

 }
 
    // imposto la tabella e controllo i valori inseriti
    print '<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">';
    print '<tr>';
    print '    <td align="left" valign="top" width="70%" bgcolor="#e0e0e0">';
    print '    <font face="arial,helvetica,sans-serif" size="2">';
   
    $errori=0;
    $quantita='0';
    if ($codice_art == '' || $descrizione == '' || $quantita == '')
     {
     print '<b>Attenzione:</b> 
     Dovete compilare almeno i campi codice, descrizione, quantita.<br>';
     $errori++; }
    $codice_art=strtoupper($codice_art);
    $descrizione=strtolower($descrizione);
    $descrizione2=strtolower($descrizione2);
/*
    if ($f_shelf == '') {
        print '<b>Warning:</b> You must insert shelf.<br>'; $errori++;
    } else {
        if (!ereg("[A-Z]{1}",$f_shelf)) { print '<b>Warning:</b> Shelf can be a character from A to Z.<br>'; $errori++; }
    }

    if ($f_number == '') {
        print '<b>Warning:</b> Number on the shelf missing.<br>'; $errori++;
    } else {
        if (!ereg("[0-9]{1,3}",$f_number)) { print '<b>Warning:</b> Number on the shelf invalid.<br>'; $errori++; }
    }
*/
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
    
    // controllo se esiste già la coppia shelf/number
    $query="SELECT count(*) FROM magazzino WHERE codice_art='" . $codice_art . "'";
    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
    
    $result = db_execute($conn,$query);
    // count ritorna sempre una riga
    $arr=pg_fetch_array($result,0);
    if ($DEBUG) { print 'Array 0 is: ' . $arr[0]; }
    if ($arr[0] > 0) {
        print '     <b>Attenzione:</b> Il codice articolo ' . $codice_art . 'e gia presente.<br>';
        $errori++;
    }

    if ($errori > 0 ) {
        print '     <br>Ci sono <b>' . $errori . '</b> errori. Please go <a href="javascript:history.back(1)">back</a>';
        print '    </font>';
        print '    </td>';
        print '</tr>';
        print '</table>'; 
        exit;
    }
    print '</ul>';
    
    // inserisco l'articolo
    $query="INSERT INTO magazzino(codice_art,descrizione,descrizione2,
	    quantita,prezzo_acq,prezzo_ven1,data_ultimo_acq)
	    VALUES 
	    ('" . $codice_art . "',
	    '" . $descrizione . "',
	    '" . $descrizione2 . "',
	    " . $quantita . ",
	    '" . $prezzo_acq . "',
	    '" . $prezzo_ven1 . "',
	    '" . $data_ultimo_acq . "')";
	    
    if ($DEBUG) { print 'Insert query: <b>' . $query . '</b><br>'; };
    $result = db_execute($conn,$query);

    if (!$result) {
        if ($DEBUG) { print 'file articles_insert_commit error: cannot execute query.\n'; };
        exit;
    };

    // inserisco nei movimenti la creazione dell'articolo
    $query="INSERT INTO movimenti
        (codice_art, descrizione, tipo_movimento, quantita, prezzo, data_movimento)
        VALUES
        ('" . $codice_art . "',
        '',
        'CREAZIONE ARTICOLO',
        " . $quantita . ",
        '" . $prezzo_acq . "',
        '" . $data_ultimo_acq . "')";

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
    <li>&nbsp;Articolo inserito. Adesso potete:<br>
    <ul>
    <li>&nbsp;<a href="articolo_insert.php">Inserire un altro articolo.</a>
    <li>&nbsp;<a href="../magazzino_index.php">Tornare alla gestione magazzino .</a>
    </ul>
    </ul>
    </tr>
    </table>

</body>
</html>
