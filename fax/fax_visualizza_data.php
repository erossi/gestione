<?php
 if (file_exists("auth.php"))
  { include "auth.php"; }
  
 $utility = $_SESSION['d_function_dir'] . "/f_utility.php";
 
 if (file_exists("$utility"))
  { include "$utility"; }
?>

<body>
  <TABLE BGCOLOR="Black" CELLSPACING="0" CELLPADDING="0" BORDER="0" WIDTH="100%">
   <TR>
    
    <TD ALIGN="LEFT">
     <FONT style="color:white">
      Fax -> Visualizza - > Per data:
      &nbsp;
      <A HREF="fax_visualizza_index.php">
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

<TABLE CELLSPACING="0" CELLPADDING="0" BORDER="0" WIDTH="100%">
<tr>

<td valign="top">
<form action="fax_visualizza_data_commit.php" method="post">
<br>
Inserire la data nel formato gg/mm/aa<br>
<br>gg
<input type="text" name="giorno" maxlenght="10" size="2" align="absmiddle">
mm
<input type="text" name="mese" maxlenght="10" size="2" align="absmiddle">
aa
<input type="text" name="anno" maxlenght="10" size="2" align="absmiddle">
<br>
<br>
<br>
<input type="submit" value="trova">
</form>
</td>

<td>

</td>
</tr>
</table>
</body>
</html>
