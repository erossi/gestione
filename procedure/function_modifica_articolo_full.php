<?php
// -----------------------------------------------------------------------------
// Utility per la modifica di un articolo
// tutti i campi escluso i codice di categoria e articolo
// -----------------------------------------------------------------------------

// -----------------------------------------------------------------------------
// modifica_articles_full
// $result e' il puntatore al dbase aperto
// $action e' la pagina da chiamare dopo aver compilato il form
// -----------------------------------------------------------------------------
function modifica_articolo_full($arr,$action)
{
print'<form method="post" action="' . $action . '">';

 print'<table cellspacing="1" cellpadding="3" border="0">';
  print '<tr>';
  print '<td align="right" bgcolor="#336699">Categoria</td>';
  print '<td align="left">' . $arr['codice_cat'] . '</td>';
  print '<td align="right" bgcolor="#336699">Codice</td>';
  print '<td align="left">' . $arr['codice_art'] . '</td>';
  print '</tr>';

 print '<tr>';
 print '<td align="right" bgcolor="#336699">Descrizione</td>';
 print '<td align="left"><input type="text" name="descrizione" size="25" value="';
 print $arr['descrizione'] . '"></td>';
 print '<td align="right" bgcolor="#336699">Descrizione 2</td>';
 print '<td align="left"><input type="text" name="descrizione2" size="25" value="';
 print $arr['descrizione2'] . '"></td>';
 print '</tr>';

 print '<tr>';
 print '<td align="right" bgcolor="#336699">Quantita</td>';
 print '<td align="left"><input type="text" name="quantita" size="5" value="';
 print $arr['quantita'] . '"></td>';
 print '<td align="right" bgcolor="#336699">Prezzo di Acquisto</td>';
 print '<td align="left"><input type="text" name="prezzo_acq" size="15" value="';
 print $arr['prezzo_acq'] . '"></td>';
 print '</tr>';

 print '<tr>';
 print '<td align="right" bgcolor="#336699">Prezzo di Vendita 1</td>';
 print '<td align="left"><input type="text" name="prezzo_ven1" size="15" value="';
 print $arr['prezzo_ven1'] . '"></td>';
 print '<td align="right" bgcolor="#336699">Prezzo di Vendita 2</td>';
 print '<td align="left"><input type="text" name="prezzo_ven2" size="15" value="';
 print $arr['prezzo_ven2'] . '"></td>';
 print '</tr>';

 print '<tr>';
 print '<td align="right" bgcolor="#336699">Prezzo di Vendita 3</td>';
 print '<td align="left"><input type="text" name="prezzo_ven3" size="15" value="';
 print $arr['prezzo_ven3'] . '"></td>';
 print '<td align="right" bgcolor="#336699">Prezzo di Vendita 4</td>';
 print '<td align="left"><input type="text" name="prezzo_ven4" size="15" value="';
 print $arr['prezzo_ven4'] . '"></td>';
 print '</tr>';

 print '<tr>';
 print '<td align="right" bgcolor="#336699">Data di acquisto</td>';
 print '<td align="left"><input type="text" name="data_ultimo_acq" size="20" value="';
 print $arr['data_ultimo_acq'] . '"></td>';
 print '</tr>';

  print '</table>';
  print '<br>';
  
  print '<table>';
   print '<tr align="center" bgcolor="#336699">';
   print '<td>';
   print 'Info';
   print '<td>';
   print '</tr>';
   
   print '<tr align="center">';
   print '<td align="left">';
   print '<textarea name="info" rows="4" cols="70">';
   print $arr['info'] . '</textarea>';
   print '<td>';
   print '</tr>';

   print '<tr>';
   print '<td align="center">';
   print '<input type="submit" name="submit" value="Invia">
   &nbsp;<input type="reset" name="reset" value="Annulla">';
   print '<td>';
   print '</tr>';

print'</table>';
print'</form>';
};

?>
