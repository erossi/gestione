<?php
// ----------------------------------------------------------------------------------
// lista_fax
// $result e' il puntatore al dbase aperto
// $title e' il titolo della prima barra in alto
// $page_link e' la pagina da chiamare quando si clicca.
// ----------------------------------------------------------------------------------
function lista_fax($result,$title,$page_link)
 {
// pagina da chiamare quando si clicca.
// magari da esportare nel prog. chiamante
// $page_link="modifica_fax.php";

// quanti articoli abbiamo?
$numero_elementi=pg_numrows($result);

// definizioni larghezza tabelle
$sizeb=5;
$size1=100;
$size2=100;
$size3=200;
$size4=20;
$size5=20;

// stampo il risultato
if ($numero_elementi >= 1)
 {
// stampo il risultato.
 print '<table cellspacing="0" cellpadding="0" border="0" width="90%">';

// *** Prima righa di bordo ***
 print '<tr style="background : orange">';
 print '<td align="center" colspan="7">&nbsp;</td>';
 print '</tr>';

// *** seconda righa con il titolo ***
 print '<tr bgcolor="navy">';
 print "<td width=\"$sizeb\" style=\"background : orange\">&nbsp;</td>";
 print '<td align="center" valign="middle" colspan="5">';
 print '<font style="color: white">';
 print "$title";
 print '</font></td>';
 print "<td width=\"$sizeb\" style=\"background : orange\">&nbsp;</td>";
 print '</tr>';                

// *** terza riga con le testate della tabella ***
 print '<tr style="background : green">';
 print "<td width=\"$sizeb\" style=\"background : orange\">&nbsp;</td>";
 print '<td width="' . $size1 . '">';
 print 'Data';
 print '</td>';
 
 print '<td width="' . $size2 . '">';
 print 'Ora';
 print '</td>';

 print '<td width="' . $size3 . '">';
 print 'Fax Id.';
 print '</td>';
 
 print '<td align="center" width="' . $size4 . '">';
 print 'Pag.';
 print '</td>';
 
 print '<td align="center" width="' . $size5 . '">';
 print 'di';
 print '</td>';
 print "<td width=\"$sizeb\" style=\"background : orange\">&nbsp;</td>";
 print '</tr>';

// *** Inizio la stampa della tabella ***    
 for ($indice=0; $indice<$numero_elementi; $indice++)
  {
  $elemento = pg_fetch_array ($result, $indice);

  $data=$elemento["data"];
  $ora=$elemento["ora"];
  $faxid=$elemento["remote_id"];
  $pagina=$elemento["pagina"];
  $pagtot=$elemento["pagine_totali"];
  $faxurl=$elemento["url"];
  
  if (($indice % 2) == 0)
   { $bgcolor="white"; }
  else
   { $bgcolor="grey"; };
  
  print "<tr style = \"background : $bgcolor \">";
  print "<td width=\"$sizeb\" style=\"background : orange\">&nbsp;</td>";
  print "<td width=\"$size1\"> $data </td>";
//  print "<td width=\"$size1\"> $bgcolor </td>";
  print "<td width=\"$size2\"> $ora </td>";
  print "<td><a href=\"$faxurl\"> $faxid </a></td>";
  print "<td> $pagina </td>";
  print "<td> $pagtot </td>";
  print "<td width=\"$sizeb\" style=\"background : orange\">&nbsp;</td>";
  print '</tr>';
  }

// *** stampo il bottom della tabella ***
 print '<tr style="background : orange">';
 print '<td align="center" colspan="7">&nbsp;</td>';
 print '</tr>';

 print '</table>';
 }
}
?>
