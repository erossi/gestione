<?
    if (file_exists('../default.php')) {
        include '../default.php';
    }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
    <TITLE><? print $nome_programma ?></TITLE>
</HEAD>
<BODY BGCOLOR="White" TEXT="Black" LINK="Orange" ALINK="Orange" VLINK="Orange">

<FONT FACE="Arial,Helvetica" SIZE="2">
<DIV ALIGN="LEFT">
<BR>
&nbsp;<A HREF="index.php"><IMG SRC="../icons/logo-lamda.png" WIDTH="87" HEIGHT="35" BORDER="0" ALIGN="ABSMIDDLE" ALT="Lamda Informatica"></A>&nbsp;:&nbsp;
<?
    // stampa il titolo
    switch ($tipo) {
        case  "r": print 'Clienti in attesa di registrazione'; break;
        case  "a": print 'Clienti gi&agrave; attivati'; break;
	default: print '(Tipo sconosciuto ' . $tipo . ')'; break;
    }

    // connessione al database
    $connection_string = "";
    if ($db_lamda_host != "") {
        $connection_string = "host=" . $db_lamda_host;
    }
    if ($db_lamda_porta != "") {
        $connection_string = $connection_string . " port=" . $db_lamda_porta;
    }
    if ($db_lamda_nome != "") {
        $connection_string = $connection_string . " dbname=" . $db_lamda_nome;
    }
    if ($db_lamda_utente != "") {
        $connection_string = $connection_string . " user=" . $db_lamda_utente;
    }
    $conn = pg_connect($connection_string);
    if (!$conn) {
        echo "Errore durante l'accesso al database.<BR>" .
             "Stringa di connessione: <B>" . $connection_string . "</B><BR>" . 
             "File: <B>clienti_email</B><BR>";
        exit;
    }

    // inizializzo la query
    $query="SELECT email,listino,email_listino FROM clienti WHERE status='a'";
    // eseguo la query
    $result = pg_Exec ($conn, $query );
    if (!$result) {
        echo "Errore durante l'esecuzione della query.<BR>" .
             "Query: <B>" . $query . "</B><BR>" .
             "File: <B>clienti_email</B><BR>";
        exit;
    }

    // leggo il numero di righe risultanti
    $numero_clienti=pg_numrows($result);

    // spedisco il risultato

    for ($indice=0; $indice<$numero_clienti; $indice++)
     {
     $arr = pg_fetch_array ($result, $indice);

     switch ($arr["listino"])
      {
      case  "1": $filetoemail="../listini/securestock/stock.pdf"; break;
      case  "2": $filetoemail="../listini/securevip/vip.pdf"; break;
      default: $arr["email"]=""; break;
      }

     if ($arr["email"] && ($arr["email_listino"]=='t'))
      {
      print '<BR>Email da spedire a :'. $arr["email"] . ' file :' . $filetoemail;

      $email_command='/usr/bin/mime-construct --to "' . $arr["email"] .
      '" --subject "Listino Lamda Informatica s.r.l." --file email_listino.txt --type application/PDF --file ' . 
      $filetoemail . '&';

      $risultato=exec ($email_command);
//      print '<BR>Risultato : ' . $risultato;
      }

     }

    // chiudo la connessione
    pg_close ($conn);
?>

</BODY>
</HTML>
