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
// i bordi
$sizeb=1;

// quante colonne senza bordi
$colonne=2;

// le colonne
$size1=50;
$label1="Codice";
$align1="LEFT";

$size2=200;
$label2="Descrizione";
$align2="LEFT";

// stampo il risultato
if ($numero_elementi >= 1)
 {
// stampo il risultato.
 print '<table cellspacing="0" cellpadding="1" border="0" width="100%">';

// *** Prima righa di bordo ***
 print '<tr style="background : orange">';
 print '<td align="center" colspan="'. ($colonne + 2) . '">&nbsp;</td>';
 print '</tr>';

// *** seconda righa con il titolo ***
 print '<tr bgcolor="navy">';
 print "<td width=\"$sizeb\" style=\"background : orange\">&nbsp;</td>";
 print '<td align="center" valign="middle" colspan="' . $colonne . '">';
 print '<font style="color: white">';
 print "$title";
 print '</font></td>';
 print "<td width=\"$sizeb\" style=\"background : orange\">&nbsp;</td>";
 print '</tr>';

// *** terza riga con le testate della tabella ***
 print '<tr style="background : green">';
 print "<td width=\"$sizeb\" style=\"background : orange\">&nbsp;</td>";

 print "<td width=\"$size1\" align=\"$align1\">$label1</td>";
 print "<td width=\"$size2\" align=\"$align2\">$label2</td>";
 
 print "<td width=\"$sizeb\" style=\"background : orange\">&nbsp;</td>";
 print '</tr>';

// *** Inizio la stampa della tabella ***    
 for ($indice=0; $indice<$numero_elementi; $indice++)
  {
  $elemento = pg_fetch_array ($result, $indice);

  $label1=$elemento["numero"];
  $label2=$elemento["descrizione"];

  if (($indice % 2) == 0)
   { $bgcolor="white"; }
  else
   { $bgcolor="grey"; };
  
  print "<tr style = \"background : $bgcolor \">";
  print "<td width=\"$sizeb\" style=\"background : orange\">&nbsp;</td>";

 print "<td width=\"$size1\" align=\"$align1\">$label1</td>";
 print "<td width=\"$size2\" align=\"$align2\">$label2</td>";

  print "<td width=\"$sizeb\" style=\"background : orange\">&nbsp;</td>";
  print '</tr>';
  }

// *** stampo il bottom della tabella ***
 print '<tr style="background : orange">';
 print '<td align="center" colspan="' . ($colonne + 2) . '">&nbsp;</td>';
 print '</tr>';

 print '</table>';
 }
}
?>
