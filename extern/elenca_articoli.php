<? if (file_exists('../procedure/auth.php'))
 { include '../procedure/auth.php'; } ?>
<? if (file_exists('../default.php'))
 { include '../default.php'; } ?>
<? if (file_exists('../procedure/utility.php'))
 { include '../procedure/utility.php'; } ?>
<? if (file_exists('../procedure/function_lista_articolo_switch.php'))
 { include '../procedure/function_lista_articolo_switch.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name ?></title>
    <link rel="stylesheet" href="../stylesheet.css">
</head>
<body>

<? print_title('Articoli in Magazzino'); ?>

<?
//$DEBUG=1;

// connessione al database
$conn=db_connect($db_host,$db_port,$db_name,$db_user);    

// leggo gli articoli
$query="SELECT count(*) FROM articoli";
$result = db_execute($conn,$query);
    
// conto il numero di linee trovate (count ritorna sempre qualcosa).
$arr=pg_fetch_array ($result,0);
$numero_articoli=$arr[0];

if ($DEBUG) { print 'DEBUG articoli: ' . $numero_articoli . '<br>'; };

// leggo il listino da usare
$query="select listino from clienti where codice='" . $gestione04_pw . "'";
$result = db_execute($conn,$query);
$arr = pg_fetch_array ($result,0);
$listino = $arr[0];

if ($DEBUG)
 {
 print '<br>DEBUG query: ' . $query . '<br>';
 print '<BR>DEBUG listino: ' . $listino . '<br>';
 };

print '&nbsp;<img src="../icone/freccia.png" width="15" height="15"';
print ' border="0" vspace="2"';
print ' align="absmiddle">Articoli nel listino: ' . $numero_articoli .'<br>';

// se non ci sono articoli esci!!
if ($numero_articoli == 0)
 {
 print '&nbsp;<img src="../icone/freccia.png" width="15" height="15" border="0" vspace=
"2" align="absmiddle"> non ci sono articoli in listino<br>';
 exit;
 }

// -------------------------------------------------
// elenco gli articoli per categoria
// -------------------------------------------------

// imposto la query
$query="SELECT * FROM categorie";
$result_categorie = db_execute($conn, $query);

// leggo il risultato e il numero di righe
$numero_righe=pg_numrows($result_categorie);

// controllo se c'e` almeno una categoria
if ($numero_righe == 0)
 {
 print '&nbsp;<img src="../icone/freccia.png" width="15"';
 print ' height="15" border="0" vspace="2" align="absmiddle">';
 print ' Non ci sono categorie.<br>';
 }
else
 {
 for ($indice=0; $indice<$numero_righe; $indice++)
  {
  $categoria = pg_fetch_array ($result_categorie, $indice);

// reimposto la query
  $query="SELECT * FROM articoli WHERE
  codice_cat='" . $categoria["codice_cat"] ."' ORDER BY descrizione";
// eseguo la query
  $result = db_execute ($conn, $query);
  $title = $categoria['codice_cat'] . ' - ' . $categoria['descrizione'];

  lista_articolo($result,$title,$listino);

 } // fine loop articoli per categoria
} // fine loop categorie


// -------------------------------------------------
// elenco gli orfani
// -------------------------------------------------

// ricerco gli orfani
$query="SELECT * FROM articoli WHERE codice_cat NOT IN 
(SELECT codice_cat FROM categorie) OR codice_cat=NULL";

// eseguo la query
$result = db_execute ($conn, $query);

$title="Articoli non presenti in nessuna categoria";
lista_articolo($result,$title,$listino);

// chiudo la connessione
db_close($conn);

?>
</div>
</body>
</html>
