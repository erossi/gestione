<? if (file_exists('../default.php')) { include '../default.php'; } ?>
<? if (file_exists('../procedure/utility.php')) { include '../procedure/utility.php'; } ?>
<? if (file_exists('../procedure/function_lista_clienti_switch.php'))
 { include '../procedure/function_lista_clienti_switch.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name ?></title>
    <link rel="stylesheet" href="../stylesheet.css">
</head>
<body>

<?php
$title="Elenco Clienti in attesa di abilitazione";

print_title($title);

// connessione al database
$conn=db_connect($db_host,$db_port,$db_name,$db_user);    

$query="SELECT * FROM clienti where status='r' order by ragsoc";
$result = db_execute($conn,$query);
    
// conto il numero di linee trovate (count ritorna sempre qualcosa).
$num_rows=pg_numrows($result);

if ($DEBUG) { print 'Total lines found: ' . $num_rows . '<br>'; };

print '<img src="../icone/freccia.png" width="15" height="15" border="0"';
print ' vspace="2" align="absmiddle">';
print 'Clienti trovati: ' . $num_rows .'<br>';

// se non ci sono elementi esci!!
if ($num_rows > 0)
 {
 lista_clienti($result,$title);
 }

// chiudo la connessione
db_close($conn);
?>
</div>
</body>
</html>
