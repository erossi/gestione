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

<FONT FACE="ARIAL" SIZE="2">
<DIV ALIGN="LEFT">
<BR>
&nbsp;<IMG SRC="../icons/logo-lamda.png" WIDTH="87" HEIGHT="35"
 BORDER="0" ALIGN="ABSMIDDLE" ALT="Lamda Informatica">
 &nbsp;:&nbsp;Spedizione Listini via Email
<BR>
<BR>
<BR>
<BR>
<H1> ATTENZIONE - ATTENZIONE - ATTENZIONE </H1>
<BR>
Premere spedizione per spedire i listini, non verranno fatte ulteriori richieste,
una volta attivata la procedura NON pu&ograve essere interrotta.
<BR>
<BR>

<UL>
    <LI><A HREF="index.php">Annulla</A>
    <BR><BR>
    <LI><A HREF="clienti_email_send.php">Spedisci</A>
</UL>

</BODY>
</HTML>