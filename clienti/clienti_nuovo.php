<?php
if (file_exists("auth.php"))
{ include "auth.php"; }
?>

<BODY>
 <TABLE BGCOLOR="Black" CELLSPACING="0" CELLPADDING="0" BORDER="0" WIDTH="100%">
  <TR>
   
   <TD ALIGN="LEFT">
    <FONT style="color:white">
     Clienti->Nuovo:
      &nbsp;
      <A HREF="clienti_index.php">
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
 
 <BR>
 <DIV align="justify">
  La registrazione non &egrave; automatica: la Vostra richiesta
  verr&agrave; vagliata da un nostro incaricato che Vi risponder&agrave;
  all'indirizzo e-mail da Voi indicato.
 </DIV>
 
 <FORM ACTION="clienti_nuovo_commit.php" METHOD="POST">
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
  </TABLE>
  
  <TABLE WIDTH="90%" CELLPADDING="1" CELLSPACING="3" BORDER="0">
   <TR>
    <TD BGCOLOR="red">
     Informazioni di accesso
    </TD>
   </TR>
   
   <TR>
    <TD>
     Listino:
     <SELECT name="listino" size="1">
      <OPTION value="1">1</OPTION>
      <OPTION value="2">2</OPTION>
      <OPTION value="3">3</OPTION>
      <OPTION value="4">4</OPTION>
     </SELECT>
     Accesso Web:
     <SELECT name="status" size="1">
      <OPTION value="a">attivo</OPTION>
      <OPTION value="r">attesa</OPTION>
      <OPTION value="n">vietato</OPTION>
     </SELECT>
     Email automatica:
     <SELECT name="email_listino" size="1">
      <OPTION value="f">N</OPTION>
      <OPTION value="t">S</OPTION>
     </SELECT>
     Password:
     
     <?php
     $password_gen=exec($password_generator_command);
     
     print '<input type="text" size="10" name="password" value="';
     print $password_gen . '">';
     print '</INPUT>';
     ?>
     
    </TD>
   </TR>
  </TABLE>
  
  <TABLE WIDTH="90%" CELLPADDING="1" CELLSPACING="3" BORDER="0">
   <TR>
    <TD BGCOLOR="Orange">
     Indirizzo sede
    </TD>
   </TR>
   
   <TR>
    <TD>
     Indirizzo.
     <INPUT TYPE="TEXT" SIZE="30" NAME="sede_indirizzo"></INPUT>
     N.
     <INPUT TYPE="TEXT" SIZE="4" NAME="sede_civico"></INPUT>
     Tel.
     <INPUT TYPE="TEXT" SIZE="10" NAME="sede_tel"></INPUT>Fax.
     <INPUT TYPE="TEXT" SIZE="10" NAME="sede_fax"></INPUT>
    </TD>
   </TR>
   
   <TR>
    <TD>
     Citt&aacute;:
     <INPUT TYPE="TEXT" SIZE="25" NAME="sede_citta"></INPUT>
     Prov.
     <INPUT TYPE="TEXT" SIZE="2" NAME="sede_prov"></INPUT>
     CAP.
     <INPUT TYPE="TEXT" SIZE="5" NAME="sede_cap"></INPUT>
     Stato:
     <INPUT TYPE="TEXT" SIZE="20" NAME="sede_stato" VALUE="Italia"></INPUT>
    </TD>
   </TR>
  </TABLE>
  
  <TABLE WIDTH="90%" CELLPADDING="1" CELLSPACING="3" BORDER="0">
   <TR>
    <TD BGCOLOR="Orange">
     Indirizzo altra sede
    </TD>
   </TR>
   
   <TR>
    <TD>
     Indirizzo.
     <INPUT TYPE="TEXT" SIZE="30" NAME="altre_indirizzo"></INPUT>
     N.
     <INPUT TYPE="TEXT" SIZE="4" NAME="altre_civico"></INPUT>
     Tel.
     <INPUT TYPE="TEXT" SIZE="10" NAME="altre_tel"></INPUT>Fax.
     <INPUT TYPE="TEXT" SIZE="10" NAME="altre_fax"></INPUT>
    </TD>
   </TR>
   
   <TR>
    <TD>
     Citt&aacute;:
     <INPUT TYPE="TEXT" SIZE="25" NAME="altre_citta"></INPUT>
     Prov.
     <INPUT TYPE="TEXT" SIZE="2" NAME="altre_prov"></INPUT>
     CAP.
     <INPUT TYPE="TEXT" SIZE="5" NAME="altre_cap"></INPUT>
     Stato:
     <INPUT TYPE="TEXT" SIZE="20" NAME="altre_stato" VALUE="Italia"></INPUT>
    </TD>
   </TR>
  </TABLE>
  
  <TABLE WIDTH="90%" CELLPADDING="1" CELLSPACING="3" BORDER="0">
   <TR>
    <TD BGCOLOR="Orange">
     Attivit&agrave; svolte dalla ditta.
    </TD>
   </TR>
   
   <TR>
    <TD align="center">
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
