<?php
if (file_exists("auth.php"))
{ include "auth.php"; }
?>

<BODY TEXT="Black" BGCOLOR="Black">
 
 <TABLE BGCOLOR="Black" CELLSPACING="0" CELLPADDING="0" BORDER="0" WIDTH="100%">
  
  <TR>
   <TD ALIGN="LEFT"  VALIGN="BOTTOM">
    <FONT STYLE="color: White">
     <A HREF="index.php" TARGET="_TOP">
      <IMG SRC="icone/ico_home.gif" WIDTH="21" HEIGHT="20" BORDER="0"
     ALT="Home Page"></A>
   </FONT></TD>
   
   <TD ALIGN="LEFT"  VALIGN="BOTTOM">
    <FONT STYLE="color: White">
     &nbsp;[
     <A HREF="contabilita/contabilia_index.php" TARGET="main">
     Contabilita'</A>
     ][
     <A HREF="magazzino/magazzino_index.php" TARGET="main">
     Magazzino</A>
     ][
     <A HREF="clienti/clienti_index.php" TARGET="main">
     Clienti</A>
     ][
     <A HREF="extern/extern_index.php" TARGET="main">
     Esterno</A>
     ][
     <A HREF="fax/fax_index.php" TARGET="main">
     Fax</A>
     ]&nbsp;
     <A HREF="logout.php" TARGET="_top">
     Logout</A>
     &nbsp;
   </FONT></TD>
   
   <TD ALIGN="RIGHT" VALIGN="BOTTOM">
    <FONT STYLE="color: White">
     <?PHP
     print $_SESSION['d_prog_name'];
     print "&nbsp;";
     print '<IMG SRC="icone/logo_tecnobrain.gif" WIDTH="16" HEIGHT="18"';
     print 'BORDER="0" ALT="Tecno Brain" ALIGN="ABSMIDDLE">&nbsp;';
     print "&nbsp;";
     print $_SESSION['d_prog_version'];
     ?>
    </FONT>
   </TD>
  </TR>
 </TABLE>
 
</BODY>
</HTML>
