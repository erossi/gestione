<?php
 if (file_exists("default.php"))
  { include "default.php"; }
 if (file_exists("$default_dir_function/utility.php"))
  { include "$default_dir_function/utility.php"; }
 if (file_exists("$default_dir_function/f_fax_lista.php"))
  { include "$default_dir_function/f_fax_lista.php"; }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><?php print $prog_name ?></title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
  <TABLE BGCOLOR="Black" CELLSPACING="0" CELLPADDING="0" BORDER="0" WIDTH="100%">
   <TR>
    
    <TD ALIGN="LEFT">
     <FONT style="color:white">
      Fax -> Cartelle -> Nuova cartella:
      &nbsp;
      <A HREF="fax_cartella_index.html">
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
<form action="fax_cartella_nuova_commit.php" method="post">
<br>
Inserire la descrizione della nuova cartella.<br>
<br>
<input type="text" name="descrizione" maxlenght="50" size="30" align="absmiddle">
<br>
<br>
<br>
<input type="submit" value="inserisci">
</form>
</td>

<td>

<?php
// connessione al database
$conn=db_connect($db_host,$db_port,$d_dbfax_name,$db_user);

$query="SELECT descrizione FROM cartelle order by descrizione";
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
