<?php if (file_exists('default.php')) { include 'default.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><?php print $prog_name; ?></title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<!-- header -->
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
    <td align="left">
    <font face="arial,helvetica,sans-serif" size="2">
    &nbsp;Navigate: Home page
    </font>
    </td>
</tr>
</table>

<!-- contents -->
<center>
<table cellspacing="20" cellpadding="0" border="0">
<tr>
    <td align="center" valign="bottom">
<IMG SRC="icone/logo_solo_anim.gif" WIDTH="90" HEIGHT="100" BORDER="0" ALT="TecnoBrain">
    </td>
</tr>
<tr>
    <td align="center" valign="top">
    <font face="arial,helvetica,sans-serif" size="2">
    Selezionare l'area di lavoro :
    </font>
    </td>
</tr>
<tr>
    <td align="center">
    <font face="arial,helvetica,sans-serif" size="2">
    <a href="magazzino/magazzino_index.php">Magazzino</a>&nbsp;,&nbsp;
    <a href="journals/journals_index.php">Journals</a>&nbsp;,&nbsp;
    <a href="articles/articles_index.php">Articles</a>&nbsp;,&nbsp;
    <a href="users/users_index.php">Users</a>&nbsp;,&nbsp;
    <a href="preference/preference_index.php" target="contents">Preference</a>&nbsp;,&nbsp;
    <a href="#" target="contents" onclick="javascript:window.open('./help/node_1.html','ne','scrollbars=1,location=0,menubar=0,toolbar=0,resizable=0,width=400,height=500')">Help on line</a>
    </font>
    </td>
</tr>
<tr>
    <td align="center">
    <font face="arial,helvetica,sans-serif" size="2">
    This program is copyright under the <a href="COPYING">Gnu Public License</a>.
    </font>
    </td>
</tr>
</table>
</center>

</body>
</html>
