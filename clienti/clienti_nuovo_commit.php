<?php
 if (file_exists("auth.php"))
  { include "auth.php"; }

 $utility = $_SESSION['d_function_dir'] . "/f_utility.php";

 if (file_exists("$utility"))
  { include "$utility"; }
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

<?php

// debug
$DEBUG=1;
if ($DEBUG)
 {
 print '<br>';
 print "
 ('" . $piva . "',
 '" . $rag_soc . "',
 '" . $part_iva . "',
 '" . $resp_nome . "',
 '" . $resp_mail . "',
 '" . $sede_indirizzo . "',
 '" . $sede_civico . "',
 '" . $sede_citta . "',
 '" . $sede_prov . "',
 '" . $sede_cap . "',
 '" . $sede_tel . "',
 '" . $sede_fax . "',
 '" . $sede_stato . "',
 '" . $altre_indirizzo . "',
 '" . $altre_civico . "',
 '" . $altre_citta . "',
 '" . $altre_prov . "',
 '" . $altre_cap . "',
 '" . $altre_tel . "',
 '" . $altre_fax . "',
 '" . $altre_stato . "',
 '" . $attivita . "',
 '" . $status . "',
 '" . $password . "',
 'now',
 " . $listino . ",
 " . $email_listino . ")";
 };

// controllo eventuali errori
$errori = 0;

// connessione al database
$conn=db_connect($db_host,$db_port,$db_name,$db_user);    

$query = "SELECT count(*) from clienti WHERE piva='" . $part_iva . "'";
$result = db_execute($conn,$query);

// conto il numero di linee trovate (count ritorna sempre qualcosa).
$arr=pg_fetch_array ($result,0);
$num_rows=$arr[0];

// controllo la ragione sociale
if ($rag_soc == "")
 {
 print "<B>Attenzione:</B> &egrave; obbligatorio indicare la Ragione sociale.<BR>";
 $errori++;
 }

// controllo la partita iva ...

if ($num_rows > 0)
 {
 print "<B>Attenzione:</B> Il cliente risulta gi&agrave; inserito!!!<BR>";
 print "Contattate il Vs. responsabile commerciale per ulteriori informazioni.<BR>"; 
 $errori++;
 }

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
 pg_close($conn);
 print "<BR>Sono stati riscontrati " . $errori . " errori.<BR>";
 print 'Premete il tasto "indietro" del Vostro browser per reinserire i dati.<BR>';
 exit;
 }

// Sistemo i cambi a tutto minuscolo
$rag_soc=strtolower($rag_soc);

// in mancanza di una scelta di codice diversa uso la piva/cf
$codice = $part_iva;

// inizializzo la query

$query="INSERT INTO clienti(codice,ragsoc,piva,respcom,email,sede_via,
 sede_civico,sede_citta,sede_prov,sede_cap,sede_tel,sede_fax,sede_stato,
 sede_via_2,sede_civico_2,sede_citta_2,sede_prov_2,sede_cap_2,sede_tel_2,
 sede_fax_2,sede_stato_2,attivita,status,password,iscrdata,listino,
 email_listino)
 values
 ('" . $codice . "',
 '" . $rag_soc . "',
 '" . $part_iva . "',
 '" . $resp_nome . "',
 '" . $resp_mail . "',
 '" . $sede_indirizzo . "',
 '" . $sede_civico . "',
 '" . $sede_citta . "',
 '" . $sede_prov . "',
 '" . $sede_cap . "',
 '" . $sede_tel . "',
 '" . $sede_fax . "',
 '" . $sede_stato . "',
 '" . $altre_indirizzo . "',
 '" . $altre_civico . "',
 '" . $altre_citta . "',
 '" . $altre_prov . "',
 '" . $altre_cap . "',
 '" . $altre_tel . "',
 '" . $altre_fax . "',
 '" . $altre_stato . "',
 '" . $attivita . "',
 '" . $status . "',
 '" . $password . "',
 'now',
 " . $listino . ",
 '" . $email_listino . "')";


$result = db_execute($conn,$query);

// aggiungo anche il cliente nella lista degli accessi
$query="insert into accessi (codice,data) values ('" . $codice . "','now')";
$result = db_execute($conn,$query);

db_close($conn);
?>

</DIV>

</BODY>
</HTML>
