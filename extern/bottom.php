<?php if (file_exists('../procedure/auth.php'))
 { include '../procedure/auth.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<LINK REL="STYLESHEET" HREF="../stylesheet.css">
</HEAD>
<BODY bgcolor="black">

<TABLE CELLSPACING="0" CELLPADDING="0" BORDER="0" WIDTH="100%">
<TR>

<TD ALIGN="LEFT">
<FONT STYLE="color: White">
&nbsp;Esterno: (

<?php
print $gestione04_pw;
?>

) :

<A HREF="elenca_articoli.php" TARGET="main">
Listino</A>&nbsp;:&nbsp;

<A HREF="logout.php" TARGET="contents">
Esci</A>
</font>
</TD>

<TD ALIGN="RIGHT">
<FONT STYLE="color: White">
Created by <A HREF="http://www.tecnobrain.com" target="_top">Tecno
<IMG SRC="../icone/logo_tecnobrain.gif" WIDTH="16" HEIGHT="18" BORDER="0" ALT="Tecno Brain" ALIGN="ABSMIDDLE">
Brain</a>
&nbsp;</FONT></TD>
</TR>
</TABLE>
</BODY>
</HTML>
