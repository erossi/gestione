<? if (file_exists('../default.php')) { include '../default.php'; } ?>
<? if (file_exists('../procedure/utility.php')) { include '../procedure/utility.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title><? print $prog_name ?> - Magazzino</title>
    <link rel="stylesheet" href="../stylesheet.css">
</head>
<body text="black" bgcolor="white" link="#cc9966" alink="#cc9966" vlink="#cc9966">

<? print_top($prog_name); ?>
<? print_navigation('Magazzino','Home Page','../contents.php'); ?>
<? print_title('Lista di Magazzino'); ?>

<?
    // controllo i parametri
    if ($DEBUG) { 
        print 'title(info) is: ' . $title . '(' . $info . ')<br>';
    };

    // toglie tutti gli slashes
    $where=stripslashes($where);
    // codifica la where clause per poterla trasferire via URL
    $where_encoded=urlencode($where);
    // if there is something we add "where " at the where clause
    if ($where) { $where_clause=" WHERE " . $where; }
    // order by...
    switch ($order) {
        case "c": $order_clause=" ORDER BY codice_art"; break;
        case "d":
	default: $order_clause=" ORDER BY descrizione,descrizione2";
        }

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
        print '    <td  width="5%">Index:</td>';
        print '    <td width="95%">&nbsp;';
        for ($count=0; $count<$num_rows; $count+=$max_table_rows) {
            $temp_to=$count+$max_table_rows-1;
            if ($temp_to>$num_rows) { $temp_to=$num_rows-1; };
            print '<a href="articoli_list.php?from=' . $count .
	     '&to=' . $temp_to .
	     '&order=' . $order .
	     '&where=' . $where_encoded . '">' . $count . '</a> &nbsp;';
        }
        print ': Totale ' . $num_rows;
        print '</td></tr></table>';
        print '</div>';
        
        // stampo il risultato
        $query="SELECT oid,* FROM magazzino " . $order_clause;
        $result = db_execute($conn,$query);
        if ($DEBUG) { print 'Query: <b>' . $query . '</b><br>'; };
        if (!$result) {
            if ($DEBUG) { print 'file lista_magazzino error: cannot execute query.\n'; };
            exit;
        };
       
        // conto il numero di righe
        $num_rows=pg_numrows($result);
        if ($DEBUG) 
	 { print 'Numbers of rows in table: <b>' . $num_rows . '</b><br>';
	 print 'Query: ' . $query . '<BR>';
	 };
    
        // imposto i limiti dei record da stampare (stampo da $from a $to).
        if ($from=='') { $from=0; };
        if ($to=='') { $to=$to+$max_table_rows-1; };
        // you cannot exceed number of row reported by database.
        if ($to>$num_rows) { $to=$num_rows-1; };
        if ($DEBUG) { print 'Index: <b>from=' . $from . ', to=' . $to . '</b>'; };

        print '<div align="center">';
        print '<table cellspacing="0" cellpadding="0" border="0" width="90%">';
        print '<tr bgcolor="#336699">';
        print '<td width="5%">
	    <a href="articoli_list.php?from=' . $from . '&to=' . $to .
	    '&order=c&where=' . $where_encoded . '" style="color:white">
	    Cod.</td>';
        print '<td align="center" width="55%">
	    <a href="articoli_list.php?from=' . $from . '&to=' . $to .
	    '&order=d&where=' . $where_encoded . '" style="color:white">
	    Descrizione</td>';
        print '    <td align="center" width="5%">Qt.</td>';
        print '    <td align="center" width="15%">Prezzo</td>';
        print '    <td align="center" width="15%" colspan="2">Operazioni</td>';
	print '</tr>';
		
        for ($count=$from; $count<=$to; $count++)        
        {
            $arr=pg_fetch_array ($result,$count);
            if (($count % 2) == 0) {
                print '<tr bgcolor="#e0e0e0">';
            } else {
                print '<tr bgcolor="white">';
            };

            // ************* first column
            print '<td valign="top">';
            //print '<font size=2>';
            print $arr['codice_art'] . '<br>';
            if ($DEBUG) { print '<i>' . $arr['oid'] . '</i>'; }
            //print '</font>';
            print '</td>';

            // ************* second column
            print '<td valign="top">';
            //print '<font size=2>';
            print '<a href="#" target="contents" onclick="javascript:window.open(\'./secure/articolo_info.php?oid=' . $arr['oid'] . '\',\'ne\',\'scrollbars=1,location=0,menubar=0,toolbar=0,resizable=1,width=700,height=300\')">';
            print ' <i>' . $arr['descrizione'] . '</i>';
            if ($arr['descrizione2'] != "") { print ',&nbsp;' . $arr['descrizione2']; }
            print '</a>';
            //print '</font>';
            print '</td>';

	    // ************* third column
            print '<td align="right" valign="top"';
            if ($arr['quantita'] <= 0) { 
                print ' bgcolor="#ff0000"> ';
            } else {
                print '>';
            };
            //print '<font size=2>';
	    
            print $arr['quantita'] . '<br>';
            //print '</font>';
            print '</td>';
	    
	    // ************* 4th column
            print '<td align="right" valign="top"';
            if ($arr['quantita'] <= 0) { 
                print ' bgcolor="#ff0000"> ';
            } else {
                print '>';
            };
	    
            //print '<font size=2>';
            print $arr['prezzo_ven1'] . '<br>';
            //print '</font>';
            print '</td>';

	    // ************* 5th column
            print '<td valign="top">';
            //print '<font size=2>';
            print '    <a href="secure/articolo_drop.php?codice_art=' . $arr['codice_art'] . '"> U</a>';
            print '    <a href="secure/articolo_load.php?codice_art=' . $arr['codice_art'] . '"> L</a>';

            print '<a href="#" target="contents" onclick="javascript:window.open(\'secure/articolo_history.php?codice_art=' . $arr['codice_art'] . '\',\'ne\',\'scrollbars=1,location=0,menubar=0,toolbar=0,resizable=1,width=700,height=300\')">';
//            print '    <a href="secure/articolo_history.php?codice_art=' . $arr['codice_art'] . '">';
	    print ' H</a>';

            print '    <a href="secure/articolo_modify.php?codice_art=' . $arr['codice_art'] . '"> M</a>';

            print '<a href="#" target="contents" onclick="javascript:window.open(\'secure/articolo_delete.php?codice_art=' . $arr['codice_art'] . '\',\'ne\',\'scrollbars=1,location=0,menubar=0,toolbar=0,resizable=1,width=700,height=300\')">';
//            print '    <a href="secure/articolo_delete.php?codice_art=' . $arr['codice_art'] . '"> D</a>';
	    print ' D</a>';

            //print '</font>';
            print '</td>';

//            print '<td valign="top">';
//            print '    <a href="secure/articolo_drop.php?codice_art=' . $arr['codice_art'] . '"><img src="../icone/ico_draw.gif" width="14" height="15" border="0" alt="Scarica art. da magazzino"></a>';
//            print '    <a href="secure/articolo_load.php?codice_art=' . $arr['codice_art'] . '"><img src="../icone/ico_deposit.gif" width="14" height="15" border="0" alt="Carica art. a magazzino"></a>';
//            print '    <a href="secure/articolo_history.php?codice_art=' . $arr['codice_art'] . '"><img src="../icone/ico_history.gif" width="14" height="15" border="0" alt="Visualizza i movimenti"></a>';
//            print '    <a href="secure/articolo_modify.php?codice_art=' . $arr['codice_art'] . '"><img src="../icone/ico_edit.gif" width="20" height="15" border="0" alt="Modifica"></a>';
//            print '    <a href="secure/articolo_delete.php?codice_art=' . $arr['codice_art'] . '"><img src="../icone/ico_delete.gif" width="17" height="15" border="0" alt="Cancella"></a>';
//            print '</td>';

            print '</tr>';
        };
        print '</table>';
    };
    // chiudo la connessione
    db_close($conn);
?>

</body>
</html>
