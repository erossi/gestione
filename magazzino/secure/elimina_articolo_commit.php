<? if (file_exists('../../default.php')) { include '../../default.php'; } ?>
<? if (file_exists('../../procedure/utility.php')) { include '../../procedure/utility.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title><? print $prog_name ?> - Magazzino</title>
<link rel="stylesheet" href="../../stylesheet.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<? print_title('Esegui eliminazione articolo'); ?>

<?
// Un po' di debugging
//$DEBUG=true;
if ($DEBUG)
 {
 print 'Variabili in uso:<BR>';
 print '$codice_cat	: ' . $codice_cat . '<BR>';
 print '$codice_art	: ' . $codice_art . '<BR>';
 };

// controllo i valori inseriti
if ($codice_art == '' || $codice_cat == '')
 {
 print '<b>Attenzione:</b> 
 Mancano i campi codice articolo, codice_cat, quantita.<br>';
 exit;
 };

// connessione al database
$conn=db_connect($db_host,$db_port,$db_name,$db_user);

// cancello l'articolo
$query="DELETE FROM articoli WHERE codice_art='"
 . $codice_art . "' and codice_cat='" . $codice_cat . "'";

$result = pg_exec ($conn,$query);

if ($debug) { print 'query: <b>' . $query . '</b><br>'; };

$query="DELETE FROM movimenti WHERE codice_art='"
 . $codice_art . "' and codice_cat='" . $codice_cat . "'";
$result = pg_exec ($conn,$query);

if ($debug) { print 'query: <b>' . $query . '</b><br>'; };

// chiudo la connessione
db_close($conn);

?>

<ul>
<li>&nbsp;Articolo Eliminato. Adesso potete:<br>
<ul>
<li>&nbsp;<a href="../articoli_list.php">Tornare alla lista degli articoli.</a>
<li>&nbsp;<a href="../articolo_index.php">Tornare all indice di Magazzino.</a>
</ul>
</ul>

</body>
</html>
