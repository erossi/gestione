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
<BODY>

<FONT FACE="ARIAL" SIZE="2">
<DIV ALIGN="LEFT">
<BR>
 &nbsp;:&nbsp;Carica archivio articoli da file esterno.
<BR>
<BR>
<BR>
<BR>
<H1> ATTENZIONE - ATTENZIONE - ATTENZIONE </H1>
<BR>
Premere CARICA per caricare il nuovo archivio, non verranno fatte
ulteriori richieste, una volta attivata la procedura NON pu&ograve
essere interrotta.
Il vecchio archivio verra' automaticamente eliminato.
<BR>
<BR>

<UL>
    <LI><A HREF="index.php">Annulla</A>
    <BR><BR>
    <LI><A HREF="articoli_carica_step2.php">Carica</A>
</UL>

</BODY>
</HTML>