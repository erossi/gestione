<?php
 if (file_exists("auth_nohead.php"))
  { include "auth_nohead.php"; }

session_unset ();
session_destroy ();
header("Location: index.php");
?>
