<?php
// ----------------------------------------------------------------------------------
// lista_clienti
// $result e' il puntatore al dbase aperto
// $title e' il titolo della prima barra in alto
// $page_link e' la pagina da chiamare quando si clicca.
// ----------------------------------------------------------------------------------
function lista_clienti($result,$title,$page_link)
 {
// pagina da chiamare quando si clicca.
// magari da esportare nel prog. chiamante
// $page_link="modifica_cliente.php";

// quanti articoli abbiamo?
$numero_elementi=pg_numrows($result);

// definizioni larghezza tabelle
$size1=150;
$size2=200;
$size3=200;
$size4=50;
$size5=50;
$size6=50;
$total_size=700;
$bg_titolo="#0000f0";

// stampo il risultato
if ($numero_elementi >= 1)
 {
// stampo il risultato.
 print '<table cellspacing="0" cellpadding="0" border="0">';

// *** Prima righa di bordo ***
 print '<tr>';
 
 print '<td align="center" valign="middle" colspan="6">';
 print '<img src="../icone/table_top.png" width="';
 print $total_size . '" height="20" border="0"></td>';
 
 print '<td align="left" valign="bottom" width="20">';
 print '<img src="../icone/table_upright.png"';
 print 'width="20" height="20" border="0"></td>';
 print '</tr>';

// *** seconda righa con il titolo ***
 print '<tr bgcolor="' . $bg_titolo . '">';
 
 print '<td align="center" valign="middle" colspan="6">';
 print '<font style="color: white">';
 print $title . '</td>';
 print '</font>';
 
 print '<td align="right" valign="bottom" width="20"
  background="../icone/table_right.png">&nbsp;</td>';
 print '</tr>';                

// *** terza riga con le testate della tabella ***
 print '<tr bgcolor="green">';
 print '<td width="' . $size1 . '">';
 print '&nbsp;Codice';
 print '</td>';
 
 print '<td width="' . $size2 . '">';
 print '&nbsp;Ragione soc.';
  print '</td>';

 print '<td width="' . $size3 . '">';
 print '&nbsp;Responsabile';
 print '</td>';
 
 print '<td align="center" width="' . $size4 . '">';
 print '&nbsp;Eml';
 print '</td>';
 
 print '<td align="center" width="' . $size5 . '">';
 print 'www';
 print '</td>';

 print '<td align="center" width="' . $size6 . '">';
 print 'Lst';
 print '</td>';

 print '<td align="right" valign="bottom" width="20"
 background="../icone/table_right.png">&nbsp;</td>';
 
 print '</tr>';

// *** Inizio la stampa della tabella ***    
 for ($indice=0; $indice<$numero_elementi; $indice++) {
  $elemento = pg_fetch_array ($result, $indice);

  print ($indice % 2 ? '<tr bgcolor="#e0e0e0">'
   : '<tr background="white">');

  print '<td width="' . $size1 . '">' . $elemento["codice"];
  print '</td>';

  print '<td width="' . $size2 . '">';
  
  if ($page_link)
   {
   $link = $page_link . "?codice=" . $elemento['codice'];
   print "<a href=\"$link\">";
   print '&nbsp;' . $elemento["ragsoc"];
   print '</a>';
   }
  else
   {
   print '&nbsp;' . $elemento["ragsoc"];
   };
  
  print '</td>';

  print '<td width="' . $size3 . '">';
  print '&nbsp;' . $elemento["respcom"] . '</a>';
  print '</td>';

  print '<td width="' . $size4 . '" align="center"';

  if ($elemento["email_listino"] == 'f')
   {
   print 'bgcolor="red"';
   };
  
  print '>&nbsp;' . $elemento["email_listino"];
  print '</td>';

  print '<td width="' . $size5 . '" align="center"';

  switch ($elemento["status"])
   {
   case "r": print 'bgcolor="blue"'; break;
   case "n": print 'bgcolor="red"'; break;
   default: break;
   }

  print '>&nbsp;' . $elemento["status"];
  print '</td>';

  print '<td width="' . $size6 . '" align="center">';
  print '&nbsp;' . $elemento["listino"];
  print '</td>';

  print '<td align="right" valign="bottom" width="20"
   background="../icone/table_right.png">&nbsp;</td>';
  print '</tr>';
  }

// *** stampo il bottom della tabella ***
 print '<tr>';
 
 print '<td align="center" valign="middle" colspan="6">';
 print '<img src="../icone/table_bottom.png" width="';
 print $total_size . '" height="20" border="0"></td>';
 
 print '<td align="right" valign="top" width="20">
 <img src="../icone/table_botright.png" width="20" height="20" border="0"></td>';
 
 print '</tr>';
 print '</table>';
 }
// ********** else
 else
 {
 print '<table cellspacing="0" cellpadding="0" border="0">';

// Prima riga
 print '<tr>';
 print '<td align="right" valign="bottom" width="';
 print $total_size . '"><img src="../icone/table_top.png" width="';
 print $total_size . '" height="20" border="0"></td>';

 print '<td align="left" valign="bottom" width="20">
 <img src="../icone/table_upright.png" width="20" height="20" border="0"></td>';
  print '</tr>';
 
// Seconda riga
 print '<tr bgcolor="' . $bg_titolo . '">';
 print '<td align="center" valign="middle" width="';
 print $total_size . '">';
 print $title . '</td>';

 print '<td align="right" valign="bottom" width="20"
 background="../icone/table_right.png">&nbsp;</td>';
 print '</tr>';                

 print '<tr>';
 print '<td background="../icone/table_back.png">';
 print '&nbsp;Non ci sono elementi';
 print '</td>';

 print '<td align="right" valign="bottom" width="20"
 background="../icone/table_right.png">&nbsp;</td>';
 print '</tr>';
 
 print '<tr>';
 print '<td align="right" valign="top" width="';
 print $total_size . '"><img src="../icone/table_bottom.png" width="';
 print $total_size . '" height="20" border="0"></td>';

 print '<td align="right" valign="top" width="20">
 <img src="../icone/table_botright.png" width="20" height="20" border="0"></td>';
 print '</tr>';
 print '</table>';
 }
}
?>
