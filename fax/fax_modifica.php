<?php
 if (file_exists("auth.php"))
  { include "auth.php"; }
  
 $utility = $_SESSION['d_function_dir'] . "/f_utility.php";
 $f_fax_lista_cartelle = $_SESSION['d_function_dir'] . "/f_fax_lista_cartelle.php";
 
 if (file_exists("$utility"))
  { include "$utility"; }
 if (file_exists("$f_fax_lista_cartelle"))
  { include "$f_fax_lista_cartelle"; }
?>

<body>
  <TABLE BGCOLOR="Black" CELLSPACING="0" CELLPADDING="0" BORDER="0" WIDTH="100%">
   <TR>
    
    <TD ALIGN="LEFT">
     <FONT style="color:white">
      Fax -> Nuovi -> Archivia:
      &nbsp;
      <A HREF="fax_index.php">
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
<tr>
<td valign="top">

<?php
// connessione al database
$conn=db_connect();

$query="SELECT *,oid FROM fax where oid=$oid";
$result = db_execute($conn,$query);
$elemento = pg_fetch_array($result,0);

print "<br>";
print "Data: " . $elemento['data_arrivo'] . "<br>";
print "Ora: " . $elemento['ora_arrivo'] . "<br>";
print "Da: " . $elemento['remote_id'] . "<br>";
print "Pagina: " . $elemento['pagina'] . "<br>";
print "Pagine Totali: " . $elemento['pagine_totali'] . "<br>";
print "Note: " . $elemento['note'] . "<br>";
print "<center>";
print '<br><a href="' . $elemento['url'] . '"> [Visualizza Fax] </a>';
print "</center><br><br>";

print '<form action="fax_salva_commit.php" method="post">';
print "<br>Digitare il codice della cartella dove salvare il fax.<br>";
print "<br>";
print '<input type="text" name="cartella" maxlenght="50" size="10" align="absmiddle">';
print '<input type="hidden" name="oid" value="' . $oid . '">';
print "<br><br><br>";
print '<input type="submit" value="salva">';
print "</form>";
print "</td>";

// parte dx cartelle

print '<td valign="top">';
$query="SELECT * FROM cartelle order by descrizione";
$result = db_execute($conn,$query);

// conto il numero di linee trovate (count ritorna sempre qualcosa).
$num_rows=pg_numrows($result);

if ($DEBUG) { print 'Total lines found: ' . $num_rows . '<br>'; };

print '<img src="../icone/freccia.png" width="15" height="15" border="0"';
print ' vspace="2" align="absmiddle">';
print "Cartelle trovate: $num_rows <br>";

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
