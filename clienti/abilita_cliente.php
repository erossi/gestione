<?php
 if (file_exists("../default.php"))
  { include "../default.php"; }
 if (file_exists("$default_dir_function/utility.php"))
  { include "$default_dir_function/utility.php"; }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name ?></title>
    <link rel="stylesheet" href="../stylesheet.css">
</head>
<body>

<?php
print_title('Abilita cliente');

// connessione al database
$conn=db_connect($db_host,$db_port,$db_name,$db_user);

$query="SELECT * FROM clienti where codice='" . $codice . "'";
$result = db_execute($conn,$query);

// conto il numero di linee trovate (count ritorna sempre qualcosa).
$num_rows=pg_numrows($result);

if ( $num_rows != 1 )
 {
 print '<br><br> Grave Errore nel db, codice cliente sbagliato<br>';
 pg_close($conn);
 exit;
 }

$arr=pg_fetch_array($result,0);
pg_close($conn);

print '<br>';

print '<FORM ACTION="abilita_cliente_commit.php" METHOD="POST">';
print '<TABLE WIDTH="90%" CELLPADDING="1" CELLSPACING="3" BORDER="0">';
print '<input type="hidden" name="codice" value="';
print $codice . '"></input>';
print '<TR><TD BGCOLOR="Orange">Informazioni societ&agrave; (obbligatorie)';
print '</TD></TR>';

print '<TR><TD ALIGN="LEFT">Ragione sociale:';
print '<INPUT TYPE="TEXT" SIZE="25" NAME="rag_soc" value="';
print $arr["ragsoc"] . '"></INPUT>Partita IVA:';
print '<INPUT TYPE="TEXT" SIZE="25" NAME="part_iva" value="';
print $arr["piva"] . '"></INPUT>';
print '</TD></TR>';

print '<TR><TD ALIGN="LEFT">Responsabile commerciale:';
print '<INPUT TYPE="TEXT" SIZE="25" NAME="resp_nome" value="';
print $arr["respcom"] . '"></INPUT>E-Mail:';
print '<INPUT TYPE="TEXT" SIZE="25" NAME="resp_mail" value="';
print $arr["email"] . '"></INPUT>';
print '</TD></TR>';
print '</table>';

print '<TABLE WIDTH="90%" CELLPADDING="1" CELLSPACING="3" BORDER="0">';
print '<TR><td BGCOLOR="red">Informazioni di accesso</td></TR>';

print '<tr><td>Listino:';
print '<select name="listino" size="1">';
print ' <option selected value="' . $arr["listino"] . '">';
print $arr["listino"] . '</option>';
print ' <option value="1">1</option>';
print ' <option value="2">2</option>';
print ' <option value="3">3</option>';
print ' <option value="4">4</option>';
print '</select>';
print 'Accesso Web:';
print '<select name="status" size="1">';

// prima era $arr["status"];
$status="a";

print "<option selected value=\"$status\">";

switch ($status)
 {
 case "r":print 'attesa'; break;
 case "a":print 'attivo'; break;
 case "n":print 'vietato'; break;
 default:print 'Errore!'; break;
 }

print '</option>';
print ' <option value="a">attivo</option>';
print ' <option value="r">attesa</option>';
print ' <option value="n">vietato</option>';
print '</select>';

print 'Email automatica:';
print '<select name="email_listino" size="1">';
print ' <option selected value="' . $arr["email_listino"] . '">';
print $arr["email_listino"] . '</options>';
print ' <option value="f">N</option>';
print ' <option value="t">S</option>';
print '</select>';
print 'Password:';

print '<input type="text" size="10" name="password" value="';
print $arr["password"] . '">';
print '</input>';

print '</td></tr>';
print '</table>';

print '<TABLE WIDTH="90%" CELLPADDING="1" CELLSPACING="3" BORDER="0">';
print '<TR><td BGCOLOR="Orange">Indirizzo sede</td></TR>';

print '<TR><td>Indirizzo.';
print '<INPUT TYPE="TEXT" SIZE="30" NAME="sede_indirizzo" value="';
print $arr["sede_via"] . '"></INPUT>N.';
print '<INPUT TYPE="TEXT" SIZE="4" NAME="sede_civico" value="';
print $arr["sede_civico"] . '"></INPUT>Tel.';
print '<INPUT TYPE="TEXT" SIZE="10" NAME="sede_tel" value="';
print $arr["sede_tel"] . '"></INPUT>Fax.';
print '<INPUT TYPE="TEXT" SIZE="10" NAME="sede_fax" value="';
print $arr["sede_fax"] . '"></INPUT>';
print '</td></TR>';

print '<TR><td>Citt&aacute;:';
print '<INPUT TYPE="TEXT" SIZE="25" NAME="sede_citta" value="';
print $arr["sede_citta"] . '"></INPUT> Prov.';
print '<INPUT TYPE="TEXT" SIZE="2" NAME="sede_prov" value="';
print $arr["sede_prov"] . '"></INPUT>CAP.';
print '<INPUT TYPE="TEXT" SIZE="5" NAME="sede_cap" value="';
print $arr["sede_cap"] . '"></INPUT>Stato:';
print '<INPUT TYPE="TEXT" SIZE="20" NAME="sede_stato" VALUE="';
print $arr["sede_stato"] . '"></INPUT>';
print '</td></TR>';
print '</table>';

print '<TABLE WIDTH="90%" CELLPADDING="1" CELLSPACING="3" BORDER="0">';
print '<TR><td BGCOLOR="Orange">Indirizzo altra sede</td></TR>';

print '<TR><td>Indirizzo.';
print '<INPUT TYPE="TEXT" SIZE="30" NAME="altre_indirizzo" value="';
print $arr["sede_via_2"] . '"></INPUT>N.';
print '<INPUT TYPE="TEXT" SIZE="4" NAME="altre_civico" value="';
print $arr["sede_civico_2"] . '"></INPUT>Tel.';
print '<INPUT TYPE="TEXT" SIZE="10" NAME="altre_tel" value="';
print $arr["sede_tel_2"] . '"></INPUT>Fax.';
print '<INPUT TYPE="TEXT" SIZE="10" NAME="altre_fax" value="';
print $arr["sede_fax_2"] . '"></INPUT>';
print '</td></TR>';

print '<TR><td>Citt&aacute;:';
print '<INPUT TYPE="TEXT" SIZE="25" NAME="altre_citta" value="';
print $arr["sede_citta_2"] . '"></INPUT> Prov.';
print '<INPUT TYPE="TEXT" SIZE="2" NAME="altre_prov" value="';
print $arr["sede_prov_2"] . '"></INPUT>CAP.';
print '<INPUT TYPE="TEXT" SIZE="5" NAME="altre_cap" value="';
print $arr["sede_cap_2"] . '"></INPUT>Stato:';
print '<INPUT TYPE="TEXT" SIZE="20" NAME="altre_stato" VALUE="';
print $arr["sede_stato_2"] . '"></INPUT>';
print '</td></TR>';
print '</table>';

print '<TABLE WIDTH="90%" CELLPADDING="1" CELLSPACING="3" BORDER="0">';
print '<TR><TD BGCOLOR="Orange">Attivit&agrave; svolte dalla ditta.';
print '</td></tr>';

print '<tr><td align="center">';
print '<TEXTAREA NAME="attivita" ROWS="2" COLS="80">';
print $arr["attivita"] . '</TEXTAREA>';
print '</TD></TR>';

print '<TR><TD ALIGN="center">';

print '&nbsp;<INPUT TYPE="SUBMIT" VALUE="Abilita"></INPUT>';
print '&nbsp;<INPUT TYPE="RESET" VALUE="Annulla Modifiche"></INPUT>';
print '</TD></TR>';
print '</TABLE>';
print '</FORM>	';

print '<center>';
print '<form action="elimina_cliente_commit.php">';
print '<input type="hidden" name="codice" value="' . $codice . '">';
print '<input type="submit" value="Elimina Cliente">';
print '</form>';
print '</center>';

?>

</BODY>
</HTML>