<?php
// ----------------------------------------------------------------------------------
// aggiusta_prezzi
// controlla i prezzi di acquisto e vendita e li calcola
// $arr e' l'articolo
// ----------------------------------------------------------------------------------

function aggiusta_prezzi(&$prezzo_acq,&$prezzo_ven1,&$prezzo_ven2,
 &$prezzo_ven3,&$prezzo_ven4)
 {

// Carico i valori di ricarico di default
if (file_exists('../../default.php'))
 { include '../../default.php'; }

// Un po' di debugging
//$DEBUG=true;
if ($DEBUG)
 {
 print 'Variabili in uso prima nella function aggiusta_prezzi:<BR>';
 print '$prezzo_acq	: ' . $prezzo_acq . '<BR>';
 print '$prezzo_ven1	: ' . $prezzo_ven1 . '<BR>';
 print '$prezzo_ven2	: ' . $prezzo_ven2 . '<BR>';
 print '$prezzo_ven3	: ' . $prezzo_ven3 . '<BR>';
 print '$prezzo_ven4	: ' . $prezzo_ven4 . '<BR>';
 };

// aggiusto i prezzi di vendita
if (! $prezzo_acq)
 { $prezzo_acq = 0; };

if (! $prezzo_ven1)
 {
 $temp = $prezzo_acq * $ricarico_vendita1 / 100;

 if ($DEBUG)
  {
  print '<br> Prezzo 1: ' . $prezzo_ven1;
  print '<br> Acquisto : ' . $prezzo_acq;
  print '<br> Ricarico 1: ' . $ricarico_vendita1;
  print '<br> Totale 1: ' . $temp;
  };

 $prezzo_ven1 = bcadd($prezzo_acq,$temp,2);
 };

if (! $prezzo_ven2)
 {
 $temp = $prezzo_acq * $ricarico_vendita2 / 100;

 if ($DEBUG)
  {
  print '<br> Prezzo 2: ' . $prezzo_ven2;
  print '<br> Acquisto : ' . $prezzo_acq;
  print '<br> Ricarico 2: ' . $ricarico_vendita2;
  print '<br> Totale 2: ' . $temp;
  };

 $prezzo_ven2 = bcadd($prezzo_acq,$temp,2);
 };

if (! $prezzo_ven3)
 {
 $temp = $prezzo_acq * $ricarico_vendita3 / 100;

 if ($DEBUG)
  {
  print '<br> Prezzo 3: ' . $prezzo_ven3;
  print '<br> Acquisto : ' . $prezzo_acq;
  print '<br> Ricarico 3: ' . $ricarico_vendita3;
  print '<br> Totale 3: ' . $temp;
  };

 $prezzo_ven3 = bcadd($prezzo_acq,$temp,2);
 };

if (! $prezzo_ven4)
 {
 $temp = $prezzo_acq * $ricarico_vendita4 / 100;

 if ($DEBUG)
  {
  print '<br> Prezzo 4: ' . $prezzo_ven4;
  print '<br> Acquisto : ' . $prezzo_acq;
  print '<br> Ricarico 4: ' . $ricarico_vendita4;
  print '<br> Totale 4: ' . $temp;
  };

 $prezzo_ven4 = bcadd($prezzo_acq,$temp,2);
 };

if ($DEBUG)
 {
 print '<br>Variabili in uso dopo nella function aggiusta_prezzi:<BR>';
 print '$prezzo_acq	: ' . $prezzo_acq . '<BR>';
 print '$prezzo_ven1	: ' . $prezzo_ven1 . '<BR>';
 print '$prezzo_ven2	: ' . $prezzo_ven2 . '<BR>';
 print '$prezzo_ven3	: ' . $prezzo_ven3 . '<BR>';
 print '$prezzo_ven4	: ' . $prezzo_ven4 . '<BR>';
 };

 }
?>
