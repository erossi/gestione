<?php
 if (file_exists("default.php"))
  { include "default.php"; }
 if (file_exists("$default_dir_function/utility.php"))
  { include "$default_dir_function/utility.php"; }
 if (file_exists("$default_dir_function/f_fatture_lista.php"))
  { include "$default_dir_function/f_fatture_lista.php"; }
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
      Contabilita' -> Fatture -> Elenca:
      &nbsp;
      <A HREF="fatture.html">
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
$page_link="fatture_modifica.php";

// connessione al database
$conn=db_connect($db_host,$db_port,$db_name,$db_user);

$query="SELECT numero,
 to_char(data_fattura,'DD Mon YYYY') as dataf,
 to_char(data_scadenza_pagamento,'DD Mon YYYY') as datasc,
 to_char(data_pagamento,'DD Mon YYYY') as datapg,
 tipo_pagamento, imponibile, iva, totale, cliente
 FROM fatture_vendita order by numero";
$result = db_execute($conn,$query);
    
// conto il numero di linee trovate (count ritorna sempre qualcosa).
$num_rows=pg_numrows($result);

if ($DEBUG) { print 'Total lines found: ' . $num_rows . '<br>'; };

print '<img src="../icone/freccia.png" width="15" height="15" border="0"';
print ' vspace="2" align="absmiddle">';
print "Fatture trovate: $num_rows <br>";

if ($num_rows > 0)
 {
 lista_fatture($result,$title,$page_link);
 }

// chiudo la connessione
db_close($conn);
?>
</div>
</body>
</html>
