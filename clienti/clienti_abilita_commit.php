<?php
if (file_exists("auth.php"))
{ include "auth.php"; }

$utility = $_SESSION['d_function_dir'] . "/f_utility.php";
$fcl = $_SESSION['d_function_dir'] . "/f_clienti_lista.php";

if (file_exists("$utility"))
{ include "$utility"; }
if (file_exists("$fcl"))
{ include "$fcl"; }
?>

<BODY>
 <TABLE BGCOLOR="Black" CELLSPACING="0" CELLPADDING="0" BORDER="0" WIDTH="100%">
  <TR>
   
   <TD ALIGN="LEFT">
    <FONT style="color:white">
     Clienti->Abilita->cliente:
     &nbsp;
     <A HREF="clienti_abilita.php">
     Back</A>
     
    </FONT>
   </TD>
   
   <TD ALIGN="RIGHT"><FONT style="color:white">
     Created by <A HREF="http://www.tecnobrain.com" target="_top">Tecno
      <IMG SRC="../icone/logo_tecnobrain.gif" WIDTH="16" HEIGHT="18" BORDER="0" ALT="Tecno Brain" ALIGN="ABSMIDDLE">
     Brain</A>
   &nbsp;</FONT></TD>
  </TR>
 </TABLE>
 
 <?php
 if ($update)
 {
 
 // controllo eventuali errori
 $errori = 0;
 
 // controllo la ragione sociale
 if ($rag_soc == "")
 {
 print "<B>Attenzione:</B> &egrave; obbligatorio indicare la Ragione sociale.<BR>";
 $errori++;
 }
 
 // controllo la partita iva ...
 if ($part_iva == "")
 {
 echo "<B>Attenzione:</B> &egrave; obbligatorio indicare la Partita IVA.<BR>";
 $errori++;
 }
 
 // .. e il resonsabile
 if ($resp_nome == "")
 {
 print "<B>Attenzione:</B> Manca il nome del Responsabile commerciale.<BR>";
 $errori++;
 }
 
 if ($resp_mail == "")
 {
 echo "<B>Attenzione:</B> Manca l'indirizzo di posta elettronica da contattare.<BR>";
 $errori++;
 }
 
 // se ci sono errori interrompi...
 if ($errori > 0)
 {
 print "<BR>Sono stati riscontrati " . $errori . " errori.<BR>";
 print "";
 exit;
 }
 else
 {
 // Sistemo i cambi a tutto minuscolo
 $rag_soc=strtolower($rag_soc);
 
 // connessione al database
 $conn=db_connect($db_host,$db_port,$db_name,$db_user);    
 
 // inizializzo la query
 $query="update clienti set
 ragsoc='" . $rag_soc . "',
 piva='" . $part_iva . "',
 respcom='" . $resp_nome . "',
 email='" . $resp_mail . "',
 sede_via='" . $sede_indirizzo . "',
 sede_civico='" . $sede_civico . "',
 sede_citta='" . $sede_citta . "',
 sede_prov='" . $sede_prov . "',
 sede_cap='" . $sede_cap . "',
 sede_tel='" . $sede_tel . "',
 sede_fax='" . $sede_fax . "',
 sede_stato='" . $sede_stato . "',
 sede_via_2='" . $altre_indirizzo . "',
 sede_civico_2='" . $altre_civico . "',
 sede_citta_2='" . $altre_citta . "',
 sede_prov_2='" . $altre_prov . "',
 sede_cap_2='" . $altre_cap . "',
 sede_tel_2='" . $altre_tel . "',
 sede_fax_2='" . $altre_fax . "',
 sede_stato_2='" . $altre_stato . "',
 attivita='" . $attivita . "',
 status='" . $status . "',
 password='" . $password . "',
 listino=" . $listino . ",
 email_listino='" . $email_listino . "'
 WHERE codice='" . $codice . "'";
 
 if ($DEBUG)
 {
 print '<BR> DEBUG <BR>';
 print $query;
 print '<BR>';
 }
 
 $result = db_execute($conn,$query);
 
 db_close($conn);
 } // end else
 } // end if
 
 // connessione al database
 $conn=db_connect($db_host,$db_port,$db_name,$db_user);
 
 $query="SELECT * FROM clienti where codice='" . $codice . "'";
 $result = db_execute($conn,$query);
 
 // conto il numero di linee trovate (count ritorna sempre qualcosa).
 $num_rows=pg_numrows($result);
 
 if ( $num_rows != 1 )
 {
 print '<BR><BR> Grave Errore nel db, codice cliente sbagliato<BR>';
 db_close($conn);
 exit;
 }
 
 $arr=pg_fetch_array($result,0);
 db_close($conn);
 
 print '<BR>';
 
 print '<FORM ACTION="clienti_abilita_commit.php" METHOD="POST">';
  print '<TABLE WIDTH="90%" CELLPADDING="1" CELLSPACING="3" BORDER="0">';
   print '<input type="hidden" name="codice" value="';
   print $codice . '"></INPUT>';
   print '<INPUT type="hidden" name="update" value="1"></INPUT>';
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
  print '</TABLE>';
  
  print '<TABLE WIDTH="90%" CELLPADDING="1" CELLSPACING="3" BORDER="0">';
   print '<TR><TD BGCOLOR="red">Informazioni di accesso</TD></TR>';
   
   print '<TR><TD>Listino:';
     print '<SELECT name="listino" size="1">';
      print ' <OPTION selected value="' . $arr["listino"] . '">';
      print $arr["listino"] . '</OPTION>';
      print ' <OPTION value="1">1</OPTION>';
      print ' <OPTION value="2">2</OPTION>';
      print ' <OPTION value="3">3</OPTION>';
      print ' <OPTION value="4">4</OPTION>';
     print '</SELECT>';
     print 'Accesso Web:';
     print '<SELECT name="status" size="1">';
      print ' <OPTION selected value="a">attivo</OPTION>';
      print ' <OPTION value="a">attivo</OPTION>';
      print ' <OPTION value="r">attesa</OPTION>';
      print ' <OPTION value="n">vietato</OPTION>';
     print '</SELECT>';
     
     print 'Email automatica:';
     print '<SELECT name="email_listino" size="1">';
      print ' <OPTION selected value="t">S</OPTIONS>';
      print ' <OPTION value="f">N</OPTION>';
      print ' <OPTION value="t">S</OPTION>';
     print '</SELECT>';
     print 'Password:';
     
     print '<input type="text" size="10" name="password" value="';
     print $arr["password"] . '">';
     print '</INPUT>';
     
   print '</TD></TR>';
  print '</TABLE>';
  
  print '<TABLE WIDTH="90%" CELLPADDING="1" CELLSPACING="3" BORDER="0">';
   print '<TR><TD BGCOLOR="Orange">Indirizzo sede</TD></TR>';
   
   print '<TR><TD>Indirizzo.';
     print '<INPUT TYPE="TEXT" SIZE="30" NAME="sede_indirizzo" value="';
     print $arr["sede_via"] . '"></INPUT>N.';
     print '<INPUT TYPE="TEXT" SIZE="4" NAME="sede_civico" value="';
     print $arr["sede_civico"] . '"></INPUT>Tel.';
     print '<INPUT TYPE="TEXT" SIZE="10" NAME="sede_tel" value="';
     print $arr["sede_tel"] . '"></INPUT>Fax.';
     print '<INPUT TYPE="TEXT" SIZE="10" NAME="sede_fax" value="';
     print $arr["sede_fax"] . '"></INPUT>';
   print '</TD></TR>';
   
   print '<TR><TD>Citt&aacute;:';
     print '<INPUT TYPE="TEXT" SIZE="25" NAME="sede_citta" value="';
     print $arr["sede_citta"] . '"></INPUT> Prov.';
     print '<INPUT TYPE="TEXT" SIZE="2" NAME="sede_prov" value="';
     print $arr["sede_prov"] . '"></INPUT>CAP.';
     print '<INPUT TYPE="TEXT" SIZE="5" NAME="sede_cap" value="';
     print $arr["sede_cap"] . '"></INPUT>Stato:';
     print '<INPUT TYPE="TEXT" SIZE="20" NAME="sede_stato" VALUE="';
     print $arr["sede_stato"] . '"></INPUT>';
   print '</TD></TR>';
  print '</TABLE>';
  
  print '<TABLE WIDTH="90%" CELLPADDING="1" CELLSPACING="3" BORDER="0">';
   print '<TR><TD BGCOLOR="Orange">Indirizzo altra sede</TD></TR>';
   
   print '<TR><TD>Indirizzo.';
     print '<INPUT TYPE="TEXT" SIZE="30" NAME="altre_indirizzo" value="';
     print $arr["sede_via_2"] . '"></INPUT>N.';
     print '<INPUT TYPE="TEXT" SIZE="4" NAME="altre_civico" value="';
     print $arr["sede_civico_2"] . '"></INPUT>Tel.';
     print '<INPUT TYPE="TEXT" SIZE="10" NAME="altre_tel" value="';
     print $arr["sede_tel_2"] . '"></INPUT>Fax.';
     print '<INPUT TYPE="TEXT" SIZE="10" NAME="altre_fax" value="';
     print $arr["sede_fax_2"] . '"></INPUT>';
   print '</TD></TR>';
   
   print '<TR><TD>Citt&aacute;:';
     print '<INPUT TYPE="TEXT" SIZE="25" NAME="altre_citta" value="';
     print $arr["sede_citta_2"] . '"></INPUT> Prov.';
     print '<INPUT TYPE="TEXT" SIZE="2" NAME="altre_prov" value="';
     print $arr["sede_prov_2"] . '"></INPUT>CAP.';
     print '<INPUT TYPE="TEXT" SIZE="5" NAME="altre_cap" value="';
     print $arr["sede_cap_2"] . '"></INPUT>Stato:';
     print '<INPUT TYPE="TEXT" SIZE="20" NAME="altre_stato" VALUE="';
     print $arr["sede_stato_2"] . '"></INPUT>';
   print '</TD></TR>';
  print '</TABLE>';
  
  print '<TABLE WIDTH="90%" CELLPADDING="1" CELLSPACING="3" BORDER="0">';
   print '<TR><TD BGCOLOR="Orange">Attivit&agrave; svolte dalla ditta.';
   print '</TD></TR>';
   
   print '<TR><TD align="center">';
     print '<TEXTAREA NAME="attivita" ROWS="2" COLS="80">';
     print $arr["attivita"] . '</TEXTAREA>';
   print '</TD></TR>';
   
   print '<TR><TD ALIGN="center">';
     
     print '&nbsp;<INPUT TYPE="SUBMIT" VALUE="Salva le modifiche"></INPUT>';
     print '&nbsp;<INPUT TYPE="RESET" VALUE="Annulla le modifiche"></INPUT>';
   print '</TD></TR>';
  print '</TABLE>';
 print '</FORM>	';
 ?>
 
</BODY>
</HTML>
