<?php
// -----------------------------------------------------------------------------
// crea_categoria
// $action e' la pagina da chiamare dopo aver compilato il form
// -----------------------------------------------------------------------------
function crea_categoria($action)
{
 
// inizo il form
print'<form method="post" action="' . $action . '">';

 print'<table cellspacing="1" cellpadding="3" border="0">';

 print '<tr>';
 print '<td align="right" valign="middle" bgcolor="#336699">Codice Cat.</td>';
 print '<td align="left"  valign="middle">
  <input type="text" name="codice_cat" size="6" align="absmiddle"></td>';
  
 print '<td align="right" valign="middle" bgcolor="#336699">Descrizione</td>';
 print '<td align="left"  valign="middle">
  <input type="text" name="descrizione" size="25" align="absmiddle"></td>';
  
 print '</tr>';

  print '</table>';
  print '<br>';
  
  print '<table>';

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
