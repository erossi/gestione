<?php
 if (file_exists("../default.php"))
  { include "../default.php"; }
 if (file_exists("$default_dir_function/utility.php"))
  { include "$default_dir_function/utility.php"; }
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
$conn=db_connect($db_host,$db_port,$db_name,$db_user);

$query = "delete from articoli";
$result = db_execute($conn,$query);

// Versione senza le disponibilita'!
// Campi in ordine di lettura
// 0 codice articolo (art_cod)
// 1 descrizione 1 (art_des_1)
// 2 descrizione 2 (art_des_2)
// 3 Quantita (ard_esi_att_q_a)
// 4 prezzo 1 (art_lis_1)
// 5 prezzo 2 (art_lis_2)
// 6 categoria (art_gru_acq)

$row = 1;
$handle = fopen ($magazzino_nome_file_esterno,"r");
// salto la prima linea
$data = fgetcsv ($handle, 1000, ";");

while ($data = fgetcsv ($handle, 1000, ";"))
 {
 $num = count ($data);
 print "<p> $num fields in line $row: <br>\n";
 $row++;

// prendo le prime 2 lettere del codice
// $initcode=substr($data[0],0,2);
 $initcode=$data[6];
 
 for ($c=0; $c < $num; $c++)
  {
  // trim elimina gli spazi pre e post.
  $data[$c] = trim($data[$c]);

  // stronco le qta in base alle categorie
  if ($c == 3)
   {
   switch ($initcode)
    {
    // max 10
    case "36":
     if ($data[$c]>10)
      {
      $data[$c]=10;
      print "<br> SOSTITUZIONE QUANTITA <br>";
      }
     break;
    
    // max 30
    case "11":
    case "13":
    case "18":
    case "22":
     if ($data[$c]>30)
      {
      $data[$c]=30;
      print "<br> SOSTITUZIONE QUANTITA <br>";
      }
     break;

    // max 1000
    case "16":
     if ($data[$c]>1000)
      {
      $data[$c]=1000;
      print "<br> SOSTITUZIONE QUANTITA <br>";
      }
     break;
    
    // default 100
    default: if ($data[$c]>100) { $data[$c]=100; };
    }   
   }

  if (($c == 4) || ($c == 5))
   {
   print "cambio numerico da " . $data[$c] . " a ";
   $data[$c] = strtr ($data[$c],",",".");
   print $data[$c] . "<br>";
   }
  else
   { print $data[$c] . "<br>"; };
   
  } //end for
  
 $query = "Insert into articoli
  (\"codice_cat\",\"codice_art\",\"descrizione\",\"descrizione2\",
  \"quantita\",\"prezzo_acq\",\"prezzo_ven1\",\"prezzo_ven2\",\"prezzo_ven3\",
  \"prezzo_ven4\",\"data_ultimo_acq\",\"info\",\"image\")
  values ('" . $data[6] . "',
  '" . $data[0] . "',
  '" . $data[1] . "',
  '" . $data[2] . "',
  '" . $data[3] . "',
  '0',
  '" . $data[4] . "',
  '" . $data[5] . "',
  '0',
  '0',
  NULL,
  NULL,
  NULL)";
 
 print "query: $query <br>";  
 $result = db_execute($conn,$query);
 }

fclose ($handle);
db_close($conn);
  ?>
  
 </BODY>
</HTML>
