<? if (file_exists('../../default.php'))
 { include '../../default.php'; } ?>
<? if (file_exists('../../procedure/utility.php'))
 { include '../../procedure/utility.php'; } ?>
<? if (file_exists('../../procedure/function_aggiusta_prezzi.php'))
 { include '../../procedure/function_aggiusta_prezzi.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
    <link rel="stylesheet" href="../../stylesheet.css">
</head>
<body>

<? print_title('Esegui inserimento nuovo articolo'); ?>

<?

// aggiusto i prezzi di vendita
aggiusta_prezzi ($prezzo_acq,$prezzo_ven1,$prezzo_ven2,
 $prezzo_ven3,$prezzo_ven4);

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
 };
 
// controllo i valori inseriti

if ($codice_art == '' || $codice_cat == '')
 {
 print '<b>Attenzione:</b> 
 Dovete compilare almeno i campi codice articolo, codice_cat.<br>';
 print ' <a href="javascript:history.back(1)">back</a> and modify insert string.';
 exit;
 }

$codice_art=strtoupper($codice_art);
$descrizione=strtolower($descrizione);
$descrizione2=strtolower($descrizione2);

if ($data == '') {$data='now';}

// connessione al database
$conn=db_connect($db_host,$db_port,$db_name,$db_user);

$query="SELECT count(*) FROM articoli WHERE codice_art='"
 . $codice_art . "'";

if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };

$result = db_execute($conn,$query);
// count ritorna sempre una riga
$arr=pg_fetch_array($result,0);

if ($DEBUG) { print 'Array 0 is: ' . $arr[0]; }

if ($arr[0] > 0)
 {
 print '<b>Attenzione:</b> La combinazione :<br>';
 print 'codice categoria :' . $codice_cat . '<br>';
 print 'codice articolo :' . $codice_art . '<br>';
 print 'esiste gia, premi back per cambiare i valori inseriti';
 db_close ($conn);
 exit;
 }

$query="INSERT INTO articoli(codice_cat,codice_art,descrizione,descrizione2,
 quantita,prezzo_acq,prezzo_ven1,prezzo_ven2,prezzo_ven3,
 prezzo_ven4,data_ultimo_acq,info)
 VALUES 
 ('" . $codice_cat . "',
 '" . $codice_art . "',
 '" . $descrizione . "',
 '" . $descrizione2 . "',
 0,
 " . $prezzo_acq . ",
 " . $prezzo_ven1 . ",
 " . $prezzo_ven2 . ",
 " . $prezzo_ven3 . ",
 " . $prezzo_ven4 . ",
 '" . $data . "',
 '" . $info . "')";

if ($DEBUG) { print 'Insert query: <b>' . $query . '</b><br>'; };
$result = db_execute($conn,$query);

$query="INSERT INTO movimenti
 (codice_cat, codice_art, tipo_movimento, prezzo, data_movimento)
 VALUES
 ('" . $codice_cat . "',
 '" . $codice_art . "',
 'creazione articolo',
 " . $prezzo_acq . ",
 'now')";

if ($DEBUG) { print 'Insert query: <b>' . $query . '</b><br>'; };
$result = db_execute($conn,$query);

// chiudo la connessione
db_close($conn);

?>

<ul>
<li>&nbsp;Articolo caricato. Adesso potete:<br>
<ul>
<li>&nbsp;<a href="../articoli_list.php">Tornare alla lista degli articoli.</a>
<li>&nbsp;<a href="../articolo_index.php">Tornare all indice di Magazzino.</a>
</ul>
</ul>
</body>
</html>
