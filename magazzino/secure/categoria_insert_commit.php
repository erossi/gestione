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
<? print_navigation('Inserisci una nuova categoria','Home Page','../contents.php','Magazzino','../magazzino_index.php'); ?>
<? print_title('Inserisci una nuova categoria'); ?>

<?
 
if ($DEBUG)
 {
 print 'Variabili in uso:<BR>';
 print '$codice_cat	: ' . $codice_cat . '<BR>';
 print '$descrizione	: ' . $descrizione . '<BR>';
 }
 
    // imposto la tabella e controllo i valori inseriti
    print '<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">';
    print '<tr>';
    print '    <td align="left" valign="top" width="70%" bgcolor="#e0e0e0">';
    print '    <font face="arial,helvetica,sans-serif" size="2">';
   
    $errori=0;
    if ($codice_cat == '' || $descrizione == '')
     {
     print '<b>Attenzione:</b> 
     Dovete compilare TUTTI i campi.<br>';
     $errori++; }

    $codice_cat=strtoupper($codice_cat);
    $descrizione=strtolower($descrizione);
    
    // termina con un messaggio se ci sono errori
    if ($errori > 0 ) {
        print '     <br>Ci sono <b>' . $errori . '</b> errori. Torna <a href="javascript:history.back(1)">indietro</a> e modifica i campi.';
        print '    </font>';
        print '    </td>';
        print '</tr>';
        print '</table>'; 
        exit;
    }
    
    // connessione al database
    $conn=db_connect($db_host,$db_port,$db_name,$db_user);
    
    // controllo se esiste già la coppia shelf/number
    $query="SELECT count(*) FROM mag_categoria_merce WHERE codice_cat='" . $codice_cat . "'";
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
	db_close($conn);
        exit;
    }
    print '</ul>';
    
    // inserisco l'articolo
    $query="INSERT INTO mag_categoria_merce (codice_cat,descrizione)
	    VALUES 
	    ('" . $codice_cat . "',
	    '" . $descrizione . "')";
	    
    if ($DEBUG) { print 'Insert query: <b>' . $query . '</b><br>'; };
    $result = db_execute($conn,$query);

    if (!$result) {
        if ($DEBUG) { print 'file categoria_insert_commit error: cannot execute query.\n'; };
        exit;
    };

    // chiudo la connessione
    db_close($conn);

?>
    <ul>
    <li>&nbsp;Categoria inserita. Adesso potete:<br>
    <ul>
    <li>&nbsp;<a href="categoria_insert.php">Inserire un altra categoria.</a>
    <li>&nbsp;<a href="../magazzino_index.php">Tornare alla gestione magazzino .</a>
    </ul>
    </ul>
    </tr>
    </table>

</body>
</html>
