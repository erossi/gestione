<? if (file_exists('../../default.php'))
 { include '../../default.php'; } ?>

<? if (file_exists('../../procedure/utility.php'))
 { include '../../procedure/utility.php'; } ?>

<? if (file_exists('../../procedure/function_stampa_articolo.php'))
 { include '../../procedure/function_stampa_articolo.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name ?> - Magazzino</title>
    <link rel="stylesheet" href="../../stylesheet.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<? print_title('Informazioni Articolo'); ?>

<br>

<?
// connessione al database
$conn=db_connect($db_host,$db_port,$db_name,$db_user);

// stampo il risultato
$query="SELECT * FROM articoli WHERE codice_cat='" . $codice_cat
 . "'and codice_art='" . $codice_art . "'";
$result = db_execute($conn,$query);

if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };

// leggo in un array il risultato
$arr=pg_fetch_array($result,0);

// stampo le info sull'articolo
stampa_articolo($arr);
						     
print '<table>';
print '<tr>';
    
print '<td><form action="carica_articolo.php">';
print '<input type="hidden" name="codice_cat" value="' . $codice_cat . '">';
print '<input type="hidden" name="codice_art" value="' . $codice_art . '">';
print '<input type="submit" value="Aggiungi">';
print '</form></td>';

print '<td><form action="scarica_articolo.php">';
print '<input type="hidden" name="codice_cat" value="' . $codice_cat . '">';
print '<input type="hidden" name="codice_art" value="' . $codice_art . '">';
print '<input type="submit" value="Sottrai">';
print '</form></td>';

print '<td><form action="storico_articolo.php">';
print '<input type="hidden" name="codice_cat" value="' . $codice_cat . '">';
print '<input type="hidden" name="codice_art" value="' . $codice_art . '">';
print '<input type="submit" value="Storico">';
print '</form></td>';
    
print '<td><form action="modifica_articolo.php">';
print '<input type="hidden" name="codice_cat" value="' . $codice_cat . '">';
print '<input type="hidden" name="codice_art" value="' . $codice_art . '">';
print '<input type="submit" value="Modifica">';
print '</form></td>';

print '<td><form action="elimina_articolo.php">';
print '<input type="hidden" name="codice_cat" value="' . $codice_cat . '">';
print '<input type="hidden" name="codice_art" value="' . $codice_art . '">';
print '<input type="submit" value="Elimina">';
print '</form></td>';

print '</tr>';
print '</table>';
print '<br>';
    
// chiudo la connessione
pg_close ($conn);
?>

</body>
</html>