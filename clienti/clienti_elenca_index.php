<?php
 if (file_exists("auth.php"))
  { include "auth.php"; }
?>
 
 <BODY>
  <TABLE BGCOLOR="Black" CELLSPACING="0" CELLPADDING="0" BORDER="0" WIDTH="100%">
   <TR>
    
    <TD ALIGN="LEFT">
     <FONT style="color:white">
      Clienti->Elenca:
      &nbsp;
      <A HREF="clienti_elenca_tutti.php">
      Tutti</A>
      &nbsp;:&nbsp;
      <A HREF="clienti_elenca_attesa.php">
      In attesa</A>
      &nbsp;:&nbsp;
      <A HREF="clienti_elenca_attivi.php">
      Attivi</A>
      &nbsp;:&nbsp;
      <A HREF="clienti_elenca_bloccati.php">
      Bloccati</A>
      &nbsp;:&nbsp;
      <A HREF="clienti_index.php">
      Back</A>
      
     </FONT>
    </TD>
    
    <TD ALIGN="RIGHT"><FONT style="color:white">
      Created by <A HREF="http://www.tecnobrain.com" target="_top">Tecno
       <IMG SRC="../icone/logo_tecnobrain.gif" WIDTH="16" HEIGHT="18" BORDER="0" ALT="Tecno Brain" ALIGN="ABSMIDDLE">
      Brain</A>
    &nbsp;</FONT></TD>
   </TR>
  </TABLE>
  
  <CENTER>
   <TABLE cellspacing="20" cellpadding="0" border="0">
    
    <TR>
     <TD align="center" valign="bottom">
      <IMG SRC="../icone/logo_solo_anim.gif"
      WIDTH="90" HEIGHT="100" BORDER="0" ALT="TecnoBrain">
     </TD>
    </TR>
    
    <TR>
     <TD align="center">
      <H1>Gestione dei Clienti</H1>
     </TD>
    </TR>
    
    <TR>
     <TD align="center">
      This program is copyright under the <A href="COPYING">Gnu Public License</A>.
     </TD>
    </TR>
   </TABLE>
  </CENTER>
  
 </BODY>
</HTML>
