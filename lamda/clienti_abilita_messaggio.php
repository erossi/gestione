<? if (file_exists('../default.php')) { include('../default.php'); } ?>
<? if (file_exists('./procedure/utility.php')) { include('./procedure/utility.php'); } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title>Gestione Web</title>
</head>
<body bgcolor="white" text="black" link="#000080" alink="#000080" vlink="#000080">

<font face="arial,helvetica,sans-serif" size="2">
<div align="left">
<br>

<?
    print_title("Abilitazione clienti");

    // spedizione messaggio
    mail($indirizzo, "Conferma registrazione utente", $messaggio, "From: registrazione@lamdainformatica.com");

    print '&nbsp;<img src="../icone/freccia.png" width="15" height="15" border="0" vspace="2" align="absmiddle"> Spedizione completata con successo.';

    print '<form action="clienti_elenca.php">';
    print '    <input type="hidden" name="tipo" value="r">';
    print '    <input type="submit" value="Ritorna all\'elenco utenti">';
    print '</form>';
?>

</body>
</html>
