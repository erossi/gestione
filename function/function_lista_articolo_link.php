<? 
// ----------------------------------------------------------------------------------
// lista_articolo_link
// stampa la lista degli articoli divisa in categorie
// $result e' il puntatore al dbase aperto
// $title e' il titolo della prima barra in alto
// $listino e' il listino da stampare
// ----------------------------------------------------------------------------------
function lista_articolo_link($result,$title)
 {
// quanti articoli abbiamo?
$numero_articoli=pg_numrows($result);

// definizioni larghezza tabelle
$size1=60;
$size2=150;
$size3=150;
$size4=30;
$size5=60;
$size6=60;
$size7=60;
$size8=60;
$size9=60;
$total_size=690;
$bg_titolo="#0000f0";

// stampo il risultato
if ($numero_articoli >= 1) {
 // stampo il risultato (adesso so che almeno un articolo c'e`).
 print '<table cellspacing="0" cellpadding="0" border="0">';

// *** Prima righa di bordo ***
 print '<tr>';
 
 print '<td align="center" valign="middle" colspan="9">';
 print '<img src="../icone/table_top.png" width="';
 print $total_size . '" height="20" border="0"></td>';
 
 print '<td align="left" valign="bottom" width="20">';
 print '<img src="../icone/table_upright.png"';
 print 'width="20" height="20" border="0"></td>';
 print '</tr>';

// *** seconda righa con il titolo ***
 print '<tr bgcolor="' . $bg_titolo . '">';
 
 print '<td align="center" valign="middle" colspan="9">';
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
 print '&nbsp;Articolo';
  print '</td>';

print '<td width="' . $size3 . '">';
 print '&nbsp;';
 print '</td>';
 
 print '<td align="center" width="' . $size4 . '">';
 print '&nbsp;Qt.';
 print '</td>';
 
 print '<td align="center" width="' . $size5 . '">';
 print '&euro aq';
 print '</td>';

 print '<td align="center" width="' . $size6 . '">';
 print '&euro 1';
 print '</td>';

 print '<td align="center" width="' . $size7 . '">';
 print '&euro 2';
 print '</td>';

 print '<td align="center" width="' . $size8 . '">';
 print '&euro 3';
 print '</td>';

 print '<td align="center" width="' . $size9 . '">';
 print '&euro 4';
 print '</td>';
 
 print '<td align="right" valign="bottom" width="20"
 background="../icone/table_right.png">&nbsp;</td>';
 
 print '</tr>';

// *** Inizio la stampa della tabella ***    
 for ($indice=0; $indice<$numero_articoli; $indice++) {
  $articolo = pg_fetch_array ($result, $indice);

  print ($indice % 2 ? '<tr bgcolor="#e0e0e0">'
   : '<tr background="white">');

  print '<td width="' . $size1 . '">' . $articolo["codice_art"];
  print '</td>';

  print '<td width="' . $size2 . '">';
  print '<a href="secure/menu_articolo.php?codice_cat=' . $articolo['codice_cat']
   . '&codice_art=' . $articolo['codice_art'] . '">';
  print '&nbsp;' . $articolo["descrizione"] . '</a>';
  print '</td>';

  print '<td width="' . $size3 . '">';
  print '<a href="secure/menu_articolo.php?codice_cat=' . $articolo['codice_cat']
   . '&codice_art=' . $articolo['codice_art'] . '">';
  print '&nbsp;' . $articolo["descrizione2"] . '</a>';
  print '</td>';

  print '<td width="' . $size4 . '" align="right"';

  if ($articolo["quantita"] < 1)
   {
   print 'bgcolor="red"';
   };
  
  print '>&nbsp;' . $articolo["quantita"];
  print '</td>';

  print '<td width="' . $size5 . '" align="right">';
  print '&nbsp;' . $articolo["prezzo_acq"];
  print '</td>';

  print '<td width="' . $size6 . '" align="right">';
  print '&nbsp;' . $articolo["prezzo_ven1"];
  print '</td>';

  print '<td width="' . $size7 . '" align="right">';
  print '&nbsp;' . $articolo["prezzo_ven2"];
  print '</td>';

  print '<td width="' . $size8 . '" align="right">';
  print '&nbsp;' . $articolo["prezzo_ven3"];
  print '</td>';

  print '<td width="' . $size9 . '" align="right">';
  print '&nbsp;' . $articolo["prezzo_ven4"];
  print '</td>';
  
  print '<td align="right" valign="bottom" width="20"
   background="../icone/table_right.png">&nbsp;</td>';
  print '</tr>';
  }

// *** stampo il bottom della tabella ***
 print '<tr>';
 
 print '<td align="center" valign="middle" colspan="9">';
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
 print '&nbsp;Non ci sono articoli';
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
