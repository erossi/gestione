<? 
// ----------------------------------------------------------------------------------
// lista_articolo
// stampa la lista degli articoli divisa in categorie
// $result e' il puntatore al dbase aperto
// $title e' il titolo della prima barra in alto
// $listino e' il listino da stampare
// ----------------------------------------------------------------------------------
function lista_articolo($result,$title,$listino)
 {
// quanti articoli abbiamo?
$numero_articoli=pg_numrows($result);

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
 print '<td align="right" valign="bottom" width="60">
 <img src="../icone/table_top.png" width="60"  height="20" border="0"></td>';

 print '<td align="right" valign="bottom" width="200">
 <img src="../icone/table_top.png" width="200" height="20" border="0"></td>';

 print '<td align="right" valign="bottom" width="200">
 <img src="../icone/table_top.png" width="200" height="20" border="0"></td>';
   
 print '<td align="right" valign="bottom" width="30">
 <img src="../icone/table_top.png" width="30"  height="20" border="0"></td>';

 print '<td align="right" valign="bottom" width="100">
 <img src="../icone/table_top.png" width="100" height="20" border="0"></td>';

 print '<td align="left"  valign="bottom" width="20">
 <img src="../icone/table_upright.png" width="20" height="20" border="0"></td>';
 print '</tr>';

// *** seconda righa con il titolo ***
 print '<tr bgcolor="#000080">';
 
 print '<td align="center" valign="middle" colspan="5">
 <font face="arial,helvetica,sans-serif" size="2" color="white">
 ' . $title . '</font></td>';
 
 print '<td align="right" valign="bottom" width="20"
  background="../icone/table_right.png">&nbsp;</td>';
 print '</tr>';                

// *** terza riga con le testate della tabella ***
 print '<tr>';
 print '<td width="60">';
 print '<font face="arial,helvetica,sans-serif" size="2">&nbsp;Codice
 <br><br></font>';
 
 print '</td>';
 
 print '<td width="200">';
 print '<font face="arial,helvetica,sans-serif" size="2">
 &nbsp;Articolo<br><br></font>';
 
 print '</td>';

print '<td width="200">';
 print '<font face="arial,helvetica,sans-serif" size="2">
 &nbsp;<br><br></font>';
 
 print '</td>';
 
 print '<td align="center" width="30">';
 print '<font face="arial,helvetica,sans-serif" size="2">
 &nbsp;Qt.<br><br></font>';
 
 print '</td>';
 
 print '<td align="center" width="100">';
 print '<font face="arial,helvetica,sans-serif" size="2">
 &nbsp;Euro<br><br></font>';
 
 print '    </td>';
 
 print '<td align="right" valign="bottom" width="20"
 background="../icone/table_right.png">&nbsp;</td>';
 
 print '</tr>';

// *** Inizio la stampa della tabella ***    
 for ($indice=0; $indice<$numero_articoli; $indice++) {
  $articolo = pg_fetch_array ($result, $indice);

  print ($indice % 2 ? '<tr bgcolor="#e0e0e0">'
   : '<tr background="white">');

  print '<td width="60">';
  print '<font face="arial,helvetica,sans-serif" size="2">
  &nbsp;' . $articolo["codice_art"] . '</font>';
  print '</td>';

  print '<td width="200">';
  print '<font face="arial,helvetica,sans-serif" size="2">
  &nbsp;' . $articolo["descrizione"] . '</font>';
  print '    </td>';

  print '<td width="200">';
  print '<font face="arial,helvetica,sans-serif" size="2">
  &nbsp;' . $articolo["descrizione2"] . '</font>';
  print '    </td>';

  print '<td width="30" align="right"';

  if ($articolo["quantita"] < 1)
   {
   print 'bgcolor="red"';
   };
  
  print '>';
  print '<font face="arial,helvetica,sans-serif" size="2">
  &nbsp;' . $articolo["quantita"] . '</font>';
  print '    </td>';

  print '<td width="100" align="right">';
  print '<font face="arial,helvetica,sans-serif" size="2">
  &nbsp;' . $articolo[$campo_listino] . '</font>';
  print '</td>';
  
  print '<td align="right" valign="bottom" width="20"
   background="../icone/table_right.png">&nbsp;</td>';
  print '</tr>';
  }

// *** stampo il bottom della tabella ***
 print '<tr>';
 print '<td align="right" valign="top" width="60">
 <img src="../icone/table_bottom.png" width="60" height="20" border="0"></td>';

 print '<td align="right" valign="top" width="200">
 <img src="../icone/table_bottom.png" width="200" height="20" border="0"></td>';

 print '<td align="right" valign="top" width="200">
 <img src="../icone/table_bottom.png" width="200" height="20" border="0"></td>';

 print '<td align="right" valign="top" width="30">
 <img src="../icone/table_bottom.png" width="30" height="20" border="0"></td>';

 print '<td align="right" valign="top" width="100">
 <img src="../icone/table_bottom.png" width="100" height="20" border="0"></td>';

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
 print '<td align="center" valign="middle" width="590">
 <font face="arial,helvetica,sans-serif" size="2" color="white">
 ' . $title . '</font></td>';

 print '<td align="right" valign="bottom" width="20"
 background="../icone/table_right.png">&nbsp;</td>';
 print '</tr>';                

 print '<tr>';
 print '<td background="../icone/table_back.png">';
 print '<font face="arial,helvetica,sans-serif" size="2">
 &nbsp;Non ci sono articoli</font>';
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
