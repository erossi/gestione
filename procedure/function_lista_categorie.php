<?php
// ----------------------------------------------------------------------------------
// stampa la lista degli articoli divisa in categorie
// $result e' il puntatore al dbase aperto
// $title e' il titolo della prima barra in alto
// $link 0- non si clicca 1-cliccabile
// ----------------------------------------------------------------------------------
function lista_categorie($result,$title,$link)
 {
// quanti articoli abbiamo?
$numero_elementi=pg_numrows($result);

// stampo il risultato
if ($numero_elementi >= 1) {
 // stampo il risultato (adesso so che almeno un elemento c'e`).
 print '<table cellspacing="0" cellpadding="0" border="0">';

// *** Prima righa di bordo ***
 print '<tr>';
 print '<td align="right" valign="bottom" width="60">
 <img src="../icone/table_top.png" width="60"  height="20" border="0"></td>';

 print '<td align="right" valign="bottom" width="200">
 <img src="../icone/table_top.png" width="200" height="20" border="0"></td>';

 print '<td align="left"  valign="bottom" width="20">
 <img src="../icone/table_upright.png" width="20" height="20" border="0"></td>';

 print '</tr>';

// *** seconda righa con il titolo ***
 print '<tr bgcolor="#000080">';
 
 print '<td align="center" valign="middle" colspan="2">';
 print '<font style:"color=white">';
 print $title;
 print '</font>';
 print '</td>';

 print '<td align="right" valign="bottom" width="20"
  background="../icone/table_right.png">&nbsp;</td>';

 print '</tr>';                

// *** terza riga con le testate della tabella ***
 print '<tr>';

 print '<td width="60">';
 print '&nbsp;Codice<br><br>';
 print '</td>';
 
 print '<td width="200">';
 print '&nbsp;Descrizione<br><br>';
 print '</td>';

 print '<td align="right" valign="bottom" width="20"
 background="../icone/table_right.png">&nbsp;</td>';

 print '</tr>';

// *** Inizio la stampa della tabella ***    
 for ($indice=0; $indice<$numero_elementi; $indice++) {
  $elemento = pg_fetch_array ($result, $indice);

  print ($indice % 2 ? '<tr bgcolor="#e0e0e0">'
   : '<tr background="white">');

  print '<td width="60">';
  print '&nbsp;' . $elemento["codice_cat"];
  print '</td>';

  print '<td width="200">';

 if ($link == "1")
  {
  print '<a href="secure/menu_categoria.php?codice_cat=';
  print $elemento['codice_cat'] . '">';
  print '&nbsp;' . $elemento["descrizione"];
  print '</a>';
  }
 else
  {
  print '&nbsp;' . $elemento["descrizione"];
  };

  print '</td>';

  print '<td align="right" valign="bottom" width="20"
   background="../icone/table_right.png">&nbsp;</td>';

  print '</tr>';
  }

// *** stampo il bottom della tabella ***
 print '<tr>';
 print '<td align="right" valign="top" width="60">';
 print '<img src="../icone/table_bottom.png" width="60" height="20" border="0">';
 print '</td>';

 print '<td align="right" valign="top" width="200">
 <img src="../icone/table_bottom.png" width="200" height="20" border="0"></td>';

 print '<td align="right" valign="top" width="20">
 <img src="../icone/table_botright.png" width="20" height="20" border="0"></td>';
 
 print '</tr>';
 print '</table>';
 }
 else
 {
 print '<table cellspacing="0" cellpadding="0" border="0">';
 print '<tr>';
 print '<td align="right" valign="bottom" width="590">
 <img src="../icone/table_top.png" width="590" height="20" border="0"></td>';

 print '<td align="left" valign="bottom" width="20">
 <img src="../icone/table_upright.png" width="20" height="20" border="0"></td>';
  print '</tr>';
 
 print '<tr bgcolor="#000080">';
 print '<td align="center" valign="middle" width="590">' . $title . '</td>';

 print '<td align="right" valign="bottom" width="20"
 background="../icone/table_right.png">&nbsp;</td>';
 print '</tr>';                

 print '<tr>';
 print '<td background="../icone/table_back.png">';
 print '&nbsp;Non ci sono categorie';
 print '</td>';

 print '<td align="right" valign="bottom" width="20"
 background="../icone/table_right.png">&nbsp;</td>';
 print '</tr>';
 
 print '<tr>';
 print '<td align="right" valign="top" width="590">
 <img src="../icone/table_bottom.png" width="590" height="20" border="0"></td>';
 print '<td align="right" valign="top" width="20">
 <img src="../icone/table_botright.png" width="20" height="20" border="0"></td>';
 print '</tr>';
 print '</table>';
 }
}
?>
