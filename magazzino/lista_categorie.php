<? if (file_exists('../default.php')) { include '../default.php'; } ?>
<? if (file_exists('../procedure/utility.php')) { include '../procedure/utility.php'; } ?>
<? if (file_exists('../procedure/function_lista_categorie.php'))
 { include '../procedure/function_lista_categorie.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name ?> - Magazzino</title>
    <link rel="stylesheet" href="../stylesheet.css">
</head>
<body text="black" bgcolor="white" link="#ffa000" alink="#ffa000" vlink="#ffa000" leftmargin="
0" topmargin="0">

<?php
 print_title('Elenco delle categorie');

// controllo i parametri
if ($DEBUG) { 
    print 'title(info) is: ' . $title . '(' . $info . ')<br>';
};

// connessione al database
$conn=db_connect($db_host,$db_port,$db_name,$db_user);    

// leggo le categorie
$query="SELECT * FROM categorie order by descrizione";
$result = db_execute($conn,$query);
$numero_righe=pg_numrows($result);
    
print '&nbsp;<img src="../icone/freccia.png" width="15" height="15" border="0" vspace="2"
align="absmiddle">Categorie trovate: ' . $numero_righe .'<br>';

// lista non cliccabile
lista_categorie($result,"Elenco Categorie","0");

// chiudo la connessione
db_close($conn);
?>
</body>
</html>
