<?php
// ----------------------------------------------------------------------------------
// lista_fax
// $result e' il puntatore al dbase aperto
// $title e' il titolo della prima barra in alto
// $page_link e' la pagina da chiamare quando si clicca.
// ----------------------------------------------------------------------------------
function lista_fax($result,$title,$page_link)
{
// pagina da chiamare quando si clicca.
// magari da esportare nel prog. chiamante
// $page_link="modifica_fax.php";

// quanti articoli abbiamo?
$numero_elementi=pg_numrows($result);

// definizioni larghezza tabelle
// i bordi
$sizeb=1;

// quante colonne senza bordi
$colonne=7;

// le colonne
$size[0]=50;
$label[0]="Data";
$align[0]="LEFT";

$size[1]=50;
$label[1]="Ora";
$align[1]="LEFT";

$size[2]=150;
$label[2]="From";
$align[2]="LEFT";

$size[3]=50;
$label[3]="Pag.";
$align[3]="center";

$size[4]=50;
$label[4]="di";
$align[4]="center";

$size[5]=20;
$label[5]="Visualizza";
$align[5]="center";

$size[6]=20;
$label[6]="Salva";
$align[6]="center";

$size[7]=20;
$label[7]="Descrizione";
$align[7]="LEFT";

$size[8]=20;
$label[8]="Descrizione";
$align[8]="LEFT";

// stampo il risultato
if ($numero_elementi >= 1)
{
// stampo il risultato.
print '<TABLE cellspacing="0" cellpadding="1" border="0" width="100%">';
 
 // *** Prima righa di bordo ***
 print '<TR style="background : orange">';
  print '<TD align="center" colspan="'. ($colonne + 2) . '">&nbsp;</TD>';
 print '</TR>';
 
 // *** terza riga con le testate della tabella ***
 print '<TR style="background : green">';
  print "<TD width=\"$sizeb\" style=\"background : orange\">&nbsp;</TD>";
  for ($i=0; $i<$colonne; $i++)
  {
  print "<TD width=\"$size[$i]\" align=\"$align[$i]\">$label[$i]</TD>";
  };
  
  print "<TD width=\"$sizeb\" style=\"background : orange\">&nbsp;</TD>";
 print '</TR>';
 
 // *** Inizio la stampa della tabella ***    
 for ($indice=0; $indice<$numero_elementi; $indice++)
 {
 $elemento = pg_fetch_array ($result, $indice);
 
 if (($indice % 2) == 0)
 { $bgcolor=$_SESSION['d_bgcolor_even']; }
 else
 { $bgcolor=$_SESSION['d_bgcolor_odd']; };
 
 print "<TR style = \"background : $bgcolor \">";
  print "<TD width=\"$sizeb\" style=\"background : orange\">&nbsp;</TD>";
  
  $oid=$elemento["oid"];
  $label[0]=$elemento["data"];
  $label[1]=$elemento["ora"];
  $label[2]=$elemento["remote_id"];
  $label[3]=$elemento["pagina"];
  $label[4]=$elemento["pagine_totali"];
  $label[5]=$elemento["url"];
  $label[6]="Salva";
  
  for ($i=0; $i<$colonne; $i++)
  {
  switch ($i)
  {
  case 5:
  print "<TD width=\"$size[$i]\" align=\"$align[$i]\">";
  print "<A href=\"$label[$i]\">Visualizza</A></TD>";
  break;
  case 6:
  print "<TD width=\"$size[$i]\" align=\"$align[$i]\">";
  print "<A href=\"$page_link?oid=$oid\">$label[$i]</A></TD>";
  break;
  default:
  print "<TD width=\"$size[$i]\" align=\"$align[$i]\">";
  print "$label[$i]</TD>";
  };
  };
  
  print "<TD width=\"$sizeb\" style=\"background : orange\">&nbsp;</TD>";
 print '</TR>';
 }
 
 // *** stampo il bottom della tabella ***
 print '<TR style="background : orange">';
  print '<TD align="center" colspan="' . ($colonne + 2) . '">&nbsp;</TD>';
 print '</TR>';
 
print '</TABLE>';
}
}
?>
