<?php
if (file_exists('../default.php'))
{ include '../default.php'; };
if (file_exists('../procedure/utility.php'))
{ include '../procedure/utility.php'; };
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
  <TITLE><?PHP print $prog_name ?></TITLE>
  <LINK rel="stylesheet" href="../stylesheet.css">
 </HEAD>
 <BODY>
  
<?php
$row = 1;
$handle = fopen ($magazzino_nome_file_esterno,"r");

while ($data = fgetcsv ($handle, 1000, ";"))
 {
 $num = count ($data);
 print "<p> $num fields in line $row: <br>\n";
 $row++;

 for ($c=0; $c < $num; $c++)
  {
  print $data[$c] . "<br>\n";
  }
 }

fclose ($handle);

  ?>
  
 </BODY>
</HTML>
