<?php
session_start();
// Use $HTTP_SESSION_VARS with PHP 4.0.6 or less
if (!isset($_SESSION['login']))
 {
 header ("Location: http://webtest.tecnobrain.com/gestione/0.4.2/login.html");
 exit;
 };
?>
