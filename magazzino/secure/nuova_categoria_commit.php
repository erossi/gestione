<? if (file_exists('../../default.php'))
 { include '../../default.php'; } ?>
<? if (file_exists('../../procedure/utility.php'))
 { include '../../procedure/utility.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
    <link rel="stylesheet" href="../../stylesheet.css">
</head>
<body>

<? print_title('Esegui inserimento nuova categoria'); ?>

<?

// Un po' di debugging
//$DEBUG=true;
if ($DEBUG)
 {
 print 'Variabili in uso:<BR>';
 print '$codice_cat	: ' . $codice_cat . '<BR>';
 print '$descrizione	: ' . $descrizione . '<BR>';
 };
 
// controllo i valori inseriti

if ($codice_cat == '' || $descrizione == '')
 {
 print '<b>Attenzione:</b> 
 Dovete compilare almeno i campi !!<br>';
 print ' <a href="javascript:history.back(1)">back</a> and modify insert string.';
 exit;
 }

$codice_cat=strtoupper($codice_cat);
$descrizione=strtolower($descrizione);

// connessione al database
$conn=db_connect($db_host,$db_port,$db_name,$db_user);

$query="SELECT count(*) FROM categorie WHERE codice_cat='"
 . $codice_cat . "' or descrizione='" . $descrizione . "'";

if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };

$result = db_execute($conn,$query);
// count ritorna sempre una riga
$arr=pg_fetch_array($result,0);

if ($DEBUG) { print 'Array 0 is: ' . $arr[0]; }

if ($arr[0] > 0)
 {
 print '<b>Attenzione:</b> La combinazione :<br>';
 print 'codice categoria :' . $codice_cat . '<br>';
 print 'descrizione :' . $descrizione . '<br>';
 print 'esiste gia, premi back per cambiare i valori inseriti';
 db_close ($conn);
 exit;
 }

$query="INSERT INTO categorie(codice_cat,descrizione)
 VALUES 
 ('" . $codice_cat . "',
 '" . $descrizione . "')";

if ($DEBUG) { print 'Insert query: <b>' . $query . '</b><br>'; };
$result = db_execute($conn,$query);

// chiudo la connessione
db_close($conn);

?>

<ul>
<li>&nbsp;Categoria caricata.<br>
</ul>
</body>
</html>
