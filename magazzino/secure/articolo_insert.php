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
<? print_navigation('Inserisci articolo','Home Page','../contents.php','Magazzino','../magazzino_index.php'); ?>
<? print_title('Inserisci articolo'); ?>

<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">
<tr>
    <td align="left" valign="top" width="70%" bgcolor="#e0e0e0">
        <font face="arial,helvetica,sans-serif" size="2">
        Please inserisci i dati e premi <b>Inserimento</b><br>
        <form action="articolo_insert_commit.php">
        <table cellspacing="1" cellpadding="3" border="0">
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Codice</font></td>
            <td align="left"  valign="middle"><input type="text" name="codice_art" maxlenght="10" size="10" align="absmiddle"></td>
        </tr>
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Descrizione</font></td>
            <td align="left"  valign="middle"><input type="text" name="descrizione" maxlenght="30" size="30" align="left"></td>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Descrizione 2</font></td>
            <td align="left"  valign="middle"><input type="text" name="descrizione2" maxlenght="30" size="30" align="absmiddle"></td>
        </tr>
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Prezzo di Acquisto</font></td>
            <td align="left"  valign="middle"><input type="text" name="prezzo_acq" maxlenght="15" size="15" align="absmiddle"></td>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Prezzo di Vendita</font></td>
            <td align="left"  valign="middle"><input type="text" name="prezzo_ven" maxlenght="15" size="15" align="absmiddle"></td>
        </tr>
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Data di acquisto</font></td>
            <td align="left"  valign="middle"><input type="text" name="data_ultimo_acq" size="20" align="absmiddle"></td>
        </tr>

        <tr>
            <td>&nbsp</td>
            <td><input type="submit" name="submit" value="Insert">&nbsp;<input type="reset" name="reset" value="Reset values"></td>
        </tr>
        </table>
        </form>
        </font>
    </td>
</tr>
</table>

</font>

</body>
</html>