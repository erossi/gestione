<? if (file_exists('../default.php')) { include '../default.php'; } ?>
<? if (file_exists('../procedure/utility.php')) { include '../procedure/utility.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<link rel="stylesheet" href="../../stylesheet.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<? print_title('Esegui eliminazione cliente'); ?>

<?
// Un po' di debugging
$DEBUG=true;
if ($DEBUG)
 {
 print 'Variabili in uso:<BR>';
 print '$codice	: ' . $codice . '<BR>';
 };

// controllo i valori inseriti
if ($codice == '')
 {
 print '<b>Attenzione:</b> Errore di Codice!!!<br>';
 exit;
 };

// connessione al database
$conn=db_connect($db_host,$db_port,$db_name,$db_user);

// cancello l'articolo
$query="DELETE FROM clienti WHERE codice='" . $codice . "'";

// Un po' di debugging
if ($DEBUG)
 {
 print 'Variabili in uso:<BR>';
 print '$query : ' . $query . '<BR>';
 };

$result = pg_exec ($conn,$query);

// chiudo la connessione
db_close($conn);

?>

<ul>
<li>&nbsp;Cliente correttamente Eliminato.<br>
</ul>

</body>
</html>
