<?php
 if (file_exists("auth.php"))
  { include "auth.php"; }
?>

<body text="black" bgcolor="white">

<center>
  <TABLE BGCOLOR="Black" CELLSPACING="0" CELLPADDING="0" BORDER="0" WIDTH="100%">
   <TR>
    
    <TD ALIGN="LEFT">
     <FONT style="color:white">
      --- Main ---
     </FONT>
    </TD>
    
    <TD ALIGN="RIGHT"><FONT style="color:white">
      Created by <A HREF="http://www.tecnobrain.com" target="_top">Tecno
       <IMG SRC="icone/logo_tecnobrain.gif" WIDTH="16" HEIGHT="18" BORDER="0" ALT="Tecno Brain" ALIGN="ABSMIDDLE">
      Brain</A>
    &nbsp;</FONT></TD>
   </TR>
  </TABLE>
<table cellspacing="20" cellpadding="0" border="0">

<tr>
<td align="center" valign="bottom">
<IMG SRC="icone/logo_solo_anim.gif"
 WIDTH="90" HEIGHT="100" BORDER="0" ALT="TecnoBrain">
</td>
</tr>

<tr>
    <td align="center">
    <H1>Gestione (Rel.&nbsp;
    <?php print $_SESSION['d_prog_version']; ?>
    )</h1>
    </td>
</tr>

<tr>
    <td align="center">
    This program is copyright under the <a href="COPYING">Gnu Public License</a>.
    </td>
</tr>
</table>
</center>

</body>
</html>
