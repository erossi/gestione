<?php
session_start();
// Use $HTTP_SESSION_VARS with PHP 4.0.6 or less
if (!isset($_SESSION['login']))
 {
 header ("Location: http://webtest.tecnobrain.com/gestione/0.5.0/login.html");
 exit;
 };

print '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">';
print "<HTML>";
print "<HEAD>";
$style = $_SESSION['d_stylesheet'];
print "<LINK REL=\"STYLESHEET\" HREF=\"$style\">";
//print "<LINK REL=\"STYLESHEET\" HREF=\"stylesheet.css\">";
print "</HEAD>";
?>
