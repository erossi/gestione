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
<? print_title('Lista di Magazzino'); ?>

<?
    // controllo i parametri
    if ($DEBUG) { 
        print 'title(info) is: ' . $title . '(' . $info . ')<br>';
    };
    
    // connessione al database
    $conn=db_connect($db_host,$db_port,$db_name,$db_user);    

    // leggo gli articoli
    $query="SELECT count(*) FROM magazzino";
    $result = db_execute($conn,$query);
    
    // conto il numero di linee trovate (count ritorna sempre qualcosa).
    $arr=pg_fetch_array ($result,0);
    $num_rows=$arr[0];
    if ($DEBUG) { print 'Total lines found: ' . $num_rows . '<br>'; };

    if ($num_rows=='0') {
        print '<ul>';
        print '    <li>Num. di art. trovati .';
        print '</ul>';
    } else {
        // stampo l'indice
        print '<div align="center">';
        print '<table cellspacing="1" cellpadding="3" border="0" width="90%">';
        print '<tr bgcolor="white">';
        print '    <td  width="5%"><font face="arial,helvetica,sans-serif" size="2">Index:</font></td>';
        print '    <td width="95%"><font face="arial,helvetica,sans-serif" size="2">&nbsp;';
        for ($count=0; $count<$num_rows; $count+=$max_table_rows) {
            $temp_to=$count+$max_table_rows-1;
            if ($temp_to>$num_rows) { $temp_to=$num_rows-1; };
            print '<a href="articoli_list.php?from=' . $count . '&to=' . $temp_to . '&where=' . $where_encoded . '">' . $count . '</a> &nbsp;';
        }
        print ': Totale ' . $num_rows;
        print '</font></td></tr></table>';
        print '</div>';
        
        // legenda
        print '<div align="center">';
        print '<table cellspacing="1" cellpadding="3" border="0" width="90%">';        
        print '<tr>';
        print '<td align="left" valign="middle">';
        print '    <font face="arial,helvetica,sans-serif" size="2">';
        print '    &nbsp;<img src="../icone/ico_info.gif" width="17" height="15" border="0" align="absmiddle"> = Dettagli&nbsp;';
        print '    </font>';
        print '</td>';
	
        print '<td align="left" valign="middle" bgcolor="#ffc1c1">';
        print '    <font face="arial,helvetica,sans-serif" size="2">';
        print '    &nbsp;<img src="../icone/ico_draw.gif"    width="25" height="30" border="0" align="absmiddle"> = Scarico&nbsp;';
        print '    &nbsp;<img src="../icone/ico_deposit.gif" width="25" height="30" border="0" align="absmiddle"> = Carico&nbsp;';
        print '    &nbsp;<img src="../icone/ico_history.gif" width="25" height="30" border="0" align="absmiddle"> = Movimenti&nbsp;';
        print '    &nbsp;<img src="../icone/ico_edit.gif" width="25" height="30" border="0" align="absmiddle"> = Modifica&nbsp;';
        print '    &nbsp;<img src="../icone/ico_delete.gif" width="25" height="30" border="0" align="absmiddle"> = Cancella&nbsp;';
        print '    </font>';
        print '</td>';
        print '</tr>'; 
        print '</table>';
        print '</div>';

        // stampo il risultato
        $query="SELECT oid,* FROM magazzino ORDER BY descrizione,descrizione2";
        $result = db_execute($conn,$query);
        if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
        if (!$result) {
            if ($DEBUG) { print 'file lista_magazzino error: cannot execute query.\n'; };
            exit;
        };
       
        // conto il numero di righe
        $num_rows=pg_numrows($result);
        if ($DEBUG) { print 'Numbers of rows in table: <b>' . $num_rows . '</b><br>'; };
    
        // imposto i limiti dei record da stampare (stampo da $from a $to).
        if ($from=='') { $from=0; };
        if ($to=='') { $to=$to+$max_table_rows-1; };
        // you cannot exceed number of row reported by database.
        if ($to>$num_rows) { $to=$num_rows-1; };
        if ($DEBUG) { print 'Index: <b>from=' . $from . ', to=' . $to . '</b>'; };

        print '<div align="center">';
        print '<table cellspacing="1" cellpadding="3" border="0" width="90%">';
        print '<tr bgcolor="#336699">';
        print '    <td width="5%"><font face="arial,helvetica,sans-serif" size="2" style="color: white">Cod.</font></td>';
        print '    <td width="55%"><font face="arial,helvetica,sans-serif" size="2" style="color: white">Descrizione</font></td>';
        print '    <td width="15%"><font face="arial,helvetica,sans-serif" size="2" style="color: white">Prezzo</font></td>';
        print '    <td width="5%"><font face="arial,helvetica,sans-serif" size="2" style="color: white">Qt.</font></td>';
        print '    <td width="15%" colspan="2"><font face="arial,helvetica,sans-serif" size="2" style="color: white">Operazioni</font></td>';
	print '</tr>';
		
        for ($count=$from; $count<=$to; $count++)        
        {
            $arr=pg_fetch_array ($result,$count);
            if (($count % 2) == 0) {
                print '<tr bgcolor="#e0e0e0">';
            } else {
                print '<tr bgcolor="white">';
            };

            // first column
            print '<td valign="top"';
            if ($arr['quantita'] <= 0) { 
                print ' bgcolor="#ffc1c1"> ';
            } else {
                print '>';
            }
            print '    <font face="arial,helvetica,sans-serif" size="2">';
            print $arr['codice_art'] . '<br>';
            if ($DEBUG) { print '<i>' . $arr['oid'] . '</i>'; }
            print '    </font>';
            print '</td>';

            // second column
            print '<td valign="top"';
            if ($arr['quantita'] <= 0) { 
                print ' bgcolor="#ffc1c1"> ';
            } else {
                print '>';
            }
            print '    <font face="arial,helvetica,sans-serif" size="2">';
            print '    <i>' . $arr['descrizione'] . '</i>';
            if ($arr['descrizione2'] != "") { print ',&nbsp;' . $arr['descrizione2']; }

            print '    </font>';
            print '</td>';

	    // third column
            print '<td valign="top"';
            if ($arr['quantita'] <= 0) { 
                print ' bgcolor="#ffc1c1"> ';
            } else {
                print '>';
            };
	    
            print '    <font face="arial,helvetica,sans-serif" size="2">';
            print $arr['prezzo_ven'] . '<br>';
            print '    </font>';
            print '</td>';
	    
	    // 4th column
            print '<td valign="top"';
            if ($arr['quantita'] <= 0) { 
                print ' bgcolor="#ffc1c1"> ';
            } else {
                print '>';
            };
	    
            print '    <font face="arial,helvetica,sans-serif" size="2">';
            print $arr['quantita'] . '<br>';
            print '    </font>';
            print '</td>';

	    // 5th column
            print '<td valign="top">';
            print '    <a href="articolo_info.php?oid=' . $arr['oid'] . '"><img src="../icone/ico_info.gif" width="17" height="15" border="0" alt="Visualizza i dettagli"></a>';
            print '</td>';
	    
	    // 6th column
            print '<td valign="top" bgcolor="#ffc1c1">';
            print '    <a href="secure/articolo_drop.php?codice_art=' . $arr['codice_art'] . '"><img src="../icone/ico_draw.gif" width="14" height="15" border="0" alt="Scarica art. da magazzino"></a>';
            print '    <a href="secure/articolo_load.php?codice_art=' . $arr['codice_art'] . '"><img src="../icone/ico_deposit.gif" width="14" height="15" border="0" alt="Carica art. a magazzino"></a>';
            print '    <a href="secure/articolo_history.php?codice_art=' . $arr['codice_art'] . '"><img src="../icone/ico_history.gif" width="14" height="15" border="0" alt="Visualizza i movimenti"></a>';
            print '    <a href="secure/articolo_modify.php?codice_art=' . $arr['codice_art'] . '"><img src="../icone/ico_edit.gif" width="20" height="15" border="0" alt="Modifica"></a>';
            print '    <a href="secure/articolo_delete.php?codice_art=' . $arr['codice_art'] . '"><img src="../icone/ico_delete.gif" width="17" height="15" border="0" alt="Cancella"></a>';
            print '</td>';

            print '</tr>';
        };

        print '</table>';
    };
    // chiudo la connessione
    db_close($conn);
?>

</body>
</html>
