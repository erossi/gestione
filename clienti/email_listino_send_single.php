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
  // connessione al database
  $conn = db_connect($db_host,$db_port,$db_name,$db_user);
// query test
// $query = "SELECT email,listino FROM clienti where ragsoc='tecno brain di rossi enrico'";
  $query = "SELECT email,listino FROM clienti WHERE status='a' and email_listino=TRUE order by ragsoc";
  $result = db_execute($conn,$query);
  
  // conto il numero di linee trovate (count ritorna sempre qualcosa).
  $num_rows=pg_numrows($result);
  
  //$numero_clienti=pg_numrows($result);
  
  print '<img src="../icone/freccia.png" width="15" height="15" border="0"';
  print ' vspace="2" align="absmiddle">';
  print 'Clienti trovati: ' . $num_rows .'<BR>';
  
  // spedisco il risultato
  
  for ($indice=0; $indice<$num_rows; $indice++)
  {
  $arr = pg_fetch_array ($result, $indice);
  
  switch ($arr["listino"])
  {
  case  "1": $filetoemail=$d_listino_1; break;
  case  "2": $filetoemail=$d_listino_2; break;
  default: $arr["email"]=""; break;
  }
  
  if ($arr["email"])
  {
  $mail_to = $arr["email"];
  
  print "$indice: $mail_to file: $filetoemail <br>";
  
  $email_command="/usr/bin/mime-construct" .
  " --header \"From: $default_from\"" .
  //" --header \"To: $default_to\"" .
  " --bcc \"$mail_to\"" .
  " --subject \"$default_subject\"" .
  " --file $default_filetext" .
  " --attachment listino.pdf" .
  " --type application/pdf" .
  " --file $filetoemail";
  
//  print "$email_command <BR>";
  
  $risultato=exec ($email_command);
  flush ();
  // print "Risultato : $risultato <br>";
  } //end if
  
  } //end for
  
  print "<br><br> ******* Fine *******<br>";
  
  // chiudo la connessione
  db_close ($conn);
  ?>
  
 </BODY>
</HTML>
