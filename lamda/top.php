<?
    if (file_exists('default.php')) {
        include 'default.php';
    }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
    <TITLE><? print $programma_nome ?></TITLE>
</HEAD>
<BODY BGCOLOR="#000080" TEXT="White" LINK="White" ALINK="White" VLINK="White">

<TABLE ALIGN="center" WIDTH="100%" CELLSPACING="10" CELLPADDING="0" BORDER="0">
<TR>
    <TD WIDTH="50%" ALIGN="Left" NOWRAP>
	<FONT FACE="ARIAL" SIZE="3">
        <U><B><? print $programma_nome ?></B></U>
        </FONT>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <FONT FACE="ARIAL" SIZE="2">
        <A HREF="main.php" TARGET="content"><B>Top</B></A>
        </FONT>
    </TD>
    <TD WIDTH="50%" ALIGN="Right" NOWRAP>
        <FONT FACE="ARIAL" SIZE="3">
        <U><B>Versione&nbsp;<? print $programma_versione ?></B></U>
        </FONT>
    </TD>
</TR>
</TABLE>


</BODY>
</HTML>