<?php if (file_exists('default.php')) { include 'default.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<LINK REL="STYLESHEET" HREF="stylesheet.css">
</HEAD>

<BODY TEXT="Black" BGCOLOR="Black" LINK="#CC9966" ALINK="#CC9966" 
 VLINK="#CC9966">

<TABLE BGCOLOR="Black" CELLSPACING="0" CELLPADDING="0"
 BORDER="0" WIDTH="100%">

 <TR>
 
  <TD ALIGN="LEFT"  VALIGN="BOTTOM">
  <FONT STYLE="color: White">
  <A HREF="contents.html" TARGET="contents">
  <IMG SRC="icone/ico_home.gif" WIDTH="21" HEIGHT="20" BORDER="0"
  ALT="Go to Home Page"></a>
  </FONT></TD>

<TD ALIGN="LEFT"  VALIGN="BOTTOM">
<FONT STYLE="color: White">
&nbsp;Go to section:

<A HREF="contabilita/index.html" TARGET="contents">
Contabilita'</A>&nbsp;:&nbsp;

<A HREF="magazzino/index.html" TARGET="contents">
Magazzino</A>&nbsp;:&nbsp;

<A HREF="clienti/index.html" TARGET="contents">
Clienti</A>&nbsp;:&nbsp;

<A HREF="extern/index.php" TARGET="contents">
Esterno</A>&nbsp;&nbsp;

</FONT></TD>

 <TD ALIGN="RIGHT" VALIGN="BOTTOM">
 <FONT STYLE="color: White">
 <?php print $prog_name . ' v. ' . $prog_version; ?>&nbsp;
 <IMG SRC="icone/logo_tecnobrain.gif" WIDTH="16" HEIGHT="18"
  BORDER="0" ALT="Tecno Brain" ALIGN="ABSMIDDLE">
 </A>&nbsp;
  </FONT>
  </TD>
 </TR>
</TABLE>

</BODY>
</HTML>
