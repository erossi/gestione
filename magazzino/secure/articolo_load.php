<? if (file_exists('../../default.php')) { include '../../default.php'; } ?>
<? if (file_exists('../../procedure/utility.php')) { include '../../procedure/utility.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name ?> - Magazzino</title>
    <link rel="stylesheet" href="../../stylesheet.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<font face="arial,helvetica,sans-serif" size="2">

<? print_top($prog_name); ?>
<? print_navigation('Carica articolo','Home Page','../contents.php','Magazzino','../magazzino_index.php'); ?>
<? print_title('Carica articolo'); ?>

<?php
    // connessione al database
    $conn=db_connect($db_host,$db_port,$db_name,$db_user);
    
    if ($DEBUG)
     {
     print 'Codice art. : ' . $codice_art . '<BR>';
     }

    // stampo il risultato
    $query="SELECT * FROM magazzino WHERE codice_art='" . $codice_art ."'";
    $result = db_execute($conn,$query);

    if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };

    if (!$result) {
        print 'file articolo_load error: cannot execute query.\n';
        exit;
    };

    // leggo in un array il risultato
    $arr=pg_fetch_array($result,0);

print'<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">';
print'<tr>';
print'<td align="left" valign="top" width="70%" bgcolor="#e0e0e0">';
print'<font face="arial,helvetica,sans-serif" size="2">';
print'Please modifica i dati e premi <b>Carica</b><br>';
print'<form method="post" action="articolo_load_commit.php?codice_art=' . $codice_art . '">';

print'<table cellspacing="1" cellpadding="3" border="0">';
    print '    <tr>';
    print '<td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2">Codice</font></td>';
    print '<td align="left"  valign="middle">' . $arr['codice_art'] . '</td>';
    print '</tr>';

    print '<tr>';
    print '<td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2">Descrizione</font></td>';
    print '<td align="left"  valign="middle">' . $arr['descrizione'] . '</td>';
    print '<td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2">Descrizione 2</font></td>';
    print '<td align="left"  valign="middle">' . $arr['descrizione2'] . '</td>';
    print '    </tr>';

    print '    <tr>';
    print '        <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2">Quantita</font></td>';
    print '        <td align="left"  valign="middle"><input type="text" name="quantita_carico" size="5" align="absmiddle"></td>';
    print '        <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2">Note</font></td>';
    print '        <td align="left"  valign="middle"><input type="text" name="note" size="30" align="absmiddle""></td>';
    print '    </tr>';

    print '    <tr>';
    print '        <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2">Prezzo di Acquisto</font></td>';
    print '        <td align="left"  valign="middle"><input type="text" name="prezzo_acq" size="15" align="absmiddle" value="' . $arr['prezzo_acq'] . '"></td>';
    print '        <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2">Prezzo di Vendita</font></td>';
    print '        <td align="left"  valign="middle"><input type="text" name="prezzo_ven1" size="15" align="absmiddle" value="' . $arr['prezzo_ven1'] . '"></td>';
    print '    </tr>';

    print '    <tr>';
    print '        <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2">Data di acquisto</font></td>';
    print '        <td align="left"  valign="middle"><input type="text" name="data_ultimo_acq" size="20" align="absmiddle"></td>';
    print '    </tr>';

    print '    <tr>';
    print '        <td>&nbsp</td>';
    print '        <td><input type="submit" name="submit" value="Carica">&nbsp;<input type="reset" name="reset" value="Annulla"></td>';
    print '    </tr>';

print'        </table>';
print'        </form>';
print'        <a href="javascript:history.back(1)">Torna</a> allo schermo precedente.';
print'        </font>';
print'    </td>';


print'</tr>';
print'</table>';

?>

</font>

</body>
</html>
