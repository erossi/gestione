<? if (file_exists('../../default.php')) { include '../../default.php'; } ?>
<? if (file_exists('../../procedure/utility.php')) { include '../../procedure/utility.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
    <title><? print $prog_name ?> - Magazzino</title>
    <link rel="stylesheet" href="../../stylesheet.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<? print_title('Esegui scarico articolo'); ?>

<?

// Un po' di debugging
//$DEBUG=true;
if ($DEBUG)
 {
 print 'Variabili in uso:<BR>';
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
 print '$data		: ' . $data . '<BR>';
 print '$info		: ' . $info . '<br>';
 print '$note		: ' . $note . '<br>';
 };
 
// controllo i valori inseriti
$errori=0;
$quantita_scarico=$quantita;
if ($codice_art == '' || $quantita_scarico == '' || $codice_cat == '')
     {
     print '<b>Attenzione:</b> 
     Dovete compilare almeno i campi codice articolo, codice_cat, quantita.<br>';
     $errori++; }

if ($data == '') {$data='now';}

// termina con un messaggio se ci sono errori
if ($errori > 0 )
 {
 print '<br>Ci sono <b>' . $errori . '</b> errori. Please go 
  <a href="javascript:history.back(1)">back</a> and modify insert string.';
 exit;
 }
    
// connessione al database
$conn=db_connect($db_host,$db_port,$db_name,$db_user);

// leggo l'attuale disponibilita dell' articolo
$query="SELECT quantita FROM articoli WHERE codice_art='"
 . $codice_art ."' and codice_cat='" . $codice_cat . "'";
$result = db_execute($conn,$query);

if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };

// leggo in un array il risultato
$arr=pg_fetch_array($result,0);
$quantita = $arr['quantita'] - $quantita_scarico;
    
print '<BR>Quantita attuale : <b>' . $arr['quantita'] . '</b><br>';
print 'Quantita scarico  : <b>' . $quantita_scarico . '</b><br>';
print 'Quantita totale  : <b>' . $quantita . '</b><br>';

// leggo gli articoli
    
$query="UPDATE articoli SET quantita="
 . $quantita . " WHERE codice_cat='" . $codice_cat
 . "' and codice_art='" . $codice_art . "'";

if ($DEBUG) { print 'Insert query: <b>' . $query . '</b><br>'; };
$result = db_execute($conn,$query);

if ($prezzo_ven == '') { $prezzo_ven = 'NULL'; };

$query="INSERT INTO movimenti
 (codice_cat, codice_art, descrizione,
  tipo_movimento, quantita, prezzo, data_movimento)
 VALUES
 ('" . $codice_cat . "',
 '" . $codice_art . "',
 '" . $note . "',
 'scarico di magazzino',
 " . $quantita_scarico . ",
 " . $prezzo_ven . ",
 'now')";

if ($DEBUG) { print 'Insert query: <b>' . $query . '</b><br>'; };
$result = db_execute($conn,$query);

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

</body>
</html>
