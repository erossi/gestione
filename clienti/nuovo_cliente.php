<? if (file_exists('../default.php'))
 { include '../default.php'; } ?>
<? if (file_exists('../procedure/utility.php'))
 { include '../procedure/utility.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name ?></title>
    <link rel="stylesheet" href="../stylesheet.css">
</head>
<body>

<? print_title('Modulo di registrazione cliente'); ?>

<br>
<div align="justify">
La registrazione non &egrave; automatica: la Vostra richiesta
verr&agrave; vagliata da un nostro incaricato che Vi risponder&agrave;
all'indirizzo e-mail da Voi indicato.
</DIV>

<FORM ACTION="nuovo_cliente_commit.php" METHOD="POST">
<TABLE WIDTH="90%" CELLPADDING="1" CELLSPACING="3" BORDER="0">
<TR>
 <TD BGCOLOR="Orange">
 Informazioni societ&agrave; (obbligatorie)
 </TD>
</TR>

<TR>
 <TD ALIGN="LEFT">
Ragione sociale:
<INPUT TYPE="TEXT" SIZE="25" NAME="rag_soc"></INPUT>
Partita IVA:
<INPUT TYPE="TEXT" SIZE="25" NAME="part_iva"></INPUT>
</TD>
</TR>

<TR>
 <TD ALIGN="LEFT">
Responsabile commerciale:
<INPUT TYPE="TEXT" SIZE="25" NAME="resp_nome"></INPUT>
E-Mail:
<INPUT TYPE="TEXT" SIZE="25" NAME="resp_mail"></INPUT>
</TD>
</TR>
</table>

<TABLE WIDTH="90%" CELLPADDING="1" CELLSPACING="3" BORDER="0">
<TR>
<td BGCOLOR="red">
Informazioni di accesso
</td>
</TR>

<tr>
<td>
Listino:
<select name="listino" size="1">
 <option value="1">1</option>
 <option value="2">2</option>
 <option value="3">3</option>
 <option value="4">4</option>
</select>
Accesso Web:
<select name="status" size="1">
 <option value="a">attivo</option>
 <option value="r">attesa</option>
 <option value="n">vietato</option>
</select>
Email automatica:
<select name="email_listino" size="1">
 <option value="f">N</option>
 <option value="t">S</option>
</select>
Password:

<?php
$password_gen=exec($password_generator_command);

print '<input type="text" size="10" name="password" value="';
print $password_gen . '">';
print '</input>';
?>

</td>
</tr>
</table>

<TABLE WIDTH="90%" CELLPADDING="1" CELLSPACING="3" BORDER="0">
<TR>
<td BGCOLOR="Orange">
Indirizzo sede
</td>
</TR>

<TR>
<td>
Indirizzo.
<INPUT TYPE="TEXT" SIZE="30" NAME="sede_indirizzo"></INPUT>
N.
<INPUT TYPE="TEXT" SIZE="4" NAME="sede_civico"></INPUT>
Tel.
 <INPUT TYPE="TEXT" SIZE="10" NAME="sede_tel"></INPUT>Fax.
 <INPUT TYPE="TEXT" SIZE="10" NAME="sede_fax"></INPUT>
</td>
</TR>

<TR>
<td>
Citt&aacute;:
 <INPUT TYPE="TEXT" SIZE="25" NAME="sede_citta"></INPUT>
 Prov.
 <INPUT TYPE="TEXT" SIZE="2" NAME="sede_prov"></INPUT>
CAP.
 <INPUT TYPE="TEXT" SIZE="5" NAME="sede_cap"></INPUT>
Stato:
<INPUT TYPE="TEXT" SIZE="20" NAME="sede_stato" VALUE="Italia"></INPUT>
</td>
</TR>
</table>

<TABLE WIDTH="90%" CELLPADDING="1" CELLSPACING="3" BORDER="0">
<TR>
<td BGCOLOR="Orange">
Indirizzo altra sede
</td>
</TR>

<TR>
<td>
Indirizzo.
<INPUT TYPE="TEXT" SIZE="30" NAME="altre_indirizzo"></INPUT>
N.
<INPUT TYPE="TEXT" SIZE="4" NAME="altre_civico"></INPUT>
Tel.
 <INPUT TYPE="TEXT" SIZE="10" NAME="altre_tel"></INPUT>Fax.
 <INPUT TYPE="TEXT" SIZE="10" NAME="altre_fax"></INPUT>
</td>
</TR>

<TR>
<td>
Citt&aacute;:
 <INPUT TYPE="TEXT" SIZE="25" NAME="altre_citta"></INPUT>
 Prov.
 <INPUT TYPE="TEXT" SIZE="2" NAME="altre_prov"></INPUT>
CAP.
 <INPUT TYPE="TEXT" SIZE="5" NAME="altre_cap"></INPUT>
Stato:
<INPUT TYPE="TEXT" SIZE="20" NAME="altre_stato" VALUE="Italia"></INPUT>
</td>
</TR>
</table>

<TABLE WIDTH="90%" CELLPADDING="1" CELLSPACING="3" BORDER="0">
<TR>
<TD BGCOLOR="Orange">
Attivit&agrave; svolte dalla ditta.
</td>
</tr>

<tr>
<td align="center">
<TEXTAREA NAME="attivita" ROWS="2" COLS="80"></TEXTAREA>
</TD>
</TR>

<TR>
<TD align="justify">
<I><B>Attenzione:</B> Facendo clic sul pulsante "Conferma registrazione"
 si garantisce la correttezza delle informazioni sopra indicate.
 La conferma vale anche come consenso implicito all'utilizzo dei dati personali
ai sensi dell'articolo 675/96.</I>
</TD>
</TR>

<TR>
<TD ALIGN="center">
<INPUT TYPE="SUBMIT" VALUE="Conferma registrazione"></INPUT>
&nbsp;<INPUT TYPE="RESET" VALUE="Annulla"></INPUT>
</TD>
</TR>
</TABLE>
</FORM>	

</BODY>
</HTML>