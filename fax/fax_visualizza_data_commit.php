<?php
 if (file_exists("auth.php"))
  { include "auth.php"; }
  
 $utility = $_SESSION['d_function_dir'] . "/f_utility.php";
 $f_fax_lista = $_SESSION['d_function_dir'] . "/f_fax_lista.php";
 
 if (file_exists("$utility"))
  { include "$utility"; }
 if (file_exists("$f_fax_lista"))
  { include "$f_fax_lista"; }
?>

<body>
  <TABLE BGCOLOR="Black" CELLSPACING="0" CELLPADDING="0" BORDER="0" WIDTH="100%">
   <TR>
    
    <TD ALIGN="LEFT">
     <FONT style="color:white">
      Fax -> Visualizza -> Per data:
      &nbsp;
      <A HREF="fax_visualizza_index.php">
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

<TABLE CELLSPACING="0" CELLPADDING="0" BORDER="0" WIDTH="100%">
<tr><td>

<?php
// connessione al database
$conn=db_connect();

//necessaria per la chiamata alla lista_clienti
$page_link="fax_modifica.php";

// connessione al database
$conn=db_connect();

$data_arrivo=$giorno . "/" . $mese . "/" . $anno;

$query="SELECT oid,to_char(data_arrivo,'DD Mon YYYY') as data,
 to_char(ora_arrivo,'HH24:MI:SS') as ora,
 remote_id,pagina,pagine_totali,url
 FROM fax where data_arrivo='" . $data_arrivo . "' order by data_arrivo,ora_arrivo";

$result = db_execute($conn,$query);
    
// conto il numero di linee trovate (count ritorna sempre qualcosa).
$num_rows=pg_numrows($result);

if ($DEBUG) { print 'Total lines found: ' . $num_rows . '<br>'; };

print '<img src="../icone/freccia.png" width="15" height="15" border="0"';
print ' vspace="2" align="absmiddle">';
print "Data: $data_arrivo<br>";

print '<img src="../icone/freccia.png" width="15" height="15" border="0"';
print ' vspace="2" align="absmiddle">';
print 'Fax trovati: ' . $num_rows .'<br>';

if ($num_rows > 0)
 {
 lista_fax($result,$title,$page_link);
 }

// chiudo la connessione
db_close($conn);

?>

</td>
</tr>
</table>
</body>
</html>
