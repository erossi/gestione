<? if (file_exists('../../default.php')) { include '../../default.php'; } ?>
<? if (file_exists('../../procedure/utility.php')) { include '../../procedure/utility.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name ?> - Books</title>
    <link rel="stylesheet" href="../../stylesheet.css">
</head>

<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<font face="arial,helvetica,sans-serif" size="2">

<? print_top($prog_name); ?>
<? print_navigation('Inserisci categoria','Home Page','../contents.php','Magazzino','../magazzino_index.php'); ?>
<? print_title('Inserisci categoria articoli');

    // order by...
    switch ($order) {
        case "c": $order_clause=" ORDER BY codice_cat"; break;
        case "d":
	default: $order_clause=" ORDER BY descrizione";
        }

// connessione al database
$conn=db_connect($db_host,$db_port,$db_name,$db_user);

// stampo il risultato
$query="SELECT * FROM mag_categoria_merce " . $order_clause;
$result = db_execute($conn,$query);
if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };

if (!$result) {
if ($DEBUG) { print 'file lista_magazzino error: cannot execute query.\n'; };
 exit;
 };

// quante righe devo stampare?
$num_rows=pg_numrows($result);

if ($DEBUG)
 { print 'Numbers of rows in table: <b>' . $num_rows . '</b><br>';
 print 'Query: ' . $query . '<BR>';
 };

?>
<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">
<tr>
    <td align="left" valign="top" width="40%" bgcolor="#e0e0e0">
        <font face="arial,helvetica,sans-serif" size="2">
        Please inserisci i dati e premi <b>Inserimento</b><br>
        <form action="categoria_insert_commit.php">
        <table cellspacing="1" cellpadding="3" border="0">
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Codice</font></td>
            <td align="left"  valign="middle"><input type="text" name="codice_cat" maxlenght="3" size="3" align="absmiddle"></td>
        </tr>
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Descrizione</font></td>
            <td align="left"  valign="middle"><input type="text" name="descrizione" maxlenght="30" size="30" align="left"></td>
	        </tr>

        <tr>
            <td>&nbsp</td>
            <td><input type="submit" name="submit" value="OK">&nbsp;<input type="reset" name="reset" value="Cancella"></td>
        </tr>
        </table>
        </form>
        </font>
    </td>

 <td align="left" valign="top" width="60%" bgcolor="green">
  <font face="arial,helvetica,sans-serif" size="2">
  <bl>Elenco categorie attive</bl>
<?
// legenda
print '&nbsp;<img src="../../icone/ico_edit.gif" width="20" height="15" border="0" align="absmiddle"> = Modifica&nbsp;';
print '&nbsp;<img src="../../icone/ico_delete.gif" width="17" height="15" border="0" align="absmiddle"> = Cancella&nbsp;';

print '<br><br><div align="center">';
print '<table cellspacing="1" cellpadding="3" border="0" width="90%">';
print '<tr bgcolor="#336699">';
print '<td width="10%">
<font face="arial,helvetica,sans-serif" size="2" style="color:white">
<a href="categoria_insert.php?&order=c" style="color:white">
Cod.</font></td>';

print '<td width="80%">
<font face="arial,helvetica,sans-serif" size="2" style="color: white">
<a href="categoria_insert.php?&order=d" style="color:white">
Descrizione</font></td>';

print '<td width="10%" colspan="2"><font face="arial,helvetica,sans-serif"
       size="2" style="color: white">Oper.</font></td>';

print '</tr>';

for ($count=0; $count<$num_rows; $count++)
{
$arr=pg_fetch_array ($result,$count);
if (($count % 2) == 0) {
print '<tr bgcolor=' . $color_list_even . '>';
} else {
print '<tr bgcolor=' . $color_list_odd . '>';
};

            // first column
            print '<td valign="top"';
            print '    <font face="arial,helvetica,sans-serif" size="2">';
            print $arr['codice_cat'] . '<br>';
            if ($DEBUG) { print '<i>' . $arr['oid'] . '</i>'; }
            print '    </font>';
            print '</td>';

            // second column
            print '<td valign="top"';
            print '    <font face="arial,helvetica,sans-serif" size="2">';
            print '    <i>' . $arr['descrizione'] . '</i>';
            print '    </font>';
            print '</td>';

	    // 3th column
            print '<td valign="top" bgcolor="#ffc1c1">';
            print '<a href="categoria_modify.php?codice_cat=' . $arr['codice_cat'] . '"><img src="../../icone/ico_edit.gif" width="20" height="15" border="0" alt="Modifica"></a>';
            print '<a href="categoria_delete.php?codice_cat=' . $arr['codice_cat'] . '"><img src="../../icone/ico_delete.gif" width="17" height="15" border="0" alt="Cancella"></a>';
            print '</td>';

            print '</tr>';
        };

        print '</table>';
    // chiudo la connessione
    db_close($conn);

?>

 </td>

</tr>
</table>

</font>

</body>
</html>