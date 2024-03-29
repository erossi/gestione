<? if (file_exists('../default.php')) { include '../default.php'; } ?>
<? if (file_exists('../procedure/utility.php')) { include '../procedure/utility.php'; } ?>
<? if (file_exists('../procedure/function_lista_articolo_link.php'))
 { include '../procedure/function_lista_articolo_link.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name ?></title>
    <link rel="stylesheet" href="../stylesheet.css">
</head>
<body>

<?php

$title="Articoli in Magazzino";
print_title($title);

// connessione al database
$conn=db_connect($db_host,$db_port,$db_name,$db_user);    

// leggo gli articoli
$query="SELECT count(*) FROM articoli";
$result = db_execute($conn,$query);
    
// conto il numero di linee trovate (count ritorna sempre qualcosa).
$arr=pg_fetch_array ($result,0);
$num_rows=$arr[0];
if ($DEBUG) { print 'Total lines found: ' . $num_rows . '<br>'; };

print '&nbsp;<img src="../icone/freccia.png" width="15" height="15" border="0" vspace="2"
align="absmiddle">Articoli nel listino: ' . $num_rows .'<br>';

// se non ci sono articoli esci!!
if ($num_rows == 0)
 {
 print '&nbsp;<img src="../icone/freccia.png" width="15" height="15" border="0" vspace=
 "2" align="absmiddle"> non ci sono articoli in listino<br>';
 db_close($conn);
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
 print '&nbsp;<img src="../icone/freccia.png" width="15" height="15"
 border="0" vspace="2" align="absmiddle"> Non ci sono categorie.<br>';
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

  lista_articolo_link($result,$title,1);

  } // fine loop articoli per categoria
 } // fine loop categorie


// -------------------------------------------------
// elenco gli orfani
// -------------------------------------------------

// ricerco gli orfani
$query="SELECT * FROM articoli WHERE codice_cat NOT IN (SELECT codice_cat FROM categorie)
OR codice_cat=NULL";

// eseguo la query
$result = db_execute ($conn, $query);

lista_articolo_link($result,"Articoli non presenti in nessuna categoria",1);

// chiudo la connessione
db_close($conn);
?>
</div>
</body>
</html>
