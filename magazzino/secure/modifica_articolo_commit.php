<? if (file_exists('../../default.php')) { include '../../default.php'; } ?>
<? if (file_exists('../../procedure/utility.php')) { include '../../procedure/utility.php'; } ?>
<? if (file_exists('../../procedure/function_aggiusta_prezzi.php'))
 { include '../../procedure/function_aggiusta_prezzi.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<META HTTP-EQUIV="REFRESH" CONTENT="1; URL=../articoli_list.php">

<html>
<head>
    <title><? print $prog_name ?> - Magazzino</title>
    <link rel="stylesheet" href="../../stylesheet.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<? print_title('Esegui modifica articolo'); ?>

<?
// aggiusto i prezzi
aggiusta_prezzi($prezzo_acq,$prezzo_ven1,$prezzo_ven2,
 $prezzo_ven3,$prezzo_ven4);

// Un po' di debugging
// $DEBUG=true;
if ($DEBUG)
 {
 print 'Variabili in uso:<BR>';
 print '$oid		: ' . $oid . '<BR>';
 print '$codice_cat	: ' . $codice_cat . '<BR>';
 print '$codice_art	: ' . $codice_art . '<BR>';
 print '$descrizione	: ' . $descrizione . '<BR>';
 print '$descrizione2	: ' . $descrizione2 . '<BR>';
 print '$quantita	: ' . $quantita . '<BR>';
 print '$prezzo_acq	: ' . $prezzo_acq . '<BR>';
 print '$prezzo_ven1	: ' . $prezzo_ven1 . '<BR>';
 print '$prezzo_ven2	: ' . $prezzo_ven2 . '<BR>';
 print '$prezzo_ven3	: ' . $prezzo_ven3 . '<BR>';
 print '$prezzo_ven4	: ' . $prezzo_ven4 . '<BR>';
 print '$data_ultimo_acq: ' . $data_ultimo_acq . '<BR>';
 print '$info		: ' . $info . '<br>';
 };
 
// imposto la tabella e controllo i valori inseriti
   
$errori=0;
if ($descrizione == '' || $quantita == '')
 {
 print '<b>Attenzione:</b> 
 Dovete compilare almeno i campi codice, descrizione, quantita.<br>';
 $errori++; }

//    $codice_art=strtoupper($codice_art);
$descrizione=strtolower($descrizione);
$descrizione2=strtolower($descrizione2);
    
if ($data_ultimo_acq == '') {$data_ultimo_acq='now';}

// termina con un messaggio se ci sono errori
if ($errori > 0 )
 {
 print '<br>Ci sono <b>' . $errori . '</b> errori. Please go 
  <a href="javascript:history.back(1)">back</a> and modify insert string.';
 exit;
 }
    
// connessione al database
$conn=db_connect($db_host,$db_port,$db_name,$db_user);
    
// leggo gli articoli
    
$query="UPDATE articoli SET
    descrizione='" . $descrizione . "',
    descrizione2='" . $descrizione2 . "',
    quantita=" . $quantita . ",
    prezzo_acq='" . $prezzo_acq . "',
    prezzo_ven1='" . $prezzo_ven1 . "',
    prezzo_ven2='" . $prezzo_ven2 . "',
    prezzo_ven3='" . $prezzo_ven3 . "',
    prezzo_ven4='" . $prezzo_ven4 . "',
    data_ultimo_acq='" . $data_ultimo_acq . "',
    info='" . $info . "' WHERE codice_cat='" . $codice_cat
    . "' and codice_art='" . $codice_art . "'";

if ($DEBUG) { print 'Insert query: <b>' . $query . '</b><br>'; };
$result = db_execute($conn,$query);

// chiudo la connessione
db_close($conn);

?>
<ul>
<li>&nbsp;Articolo modificato. Attendere prego...:<br>
</ul>

</body>
</html>
