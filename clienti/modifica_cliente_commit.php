<? if (file_exists('../default.php')) { include '../default.php'; } ?>
<? if (file_exists('../procedure/utility.php')) { include '../procedure/utility.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<HTML>
<HEAD>
</HEAD>
<BODY>

<!-- Content -->
<H4>Registrazione utente</H4>
<DIV ALIGN="LEFT">
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
 print 'Premete il tasto "indietro" del Vostro browser per reinserire i dati.<BR>';
 exit;
 }

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
 print '<br> DEBUG <br>';
 print $query;
 print '<br>';
 }

$result = db_execute($conn,$query);

pg_close($conn);
?>

</DIV>

</BODY>
</HTML>
