<?php
 if (file_exists("auth.php"))
  { include "auth.php"; }

 $utility = $_SESSION['d_function_dir'] . "/f_utility.php";
 $fcl = $_SESSION['d_function_dir'] . "/f_clienti_lista.php";

 if (file_exists("$utility"))
  { include "$utility"; }
 if (file_exists("$fcl"))
  { include "$fcl"; }
?>

 <BODY>
  <TABLE BGCOLOR="Black" CELLSPACING="0" CELLPADDING="0" BORDER="0" WIDTH="100%">
   <TR>
    
    <TD ALIGN="LEFT">
     <FONT style="color:white">
      Clienti->Elimina:
      &nbsp;
      <A HREF="clienti_index.php">
      Back</A>
      
     </FONT>
    </TD>
    
    <TD ALIGN="RIGHT"><FONT style="color:white">
      Created by <A HREF="http://www.tecnobrain.com" target="_top">Tecno
       <IMG SRC="../icone/logo_tecnobrain.gif" WIDTH="16" HEIGHT="18" BORDER="0" ALT="Tecno Brain" ALIGN="ABSMIDDLE">
      Brain</A>
    &nbsp;</FONT></TD>
   </TR>
  </TABLE>

<?php
// Un po' di debugging
$DEBUG=true;
if ($DEBUG)
 {
 print 'Variabili in uso:<BR>';
 print '$codice	: ' . $codice . '<BR>';
 };

// controllo i valori inseriti
if ($codice == '')
 {
 print '<b>Attenzione:</b> Errore di Codice!!!<br>';
 exit;
 };

// connessione al database
$conn=db_connect($db_host,$db_port,$db_name,$db_user);

// cancello l'articolo
$query="DELETE FROM clienti WHERE codice='" . $codice . "'";

// Un po' di debugging
if ($DEBUG)
 {
 print 'Variabili in uso:<BR>';
 print '$query : ' . $query . '<BR>';
 };

$result = pg_exec ($conn,$query);

// chiudo la connessione
db_close($conn);

?>

<ul>
<li>&nbsp;Cliente correttamente Eliminato.<br>
</ul>

</body>
</html>
