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
      Clienti->Elenca->Bloccati:
      &nbsp;
      <A HREF="clienti_elenca_index.php">
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
//necessaria per la chiamata alla lista_clienti
$page_link="clienti_modifica.php";

// connessione al database
$conn=db_connect($db_host,$db_port,$db_name,$db_user);    

$query="SELECT * FROM clienti where status='n' order by ragsoc";
$result = db_execute($conn,$query);
    
// conto il numero di linee trovate (count ritorna sempre qualcosa).
$num_rows=pg_numrows($result);

if ($DEBUG) { print 'Total lines found: ' . $num_rows . '<br>'; };

print '<img src="../icone/freccia.png" width="15" height="15" border="0"';
print ' vspace="2" align="absmiddle">';
print 'Clienti trovati: ' . $num_rows .'<br>';

if ($num_rows > 0)
 {
 lista_clienti($result,$title,$page_link);
 }

// chiudo la connessione
db_close($conn);
?>
</div>
</body>
</html>
