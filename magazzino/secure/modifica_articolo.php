<? if (file_exists('../../default.php')) { include '../../default.php'; } ?>
<? if (file_exists('../../procedure/utility.php')) { include '../../procedure/utility.php'; } ?>
<? if (file_exists('../../procedure/function_modifica_articolo_full.php'))
 { include '../../procedure/function_modifica_articolo_full.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name ?> - Magazzino</title>
    <link rel="stylesheet" href="../../stylesheet.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<br>
<? print_title('Modifica articolo'); ?>

<?php
// connessione al database
$conn=db_connect($db_host,$db_port,$db_name,$db_user);

//$DEBUG=true;    
if ($DEBUG)
 {
 print '<br> Debug attivo <br>';
 print 'Codice cat. : ' . $codice_cat . '<BR>';
 print 'Codice art. : ' . $codice_art . '<BR>';
 }

// stampo il risultato
$query="SELECT * FROM articoli WHERE codice_cat='" . $codice_cat
 . "' and codice_art='" . $codice_art ."'";
$result = db_execute($conn,$query);

if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };

// leggo in un array il risultato
$arr=pg_fetch_array($result,0);

print '<br>';

$link='modifica_articolo_commit.php?codice_cat=' . $arr['codice_cat']
 . '&codice_art=' . $arr['codice_art'];

if ($DEBUG)
 {
 print '<br> Debug attivo: <br>';
 print '$oid : ' . $oid;
 print '$link : ' . $link;
 print '<br>';
 };
 
modifica_articolo_full ($arr,$link);

db_close ($conn);

print '<br>';
print'<a href="javascript:history.back(1)">Torna</a> allo schermo precedente.';
?>

</body>
</html>
