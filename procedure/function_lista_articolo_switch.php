<? 
// ----------------------------------------------------------------------------------
// lista_articolo_switch
// stampa la lista degli articoli divisa in categorie
// $result e' il puntatore al dbase aperto
// $title e' il titolo della prima barra in alto
// ----------------------------------------------------------------------------------
function lista_articolo($result,$title,$listino)
 {
// quanti articoli abbiamo?
$numero_articoli=pg_numrows($result);

// definizioni larghezza tabelle
$size1=60;
$size2=150;
$size3=250;
$size4=20;
$size5=100;
$total_size=580;

switch ($listino)
 {
 case 0: $campo_listino="prezzo_acq"; break;
 case 1: $campo_listino="prezzo_ven1"; break;
 case 2: $campo_listino="prezzo_ven2"; break;
 case 3: $campo_listino="prezzo_ven3"; break;
 case 4: $campo_listino="prezzo_ven4"; break;
 default: $campo_listino="prezzo_ven1";
 }
    
// stampo il risultato
if ($numero_articoli >= 1) {
 // stampo il risultato (adesso so che almeno un articolo c'e`).
 print '<table cellspacing="0" cellpadding="0" border="0">';

// *** Prima righa di bordo ***
 print '<tr>';
 print '<td valign="bottom" width="';
 print $size1 . '"><img src="../icone/table_top.png" width="';
 print $size1 . '" height="20" border="0"></td>';

 print '<td valign="bottom" width="';
 print $size2 . '"><img src="../icone/table_top.png" width="';
 print $size2 . '" height="20" border="0"></td>';

 print '<td align="right" valign="bottom" width="';
 print $size3 . '"><img src="../icone/table_top.png" width="';
 print $size3 . '" height="20" border="0"></td>';
   
 print '<td align="right" valign="bottom" width="';
 print $size4 . '"><img src="../icone/table_top.png" width="';
 print $size4 . '"  height="20" border="0"></td>';

 print '<td align="right" valign="bottom" width="';
 print $size5 . '"><img src="../icone/table_top.png" width="';
 print $size5 . '" height="20" border="0"></td>';

 print '<td align="left" valign="bottom" width="20">';
 print '<img src="../icone/table_upright.png"';
 print 'width="20" height="20" border="0"></td>';
 print '</tr>';

// *** seconda righa con il titolo ***
 print '<tr bgcolor="#000080">';
 print '<td align="center" valign="middle" colspan="5">';
 print '<font style="color:white">'; 
 print $title;
 print '</font>';
 print '</td>';
 
 print '<td align="right" valign="bottom" width="20"';
 print 'background="../icone/table_right.png">&nbsp;</td>';
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
 print '&euro';
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
  print '&nbsp;' . $articolo["descrizione"];
  print '</td>';

  print '<td width="' . $size3 . '">';
  print '&nbsp;' . $articolo["descrizione2"];
  print '</td>';

  print '<td width="' . $size4 . '" align="right"';

  if ($articolo["quantita"] < 1)
   {
   print 'bgcolor="red"';
   };
  
  print '>&nbsp;' . $articolo["quantita"];
  print '</td>';

  print '<td width="' . $size5 . '" align="right">';
  print '&nbsp;' . $articolo[$campo_listino];
  print '</td>';
  
  print '<td align="right" valign="bottom" width="20"
   background="../icone/table_right.png">&nbsp;</td>';
  print '</tr>';
  }

// *** stampo il bottom della tabella ***
 print '<tr>';
 print '<td align="right" valign="top" width="';
 print $size1 . '"><img src="../icone/table_bottom.png" width="';
 print $size1 . '" height="20" border="0"></td>';

 print '<td align="right" valign="top" width="';
 print $size2 . '"><img src="../icone/table_bottom.png" width="';
 print $size2 . '" height="20" border="0"></td>';

 print '<td align="right" valign="top" width="';
 print $size3 . '"><img src="../icone/table_bottom.png" width="';
 print $size3 . '" height="20" border="0"></td>';

 print '<td align="right" valign="top" width="';
 print $size4 . '"><img src="../icone/table_bottom.png" width="';
 print $size4 . '" height="20" border="0"></td>';

 print '<td align="right" valign="top" width="';
 print $size5 . '"><img src="../icone/table_bottom.png" width="';
 print $size5 . '" height="20" border="0"></td>';

 print '<td align="right" valign="top" width="20">
 <img src="../icone/table_botright.png" width="20" height="20" border="0"></td>';
 
 print '</tr>';
 print '</table>';
 }
 else
 {
 print '<table cellspacing="0" cellpadding="0" border="0">';
 print '<tr>';
 print '<td align="right" valign="bottom" width="';
 print $total_size . '"><img src="../icone/table_top.png" width="';
 print $total_size . '" height="20" border="0"></td>';

 print '<td align="left" valign="bottom" width="20">
 <img src="../icone/table_upright.png" width="20" height="20" border="0"></td>';
  print '</tr>';
 
 print '<tr bgcolor="#000080">';
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
