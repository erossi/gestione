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
$size1=70;
$size2=200;
$size3=150;
$size4=30;
$size5=50;
$size6=50;
$size7=50;
$size8=50;
$size9=50;
$total_size=700;
$bg_titolo="#0000f0";

// stampo il risultato
if ($numero_articoli >= 1) {
 // stampo il risultato (adesso so che almeno un articolo c'e`).

// *** Prima righa di bordo ***
 print "<br>";

// *** seconda righa con il titolo ***
 print '<table cellspacing="0" cellpadding="0" border="1" width="100%">';
 print '<tr bgcolor="' . $bg_titolo . '">';
 print '<td align="center" valign="middle">';
 print '<font style="color: white">';
 print $title . '</td>';
 print '</font>';
 print '</tr></table>';                

// *** terza riga con le testate della tabella ***
 print '<table cellspacing="0" cellpadding="0" border="0" width="100%">';
 print '<tr bgcolor="green">';
 print '<td width="' . $size1 . '">';
 print '&nbsp;Codice';
 print '</td>';
 
// print '<td width="' . $size2 . '">';
 print "<td>";
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
 
 print '</tr>';

// *** Inizio la stampa della tabella ***    
 for ($indice=0; $indice<$numero_articoli; $indice++) {
  $articolo = pg_fetch_array ($result, $indice);

  print ($indice % 2 ? '<tr bgcolor="#e0e0e0">'
   : '<tr background="white">');

  print '<td width="' . $size1 . '">' . $articolo["codice_art"];
  print '</td>';

//  print '<td width="' . $size2 . '">';
  print "<td>";
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
  
//  print '<td align="right" valign="bottom" width="20"
//   background="../icone/table_right.png">&nbsp;</td>';
  print '</tr>';
  }

 print '</table>';
 print "<br>";
 }
// ********** else
 else
 {
 print "<br>";
 print '<table cellspacing="0" cellpadding="0" border="1" width="100%">';
 print '<tr bgcolor="#000080">';
 print '<td align="center" valign="middle"';
 print '<font style="color:white">'; 
 print $title;
 print '</font>';
 print '</td>';
 print "</tr>";
 print '<tr>';
 print '<td>';
 print '&nbsp;Non ci sono articoli';
 print '</td>';
 print '</tr>';
 print '</table>';
 }
}
?>
