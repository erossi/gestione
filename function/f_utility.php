<?php
// ----------------------------------------------------------------------------------
// File: utility
// contiene una serie di funzioni di utilità generale
// basate su session.
// ----------------------------------------------------------------------------------

// ----------------------------------------------------------------------------------
// stampa un messaggiop di errore
// ----------------------------------------------------------------------------------
function print_error($message) {
print '<BR>';
print '<DIV align="center">';
 print '<TABLE width="60%" cellspacing="0" cellpadding="0" border="1">';
  print '<TR>';
   print '    <TD align="left" valign="middle" bgcolor="red">';
    print '    <FONT face="arial,helvetica,sans-serif" size="2" color="yellow">';
     print $message;
    print '    </FONT>';
   print '    </TD>';
  print '</TR>';
 print '</TABLE>';
print '</DIV>';
return;
}

// ----------------------------------------------------------------------------------
// stampa la navigation bar delle pagine
// ----------------------------------------------------------------------------------
function print_navigation($title,$first='',$first_link='',$second='',$second_link='',$third='',$third_link='') {
print '<DIV align="center">';
 print '<TABLE width="90%" cellspacing="1" cellpadding="3" border="0">';
  print '<TR>';
   print '    <TD align="right" valign="middle" bgcolor="#e0e0e0" width="10%">';
    print '    <FONT face="arial,helvetica,sans-serif" size="2">';
     print '    Navigate';
    print '    </FONT>';
   print '    </TD>';
   print '    <TD align="left" valign="middle">';
    print '    <FONT face="arial,helvetica,sans-serif" size="2">';
     if ($first_link <> '') { print '&nbsp;:&nbsp;<A href="' . $first_link . '">' . ($first == '' ? 'NULL' : $first) . '</A>'; }
     if ($second_link <> '') { print '&nbsp;:&nbsp;<A href="' . $second_link . '">' . ($second == '' ? 'NULL' : $second) . '</A>'; }
     if ($third_link <> '') { print '&nbsp;:&nbsp;<A href="' . $third_link . '">' . ($third == '' ? 'NULL' : $third) . '</A>'; }
     if ($title <> '') { print '&nbsp;:&nbsp;' . $title; }
    print '    </FONT>';
   print '    </TD>';
  print '</TR>';
 print '</TABLE>';
print '</DIV>';
return;
};

// ----------------------------------------------------------------------------------
// stampa il titolo
// ----------------------------------------------------------------------------------
function print_title($title) {
print '<TABLE align="center" width="90%" cellspacing="1" cellpadding="3" border="0">';
 print '<TR>';
  print '<TD align="center" valign="middle" width="70%" bgcolor="#336699" colspan="2">';
   print '    <FONT face="arial,helvetica,sans-serif" size="2" color="white">';
    print $title;
   print '    </FONT>';
  print '    </TD>';
 print '</TR>';
print '</TABLE>';
};

// ----------------------------------------------------------------------------------
// stampa il titolo
// ----------------------------------------------------------------------------------
function print_top($title) {
print '<TABLE align="center" width="90%" cellspacing="1" cellpadding="3" border="0">';
 print '<TR>';
  print '<TD align="right" valign="middle" width="70%" bgcolor="white" colspan="2">';
   print '    <FONT face="arial,helvetica,sans-serif" size="2" color="black">';
    print $title . '&nbsp;-&nbsp;Creato da Tecno Brain';
   print '    </FONT>';
  print '    </TD>';
 print '</TR>';
print '</TABLE>';
};

// ----------------------------------------------------------------------------------
// connessione al database
// ----------------------------------------------------------------------------------
function db_connect()
 {
$cons = '';
if ($_SESSION['d_db_host'])
 { $cons = "host=" . $_SESSION['d_db_host']; }
if ($_SESSION['d_db_port'])
 { $cons = $cons . " port=" . $_SESSION['d_db_port']; }
if ($_SESSION['d_db_name'])
 { $cons = $cons . " dbname=" . $_SESSION['d_db_name']; }
if ($_SESSION['d_db_user'])
 { $cons = $cons . " user=" . $_SESSION['d_db_user']; }
 
$connection = pg_connect($cons);
if (!$connection)
 {
 print_error('Function db_connect error: cannot connect to database.<BR>');
 // print_error ('Connection string is: <B>' . $cons . '</B><BR>');
 exit;
 }
 return $connection;
}

// ----------------------------------------------------------------------------------
// Esegue una query al db
// ----------------------------------------------------------------------------------
function db_execute($connection,$query_string)
{
$query_result = pg_exec ($connection,$query_string);
if (!$query_result)
 {
 print_error('File db_execute error: cannot execute query.<BR>');
 // print ('Query string is: <B>' . $query_string . '</B><BR>');
 exit;
 }
return $query_result;
}

// ----------------------------------------------------------------------------------
// DISconnessione al database
// ----------------------------------------------------------------------------------
function db_close($conn)
{
pg_close ($conn);
return;
}
?>
