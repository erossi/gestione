<?php
 if (file_exists("default.php"))
  { include "default.php"; }
 if (file_exists("$default_dir_function/utility.php"))
  { include "$default_dir_function/utility.php"; }
 if (file_exists("$default_dir_function/f_lista_fax.php"))
  { include "$default_dir_function/f_lista_fax.php"; }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name ?></title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>

<?php
//necessaria per la chiamata alla lista_clienti
$page_link="modifica_fax.php";

$title="Elenco Nuovi Fax";

print_title($title);

// connessione al database
$conn=db_connect($db_host,$db_port,$d_dbfax_name,$db_user);

$query="SELECT to_char(data_arrivo,'DD Mon YYYY') as data,
 to_char(ora_arrivo,'HH24:MI:SS') as ora,
 remote_id,pagina,pagine_totali,url
 FROM new_fax order by data_arrivo,ora_arrivo";
$result = db_execute($conn,$query);
    
// conto il numero di linee trovate (count ritorna sempre qualcosa).
$num_rows=pg_numrows($result);

if ($DEBUG) { print 'Total lines found: ' . $num_rows . '<br>'; };

print '<img src="../icone/freccia.png" width="15" height="15" border="0"';
print ' vspace="2" align="absmiddle">';
print 'Fax trovati: ' . $num_rows .'<br>';

if ($num_rows > 0)
 {
 lista_fax($result,$title,$page_link);
 }

// chiudo la connessione
db_close($conn);
?>
</div>
</body>
</html>
