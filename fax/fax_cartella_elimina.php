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
      Fax -> Cartelle -> Elimina cartella:
      &nbsp;
      <A HREF="fax_cartella_index.php">
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
<form action="fax_cartella_elimina.php" method="post">
<br>
Inserire la descrizione della cartella da eliminare.<br>
<br>
<input type="text" name="descrizione" maxlenght="50" size="30" align="absmiddle">
<br>
<br>
<br>
<input type="submit" value="elimina">
</form>
</td>

<td>

<?php
// connessione al database
$conn=db_connect();

if (strlen($descrizione) >2 )
 {
 $descrizione = strtolower($descrizione);
 $query="delete from cartelle where descrizione='$descrizione' and quantita = 0";
 $result = db_execute($conn,$query);
 };

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
