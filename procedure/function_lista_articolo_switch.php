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
$size1=70;
$size2=250;
$size3=250;
$size4=30;
$size5=70;

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

// *** Prima righa di bordo ***
 print '<br>';

// *** seconda righa con il titolo ***
 print '<table cellspacing="0" cellpadding="0" border="1" width="100%">';
 print '<tr bgcolor="#000080">';
 print '<td align="center" valign="middle"';
 print '<font style="color:white">'; 
 print $title;
 print '</font>';
 print '</td>';
 print "</tr></table>";

// *** terza riga con le testate della tabella ***
 print '<table cellspacing="0" cellpadding="0" border="0" width="100%">';
 print '<tr bgcolor="green">';
 print '<td width="' . $size1 . '">';
 print '&nbsp;Codice';
 print '</td>';
 
 print '<td>';
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
 
 print '</tr>';

// *** Inizio la stampa della tabella ***    
 for ($indice=0; $indice<$numero_articoli; $indice++) {
  $articolo = pg_fetch_array ($result, $indice);

  print ($indice % 2 ? '<tr bgcolor="#e0e0e0">'
   : '<tr background="white">');

  print '<td width="' . $size1 . '">' . $articolo["codice_art"];
  print '</td>';

  print '<td>';
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
  print '</tr>';
  }

 print '</table>';
 print "<br>";
 }
 else
 {
 print "<br>";
// print '<table cellspacing="0" cellpadding="0" border="1" width="100%">';
// print '<tr bgcolor="#000080">';
// print '<td align="center" valign="middle"';
// print '<font style="color:white">'; 
// print $title;
// print '</font>';
// print '</td>';
// print "</tr>";
// print '<tr>';
// print '<td>';
// print '&nbsp;Non ci sono articoli';
// print '</td>';
// print '</tr>';
// print '</table>';
 }
}
?>
