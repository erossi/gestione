<?php
// -----------------------------------------------------------------------------
// Utility per la creazione di un articolo
// tutti i campi escluso i codice di categoria e articolo
// -----------------------------------------------------------------------------

// -----------------------------------------------------------------------------
// crea_articolo
// $action e' la pagina da chiamare dopo aver compilato il form
// -----------------------------------------------------------------------------
function crea_articolo($action)
{
if (file_exists('../../default.php'))
 { include '../../default.php'; }
 
// connessione al database
$conn=db_connect($db_host,$db_port,$db_name,$db_user);
$query="SELECT * FROM categorie";
$result = db_execute($conn,$query);
      
if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
      
$numero_elementi=pg_numrows($result);
 
// inizo il form
print'<form method="post" action="' . $action . '">';

 print'<table cellspacing="1" cellpadding="3" border="0">';

 print '<tr>';
 print '<td align="right" valign="middle" bgcolor="#336699">Categoria</td>';
 print '<td align="left"  valign="middle"><select name="codice_cat" size="1">';
 
 for ($indice=0; $indice<$numero_elementi; $indice++)
  {
  $categoria = pg_fetch_array ($result, $indice);
  print '<option value="' . $categoria["codice_cat"] . '">'
   . $categoria["descrizione"] . '</option>';
  }
   
 print '<td align="right" valign="middle" bgcolor="#336699">Codice</td>';
 print '<td align="left"  valign="middle">
  <input type="text" name="codice_art" size="6" align="absmiddle"></td>';
  
 print '</tr>';

 print '<tr>';
 print '<td align="right" valign="middle" bgcolor="#336699">Descrizione</td>';
 print '<td align="left"  valign="middle">
  <input type="text" name="descrizione" size="25" align="absmiddle"></td>';
  
 print '<td align="right" valign="middle" bgcolor="#336699">Descrizione 2</td>';
 print '<td align="left"  valign="middle">
  <input type="text" name="descrizione2" size="25" align="absmiddle"></td>';
  
 print '</tr>';

 print '<tr>';
 print '<td align="right" valign="middle" bgcolor="#336699">Prezzo di Acquisto</td>';
 print '<td align="left"  valign="middle">
  <input type="text" name="prezzo_acq" size="15" align="absmiddle"></td>';
 print '<td align="right" valign="middle" bgcolor="#336699">Data di acquisto</td>';
 print '<td align="left"  valign="middle">
  <input type="text" name="data" size="20" align="absmiddle"></td>';
 print '</tr>';

 print '<tr>';
 print '<td align="right" valign="middle" bgcolor="#336699">Prezzo di Vendita 1</td>';
 print '<td align="left"  valign="middle">
  <input type="text" name="prezzo_ven1" size="15" align="absmiddle"></td>';
 print '<td align="right" valign="middle" bgcolor="#336699">Prezzo di Vendita 2</td>';
 print '<td align="left"  valign="middle">
  <input type="text" name="prezzo_ven2" size="15" align="absmiddle"></td>';
 print '</tr>';

 print '<tr>';
 print '<td align="right" valign="middle" bgcolor="#336699">Prezzo di Vendita 3</td>';
 print '<td align="left"  valign="middle">
  <input type="text" name="prezzo_ven3" size="15" align="absmiddle"></td>';
 print '<td align="right" valign="middle" bgcolor="#336699">Prezzo di Vendita 4</td>';
 print '<td align="left"  valign="middle">
  <input type="text" name="prezzo_ven4" size="15" align="absmiddle"></td>';
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
   print '</textarea>';
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

db_close ($conn);
};

?>
