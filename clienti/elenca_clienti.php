<?php
 if (file_exists("../default.php"))
  { include "../default.php"; }
 if (file_exists("$default_dir_function/utility.php"))
  { include "$default_dir_function/utility.php"; }
 if (file_exists("$default_dir_function/f_lista_clienti.php"))
  { include "$default_dir_function/f_lista_clienti.php"; }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name ?></title>
    <link rel="stylesheet" href="../stylesheet.css">
</head>
<body>

<?php
//necessaria per la chiamata alla lista_clienti
$page_link="modifica_cliente.php";

$title="Elenco Clienti";

print_title($title);

// connessione al database
$conn=db_connect($db_host,$db_port,$db_name,$db_user);    

$query="SELECT * FROM clienti order by ragsoc";
$result = db_execute($conn,$query);
    
// conto il numero di linee trovate (count ritorna sempre qualcosa).
$num_rows=pg_numrows($result);

if ($DEBUG) { print 'Total lines found: ' . $num_rows . '<br>'; };

print '<img src="../icone/freccia.png" width="15" height="15" border="0"';
print ' vspace="2" align="absmiddle">';
print 'Clienti trovati: ' . $num_rows .'<br>';

if ($num_rows > 0)
 {
 lista_clienti($result,$title,$page_link);
 }

// chiudo la connessione
db_close($conn);
?>
</div>
</body>
</html>
