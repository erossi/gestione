<? if (file_exists('../default.php')) { include '../default.php'; } ?>
<? if (file_exists('../procedure/utility.php')) { include '../procedure/utility.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name ?> - Magazzino</title>
    <link rel="stylesheet" href="../stylesheet.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<font face="arial,helvetica,sans-serif" size="2">

<? print_top($prog_name); ?>
<? print_navigation('Magazzino','Home Page','../contents.php'); ?>
<? print_title('Magazzino'); ?>

<table align="center" width="90%" cellspacing="1" cellpadding="3" border="0">
<tr>
    <td align="left" valign="top" width="70%" bgcolor="#e0e0e0">
        <font face="arial,helvetica,sans-serif" size="2">
        Please inserite le informazioni e premete <b>Search</b> :<br>
        <form action="articoli_list.php">
        <table cellspacing="1" cellpadding="3" border="0">
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Title</font></td>
            <td><input type="text" name="f_title" size="30" align="absmiddle"></td>
        </tr>
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Authors</font></td>
            <td>
                <input type="text" name="f_auth1" size="30" align="absmiddle"><br>
                <input type="text" name="f_auth2" size="30" align="absmiddle"><br>
            </td>
        </tr>
        <tr>
            <td align="right" valign="middle" bgcolor="#336699"><font face="arial,helvetica,sans-serif" size="2" color="white">Editor</font></td>
            <td><input type="text" name="f_editor" size="30" align="absmiddle"></td>
        </tr>
        <tr>
            <td>&nbsp</td>
            <td>
                <input type="submit" name="submit" value="Search">
                <select name="f_logical_op" size="1">
    	    	    <option value="OR">Any of the words listed</option>
    	    	    <option value="AND">All the words listed</option>
                </select>
            </td>
        </tr>
        </table>
        </form>
        <form action="secure/articolo_insert.php">
            <input type="submit" value="Inserisci un nuovo articolo">
        </form>
        <a href="javascript:history.back(1)">Back</a> to previous screen.
        </font>
    </td>
    <td align="justify" valign="top" width="30%" bgcolor="#ffffe0">
        <font face="arial,helvetica,sans-serif" size="2">
        <div align="justify">
        <b>On-line Help</b><br>
        <br>
        Enter title, author(s) and editing firm of the book you require into their box.<br>
        <br>
        Before pressing the <i>Search</i> button select <i>Any of the words listed</i>
        if you want an AND among the voices inserted or <i>All the words listed</i>
        if you want an OR search.<br>
        </div>
        </font>
    </td>
</tr>
</table>

</font>

</body>
</html>