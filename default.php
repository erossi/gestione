<?php
    // inforazioni riguardanti la gestione web
    $prog_name = "Contabilita'";
    $prog_version = "0.2";
    
    // debug
//    $DEBUG = true;
    $DEBUG = false;
    
    // variabili usate per la connessione al database della lamda
    $db_host = "localhost";
    $db_port = "5432";
    $db_name = "contabilita";
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
    $color_list_odd="white";
    
?>
