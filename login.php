<?php
// variabili usate per la connessione al database pre_session
// solo la login.php dovrebbe chimarla

$db_host = "localhost";
$db_port = "5432";
$db_name = "tbg_1.1";
$db_user = "www-data";

// connessione al database
$conn_string="host=$db_host port=$db_port dbname=$db_name user=$db_user";
$conn=pg_connect($conn_string);
if (!$conn)
 {
 print "<br>Error open db!!!<br>";
 exit;
 };

// cancello l'articolo
$query="select count(*) from amministratori where
 codice='" . $username . "' and
 password='" . $password . "'";

// Un po' di debugging
//$DEBUG=1;
if ($DEBUG)
 {
 print 'Variabili in uso:<BR>';
 print '$query : ' . $query . '<BR>';
 };

$result = pg_exec ($conn,$query);
if (!$result)
 {
 print "<br>Error submitting query<br>";
 pg_close ($conn);
 exit;
 }

$arr = pg_fetch_array ($result,0);

if ($arr[0] > 0)
 {
 // sia lo username che la password vanno bene
session_start();

$query = "select * from setup";

$result = pg_exec ($conn,$query);
if (!$result)
 {
 print "<br>Error submitting query<br>";
 pg_close ($conn);
 exit;
 }

$numero_elementi=pg_numrows($result);

for ($i=0; $i<$numero_elementi; $i++)
 {
 $elemento = pg_fetch_array ($result, $i);
 $_SESSION[$elemento['nomevar']] = $elemento['valore'];
 // print $elemento['nomevar'] . " : " .$_SESSION[$elemento['nomevar']] . "<br>";
 }; // end for
 
// Variabili fisse del programma
$_SESSION['d_function_dir'] = $_SESSION['d_base_dir'] . "/function";
$_SESSION['d_stylesheet'] = $_SESSION['d_base_url'] . "/stylesheet.css";
$_SESSION['debug'] = false;

// variabili usate per la connessione al database
$_SESSION['d_db_host'] = "localhost";
$_SESSION['d_db_port'] = "5432";
$_SESSION['d_db_name'] = "tbg_1.1";
$_SESSION['d_db_user'] = "www-data";

// Magazzino
$_SESSION['d_magazzino_nome_file_esterno'] = "$default_dir_base/magazzino/listino.csv";

// Abilitazione utenti
$_SESSION['d_email_conferma_msg'] = "/tmp/email_msg.txt";

 }
else
 {
 // chiudo la connessione
 pg_close($conn);
 header ("Location: errore_401.html");    
 exit;
 }

// chiudo la connessione
pg_close($conn);

header("Location: index.php");
?>
