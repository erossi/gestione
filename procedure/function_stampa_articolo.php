<?php
// ----------------------------------------------------------------------------------
// stampa_articolo
// stampa i dati di un articolo in tabella
// $arr e' l'articolo
// ----------------------------------------------------------------------------------
function stampa_articolo($arr)
 {
 print '<table cellspacing="1" cellpadding="3" border="0">';

// riga
 print '<tr>';
 print '<td align="right" valign="middle" bgcolor="#336699">';
 print 'Categoria :</td>';

 print '<td>';
 print $arr['codice_cat'];
 print '</td>';

 print '<td align="right" valign="middle" bgcolor="#336699">';
 print 'Codice Articolo :</td>';

 print '<td>';
 print $arr['codice_art'];
 print '</td>';
 print '</tr>';

// riga
 print '<tr>';
 print '<td align="right" valign="middle" bgcolor="#336699">';
 print 'Descrizione :</td>';

 print '<td>';
 print $arr['descrizione'];
 print '</td>';

 print '<td align="right" valign="middle" bgcolor="#336699">';
 print 'Descrizione 2:</td>';

 print '<td>';
 print $arr['descrizione2'];
 print '</td>';
 print '</tr>';

// riga

 print '<tr>';
 print '<td align="right" valign="middle" bgcolor="#336699">';
 print 'Quant. disponibile :</td>';

 print '<td>';
 print $arr['quantita'];
 print '</td>';

 print '<td align="right" valign="middle" bgcolor="#336699">';
 print 'Prezzo di acquisto :</td>';

 print '<td>';
 print $arr['prezzo_acq'];
 print '</td>';
 print '</tr>';

 print '<tr>';
 print '<td align="right" valign="middle" bgcolor="#336699">';
 print 'Prezzo di vendita 1:</td>';

 print '<td>';
 print $arr['prezzo_ven1'];
 print '</td>';

 print '<td align="right" valign="middle" bgcolor="#336699">';
 print 'Prezzo di vendita 2:</td>';

 print '<td>';
 print $arr['prezzo_ven2'];
 print '</td>';
 print '</tr>';

// riga
 print '<tr>';
 print '<td align="right" valign="middle" bgcolor="#336699">';
 print 'Prezzo di vendita 3:</td>';

 print '<td>';
 print $arr['prezzo_ven3'];
 print '</td>';

 print '<td align="right" valign="middle" bgcolor="#336699">';
 print 'Prezzo di vendita 4:</td>';

 print '<td>';
 print $arr['prezzo_ven4'];
 print '</td>';
 print '</tr>';

// riga
 print '<tr>';
 print '<td align="right" valign="middle" bgcolor="#336699">';
 print 'Data ultimo acquisto :</td>';

 print '<td>';
 print $arr['data_ultimo_acq'];
 print '</td>';
 print '</tr>';
print '</table>';

print '    <br>';
    
print '<table>';
 print '<tr align="center" bgcolor="#336699">';
 print '<td>';
 print 'Info';
 print '</td>';
 print '</tr>';
 
 print '<tr align="center">';
 print '<td align="left">';
 print '<textarea name="info" rows="4" cols="70">';
 print $arr['info'] . '</textarea>';
 print '</td>';
 print '</tr>';
print '</table>';
 }
?>
