<?php
// ----------------------------------------------------------------------------------
// lista_fatture
// $result e' il puntatore al dbase aperto
// $title e' il titolo della prima barra in alto
// $page_link e' la pagina da chiamare quando si clicca.
// ----------------------------------------------------------------------------------
function lista_fatture($result,$title,$page_link)
 {
// pagina da chiamare quando si clicca.
// magari da esportare nel prog. chiamante
// $page_link="modifica_fax.php";

// quanti articoli abbiamo?
$numero_elementi=pg_numrows($result);

// definizioni larghezza tabelle
// i bordi
$sizeb=5;

// quante colonne senza bordi
$colonne=9;

// le colonne
$size1=30;
$label1="N.";
$align1="RIGHT";

$size2=100;
$label2="Data Fatt.";
$align2="RIGHT";

$size3=100;
$label3="Data Scad.";
$align3="RIGHT";

$size4=100;
$label4="Data Pag.";
$align4="RIGHT";

$size5=100;
$label5="Tipo pag.";
$align5="LEFT";

$size6=50;
$label6="Imp.";
$align6="RIGHT";

$size7=50;
$label7="Iva";
$align7="RIGHT";

$size8=50;
$label8="Tot.";
$align8="RIGHT";

// $size9=100;
$label9="Cliente";
$align9="LEFT";

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
 print "<td width=\"$size3\" align=\"$align3\">$label3</td>";
 print "<td width=\"$size4\" align=\"$align4\">$label4</td>";
 print "<td width=\"$size5\" align=\"$align5\">$label5</td>";
 print "<td width=\"$size6\" align=\"$align6\">$label6</td>";
 print "<td width=\"$size7\" align=\"$align7\">$label7</td>";
 print "<td width=\"$size8\" align=\"$align8\">$label8</td>";
 print "<td width=\"$size9\" align=\"$align9\">$label9</td>";
 
 print "<td width=\"$sizeb\" style=\"background : orange\">&nbsp;</td>";
 print '</tr>';

// *** Inizio la stampa della tabella ***    
 for ($indice=0; $indice<$numero_elementi; $indice++)
  {
  $elemento = pg_fetch_array ($result, $indice);

//$query="SELECT numero,
// to_char(data_fattura,'DD Mon YYYY') as dataf,
// to_char(data_scadenza_pagamento,'DD Mon YYYY') as datasc,
// to_char(data_pagamento,'DD Mon YYYY') as datapg,
// tipo_pagamento, imponibile, iva, totale, cliente
// FROM fatture_vendita order by numero";

  $label1=$elemento["numero"];
  $label2=$elemento["dataf"];
  $label3=$elemento["datasc"];
  $label4=$elemento["datapg"];
  $label5=$elemento["tipo_pagamento"];
  $label6=$elemento["imponibile"];
  $label7=$elemento["iva"];
  $label8=$elemento["totale"];  
  $label9=$elemento["cliente"];

  if (($indice % 2) == 0)
   { $bgcolor="white"; }
  else
   { $bgcolor="grey"; };
  
  print "<tr style = \"background : $bgcolor \">";
  print "<td width=\"$sizeb\" style=\"background : orange\">&nbsp;</td>";

 print "<td width=\"$size1\" align=\"$align1\">$label1</td>";
 print "<td width=\"$size2\" align=\"$align2\">$label2</td>";
 print "<td width=\"$size3\" align=\"$align3\">$label3</td>";
 print "<td width=\"$size4\" align=\"$align4\">$label4</td>";
 print "<td width=\"$size5\" align=\"$align5\">$label5</td>";
 print "<td width=\"$size6\" align=\"$align6\">$label6</td>";
 print "<td width=\"$size7\" align=\"$align7\">$label7</td>";
 print "<td width=\"$size8\" align=\"$align8\">$label8</td>";
 print "<td width=\"$size9\" align=\"$align9\">$label9</td>";

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
