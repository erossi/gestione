<?php
if (file_exists('../default.php'))
 { include '../default.php'; }

if (file_exists('../procedure/utility.php'))
 { include '../procedure/utility.php'; }

// connessione al database
$conn=db_connect($db_host,$db_port,$db_name,$db_user);

// cancello l'articolo
$query="select count(*) from clienti where
 codice='" . $username . "' and
 password='" . $password . "' and status='a'";

// Un po' di debugging
//$DEBUG=1;
if ($DEBUG)
 {
 print 'Variabili in uso:<BR>';
 print '$query : ' . $query . '<BR>';
 };

$result = db_execute ($conn,$query);
$arr = pg_fetch_array ($result,0);

// Se e' ok aggiorno l'accesso

if ($arr[0] > 0)
 {
 $query="update accessi set data='now' where codice='" . $username . "'";
 $result = db_execute ($conn,$query);

 if ($DEBUG)
  {
  print 'Variabili in uso:<BR>';
  print '$query : ' . $query . '<BR>';
  };
 };

// chiudo la connessione
db_close($conn);

if ($arr[0] > 0)
 {
 // sia lo username che la password vanno bene
 setcookie("gestione04_pw",$username,time()+3000,"","");
 }
else
 {
 header ("Location: errore_401.html");    
 exit;
 }

header("Location: index.php");
?>
