<?php
if (!isset ($gestione04_pw))
 {
 header ("Location: main_password.html");
 exit;
 }
?>

<HTML>
<HEAD>
<link rel="stylesheet" href="../stylesheet.css">
</HEAD>

<FRAMESET ROWS="*,25" BORDER="0" FRAMEBORDER="0" FRAMESPACING="0">
 <FRAME NAME="main" SRC="main.html" MARGINWIDTH="0"
  MARGINHEIGHT="0" SCROLLING="auto" FRAMEBORDER="0">

 <FRAME NAME="bottom" SRC="bottom.php" MARGINWIDTH="0" MARGINHEIGHT="0"
  SCROLLING="no" FRAMEBORDER="0" NORESIZE>
</FRAMESET>

</HTML>
