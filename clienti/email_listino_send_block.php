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

  for ($listino=1;$listino<3;$listino++)
  {
// query test
// $query = "SELECT email,listino FROM clienti where ragsoc='tecno brain di rossi enrico'";

  $query = "SELECT email,listino FROM clienti WHERE status='a'
	    and email_listino=TRUE and listino=$listino
	    order by ragsoc";
  $result = db_execute($conn,$query);
// conto il numero di linee trovate (count ritorna sempre qualcosa).
  $num_rows=pg_numrows($result);
  
  print '<img src="../icone/freccia.png" width="15" height="15" border="0"';
  print ' vspace="2" align="absmiddle">';
  print "Clienti trovati listino $listino: $num_rows<BR>";
  
  // spedisco il risultato
  
  $indice=0;
  $max_bcc=50;
  switch ($listino)
  {
  case  "1": $filetoemail=$d_listino_1; break;
  case  "2": $filetoemail=$d_listino_2; break;
  default: $arr["email"]=""; break;
  }
	      
  while ($indice<$num_rows)
   {
   // cancello il campo bcc
   $bcc="";
   $i=0;
  
   while (($i<$max_bcc) and ($indice<$num_rows))
    {
    $arr = pg_fetch_array ($result, $indice);
    $email = $arr["email"];
    
    if ($email)
     {
     $bcc = $bcc . " " . $email;
     }
      
    $i++;
    $indice++;
//    print "$indice,$i bcc: $bcc <br>";
    print "$indice,$i bcc: $email <br>";
    }
  
//  print "<br> $indice: $mail_to file: $filetoemail <br>";
  
  $email_command="/usr/bin/mime-construct" .
  " --header \"From: $default_from\"" .
  //" --header \"To: $default_to\"" .
  " --bcc \"$bcc\"" .
  " --subject \"$default_subject\"" .
  " --file $default_filetext" .
  " --attachment listino.pdf" .
  " --type application/pdf" .
  " --file $filetoemail";
  
//  print "<br> $email_command <BR>";
  
  $risultato=exec ($email_command);
  flush ();
  } // end while

  } // end for
    
  print "<br> ******* Fine *******<br>";
  
  // chiudo la connessione
  db_close ($conn);
  ?>
  
 </BODY>
</HTML>
