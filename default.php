<?php
// inforazioni riguardanti la gestione web
$prog_name = "Gestione";
$prog_version = "0.4.1";

$default_dir_base = "/home/www/webtest/gestione/0.4.1";
$default_dir_function = "$default_dir_base/procedure";

// to not include default.php many times
$default_include = 1;

// debug
//$DEBUG = true;
$DEBUG = false;
    
// variabili usate per la connessione al database della lamda
$db_host = "localhost";
$db_port = "5432";
$db_name = "tbg_1.0";
$d_dbfax_name = "fax01";
$db_user = "www-data";
    
// numero massimo di righe per ogni tabella stampata
// (in pratica ogni tabella viene raggruppata in sottotabelle con tante righe
// quante sono indicate sotto).
$max_table_rows = 500;

// Ricarico di vendita sul prezzo di acquisto in %
$ricarico_vendita = 10;
$ricarico_vendita1 = 10;
$ricarico_vendita2 = 20;
$ricarico_vendita3 = 30;
$ricarico_vendita4 = 50;

// Colori
$color_list_even="#e0e0e0";
$d_bgcolor_even="#e0e0e0";
$color_list_odd="white";
$d_bgcolor_odd="white";


// il comando per generare la password
$password_generator_command = "/usr/bin/pwgen 8";

// Email listini
$default_from = "listini@gestione.net";
$default_to = "clienti@gestione.net";
$default_subject = "Listino gestione";
$default_filetext = "/home/www/webtest/gestione/varie/email_listino.txt";
$d_listino_1 = "/home/www/webtest/gestione/varie/stock.pdf";
$d_listino_2 = "/home/www/webtest/gestione/varie/vip.pdf";

// Magazzino
$magazzino_nome_file_esterno="/home/www/webtest/gestione/varie/listino.csv";

// abilitazione clienti
 $d_conferma_subj = "Conferma registrazione utente";
 $d_conferma_msg = "\n" .
  "Siamo lieti di informarLa che la Sua richiesta di inserimento\n" .
  "come utente registrato e' stata accettata. Da questo\n" .
  "momento Lei porta' accedere ai nostri listini inserendo\n" .
  "i dati allegati\n\n" .
  "Cordialmente,\n" .
  "   Lamda Informatica s.r.l.";

 $d_conferma_from = "registrazione@tecnobrain.com";
     
?>
