<? 
    // ----------------------------------------------------------------------------------
    // connessione al database
    // ----------------------------------------------------------------------------------
    function db_connect($db_host,$db_porta,$db_nome,$db_utente) {
        // connessione al database
        $connection_string = "";
        if ($db_host != "") {
            $connection_string = "host=" . $db_host;
        }
        if ($db_porta != "") {
            $connection_string = $connection_string . " port=" . $db_porta;
        }
        if ($db_nome != "") {
            $connection_string = $connection_string . " dbname=" . $db_nome;
        }
        if ($db_utente != "") {
            $connection_string = $connection_string . " user=" . $db_utente;
        }
        $conn = pg_connect($connection_string);
        if (!$conn) {
            echo "errore durante l'accesso al database.<br>" .
                 "stringa di connessione: <b>" . $connection_string . "</b><br>";
            exit;
        }
        return $conn;
    }

    // disconnetti
    function db_close() {
        pg_close();
    }

    // ----------------------------------------------------------------------------------
    // scrive il titolo
    // ----------------------------------------------------------------------------------
    function print_title($title) {
        echo "<table cellspacing=\"0\" cellpadding=\"2\" width=\"90%\">\n";
        echo "<tr bgcolor=\"#000080\">\n";
        echo "    <td align=\"center\"><font face=\"arial,helvetica,sans-serif\" size=\"2\" color=\"white\">" . $title . "</font></td>\n";
        echo "</tr>\n";
        echo "</table>\n";
    }

    // ----------------------------------------------------------------------------------
    //
    // ----------------------------------------------------------------------------------
    function print_articles($result,$title) {
        // quanti articoli abbiamo?
        $numero_articoli=pg_numrows($result);
    
        // stampo il risultato
        if ($numero_articoli >= 1) {
            // stampo il risultato (adesso so che almeno un articolo c'e`).
            print '<table cellspacing="0" cellpadding="0" border="0">';
            print '<tr>';
            print '    <td align="right" valign="bottom" width="50"> <img src="../icone/table_top.png"     width="50"  height="20" border="0"></td>';
            print '    <td align="right" valign="bottom" width="200"><img src="../icone/table_top.png"     width="200" height="20" border="0"></td>';
            print '    <td align="right" valign="bottom" width="80"> <img src="../icone/table_top.png"     width="80"  height="20" border="0"></td>';
            print '    <td align="right" valign="bottom" width="100"><img src="../icone/table_top.png"     width="100" height="20" border="0"></td>';
            print '    <td align="right" valign="bottom" width="100"><img src="../icone/table_top.png"     width="100" height="20" border="0"></td>';
            print '    <td align="right" valign="bottom" width="100"><img src="../icone/table_top.png"     width="100" height="20" border="0"></td>';
            print '    <td align="right" valign="bottom" width="100"><img src="../icone/table_top.png"     width="100" height="20" border="0"></td>';
            print '    <td align="left"  valign="bottom" width="20"> <img src="../icone/table_upright.png" width="20"  height="20" border="0"></td>';
            print '</tr>';
            print '<tr bgcolor="#000080">';
            print '    <td align="center" valign="middle" colspan="7"><font face="arial,helvetica,sans-serif" size="2" color="white">' . $title . '</font></td>';
            print '    <td align="right" valign="bottom" width="20" background="../icone/table_right.png">&nbsp;</td>';
            print '</tr>';                
            print '<tr>';
            print '    <td background="../icone/table_back.png" width="50">';
            print '        <font face="arial,helvetica,sans-serif" size="2">&nbsp;Codice<br><br></font>';
            print '    </td>';
            print '    <td background="../icone/table_back.png" width="200">';
            print '        <font face="arial,helvetica,sans-serif" size="2">&nbsp;Articolo<br><br></font>';
            print '    </td>';
            print '    <td background="../icone/table_back.png" width="80">';
            print '        <font face="arial,helvetica,sans-serif" size="2">&nbsp;Quantit&agrave;<br><br></font>';
            print '    </td>';
            print '    <td background="../icone/table_back.png" width="100">';
            print '        <font face="arial,helvetica,sans-serif" size="2">&nbsp;Categoria<br><br></font>';
            print '    </td>';
            print '    <td background="../icone/table_back.png" width="100">';
            print '        <font face="arial,helvetica,sans-serif" size="2">&nbsp;Prezzo Vip<br><br></font>';
            print '    </td>';
            print '    <td background="../icone/table_back.png" width="100">';
            print '        <font face="arial,helvetica,sans-serif" size="2">&nbsp;Prezzo Stock<br><br></font>';
            print '    </td>';
            print '    <td background="../icone/table_back.png" width="100">';
            print '        <font face="arial,helvetica,sans-serif" size="2">&nbsp;Prezzo End User<br><br></font>';
            print '    </td>';
            print '    <td align="right" valign="bottom" width="20" background="../icone/table_right.png">&nbsp;</td>';
            print '</tr>';
    
            for ($indice=0; $indice<$numero_articoli; $indice++) {
                $articolo = pg_fetch_array ($result, $indice);
                print '<tr>';
                print ($indice % 2 ? '<td bgcolor="#e0e0e0" width="50">' : '<td background="../icone/table_back.png" width="50">');
                print '        <font face="arial,helvetica,sans-serif" size="2">&nbsp;' . $articolo["codice"] . '</font>';
                print '    </td>';
                print ($indice % 2 ? '<td bgcolor="#e0e0e0" width="200">' : '<td background="../icone/table_back.png" width="200">');
                print '        <font face="arial,helvetica,sans-serif" size="2">&nbsp;' . $articolo["articolo"] . '</font>';
                print '    </td>';
                print ($indice % 2 ? '<td bgcolor="#e0e0e0" width="50">' : '<td background="../icone/table_back.png" width="50">');
                print '        <font face="arial,helvetica,sans-serif" size="2">&nbsp;' . $articolo["quantita"] . '</font>';
                print '    </td>';
                print ($indice % 2 ? '<td bgcolor="#e0e0e0" width="100">' : '<td background="../icone/table_back.png" width="100">');
                print '        <font face="arial,helvetica,sans-serif" size="2">&nbsp;' . $articolo["categoria"] . '</font>';
                print '    </td>';
                print ($indice % 2 ? '<td bgcolor="#e0e0e0" width="100">' : '<td background="../icone/table_back.png" width="100">');
                print '        <font face="arial,helvetica,sans-serif" size="2">&nbsp;' . number_format($articolo['prezzo1'],0,'.',',') . '</font>';
                print '    </td>';
                print ($indice % 2 ? '<td bgcolor="#e0e0e0" width="100">' : '<td background="../icone/table_back.png" width="100">');
                print '        <font face="arial,helvetica,sans-serif" size="2">&nbsp;' . number_format($articolo['prezzo2'],0,'.',',') . '</font>';
                print '    </td>';
                print ($indice % 2 ? '<td bgcolor="#e0e0e0" width="100">' : '<td background="../icone/table_back.png" width="100">');
                print '        <font face="arial,helvetica,sans-serif" size="2">&nbsp;' . number_format($articolo['prezzo3'],0,'.',',') . '</font>';
                print '    </td>';
                print '    <td align="right" valign="bottom" width="20" background="../icone/table_right.png">&nbsp;</td>';
                print '</tr>';
            }
            print '<tr>';
            print '    <td align="right" valign="top" width="50"> <img src="../icone/table_bottom.png"   width="50"  height="20" border="0"></td>';
            print '    <td align="right" valign="top" width="200"><img src="../icone/table_bottom.png"   width="200" height="20" border="0"></td>';
            print '    <td align="right" valign="top" width="80"> <img src="../icone/table_bottom.png"   width="80"  height="20" border="0"></td>';
            print '    <td align="right" valign="top" width="100"><img src="../icone/table_bottom.png"   width="100" height="20" border="0"></td>';
            print '    <td align="right" valign="top" width="100"><img src="../icone/table_bottom.png"   width="100" height="20" border="0"></td>';        
            print '    <td align="right" valign="top" width="100"><img src="../icone/table_bottom.png"   width="100" height="20" border="0"></td>';
            print '    <td align="right" valign="top" width="100"><img src="../icone/table_bottom.png"   width="100" height="20" border="0"></td>';
            print '    <td align="right" valign="top" width="20"> <img src="../icone/table_botright.png" width="20"  height="20" border="0"></td>';
            print '</tr>';
            print '</table>';
        } else {
            print '<table cellspacing="0" cellpadding="0" border="0">';
            print '<tr>';
            print '    <td align="right" valign="bottom" width="730"><img src="../icone/table_top.png" width="730" height="20" border="0"></td>';
            print '    <td align="left"  valign="bottom" width="20"><img src="../icone/table_upright.png" width="20" height="20" border="0"></td>';
            print '</tr>';
            print '<tr bgcolor="#000080">';
            print '    <td align="center" valign="middle" width="730"><font face="arial,helvetica,sans-serif" size="2" color="white">' . $title . '</font></td>';
            print '    <td align="right" valign="bottom" width="20" background="../icone/table_right.png">&nbsp;</td>';
            print '</tr>';                
            print '<tr>';
            print '    <td background="../icone/table_back.png">';
            print '        <font face="arial,helvetica,sans-serif" size="2">&nbsp;Non ci sono articoli</font>';
            print '    </td>';
            print '    <td align="right" valign="bottom" width="20" background="../icone/table_right.png">&nbsp;</td>';
            print '</tr>';
            print '<tr>';
            print '    <td align="right" valign="top" width="730"><img src="../icone/table_bottom.png" width="730" height="20" border="0"></td>';
            print '    <td align="right" valign="top" width="20"><img src="../icone/table_botright.png" width="20" height="20" border="0"></td>';
            print '</tr>';
            print '</table>';
        }
    }

    // ----------------------------------------------------------------------------------
    //
    // ----------------------------------------------------------------------------------
    function print_articles_final($result,$title,$listino) {
        // quanti articoli abbiamo?
        $numero_articoli=pg_numrows($result);
    
        // stampo il risultato
        if ($numero_articoli >= 1) {
            // stampo il risultato (adesso so che almeno un articolo c'e`).
            print '<table cellspacing="0" cellpadding="0" border="0">';
            print '<tr>';
            print '    <td align="right" valign="bottom" width="50"> <img src="../icone/table_top.png"     width="50"  height="20" border="0"></td>';
            print '    <td align="right" valign="bottom" width="200"><img src="../icone/table_top.png"     width="200" height="20" border="0"></td>';
            print '    <td align="right" valign="bottom" width="80"> <img src="../icone/table_top.png"     width="80"  height="20" border="0"></td>';
            print '    <td align="right" valign="bottom" width="100"><img src="../icone/table_top.png"     width="100" height="20" border="0"></td>';
            print '    <td align="right" valign="bottom" width="100"><img src="../icone/table_top.png"     width="100" height="20" border="0"></td>';
            print '    <td align="right" valign="bottom" width="100"><img src="../icone/table_top.png"     width="100" height="20" border="0"></td>';
            print '    <td align="left"  valign="bottom" width="20"> <img src="../icone/table_upright.png" width="20"  height="20" border="0"></td>';
            print '</tr>';
            print '<tr bgcolor="#000080">';
            print '    <td align="center" valign="middle" colspan="6"><font face="arial,helvetica,sans-serif" size="2" color="white">' . $title . '</font></td>';
            print '    <td align="right" valign="bottom" width="20" background="../icone/table_right.png">&nbsp;</td>';
            print '</tr>';                
            print '<tr>';
            print '    <td background="../icone/table_back.png" width="50">';
            print '        <font face="arial,helvetica,sans-serif" size="2">&nbsp;Codice<br><br></font>';
            print '    </td>';
            print '    <td background="../icone/table_back.png" width="200">';
            print '        <font face="arial,helvetica,sans-serif" size="2">&nbsp;Articolo<br><br></font>';
            print '    </td>';
            print '    <td background="../icone/table_back.png" width="80">';
            print '        <font face="arial,helvetica,sans-serif" size="2">&nbsp;Quantit&agrave;<br><br></font>';
            print '    </td>';
            print '    <td background="../icone/table_back.png" width="100">';
            print '        <font face="arial,helvetica,sans-serif" size="2">&nbsp;Prezzo (Lire)<br><br></font>';
            print '    </td>';
            print '    <td background="../icone/table_back.png" width="100">';
            print '        <font face="arial,helvetica,sans-serif" size="2">&nbsp;Prezzo (Euro)<br><br></font>';
            print '    </td>';
            print '    <td background="../icone/table_back.png" width="100">';
            print '        <font face="arial,helvetica,sans-serif" size="2">&nbsp;<br><br></font>';
            print '    </td>';
            print '    <td align="right" valign="bottom" width="20" background="../icone/table_right.png">&nbsp;</td>';
            print '</tr>';
    
            for ($indice=0; $indice<$numero_articoli; $indice++) {
                $articolo = pg_fetch_array ($result, $indice);

                // calcolo dei prezzi
                switch ($listino) {
                    case 1: $prezzo=$articolo['prezzo1']; break; // vip
                    case 2: $prezzo=$articolo['prezzo2']; break; // stock
                    case 3: $prezzo=$articolo['prezzo3']; break;
                    case 4: $prezzo=$articolo['prezzo4']; break;
                    case 5: $prezzo=$articolo['prezzo5']; break;
                    default: $prezzo=0;
                }

                print '<tr>';
                print ($indice % 2 ? '<td bgcolor="#e0e0e0" width="50">' : '<td background="../icone/table_back.png" width="50">');
                print '        <font face="arial,helvetica,sans-serif" size="2">&nbsp;' . $articolo["codice"] . '</font>';
                print '    </td>';
                print ($indice % 2 ? '<td bgcolor="#e0e0e0" width="200">' : '<td background="../icone/table_back.png" width="200">');
                print '        <font face="arial,helvetica,sans-serif" size="2">&nbsp;' . $articolo["articolo"] . '</font>';
                print '    </td>';
                print ($indice % 2 ? '<td bgcolor="#e0e0e0" width="50">' : '<td background="../icone/table_back.png" width="50">');
                print '        <font face="arial,helvetica,sans-serif" size="2">&nbsp;' . $articolo["quantita"] . '</font>';
                print '    </td>';
                print ($indice % 2 ? '<td bgcolor="#e0e0e0" width="100">' : '<td background="../icone/table_back.png" width="100">');
                print '        <font face="arial,helvetica,sans-serif" size="2">&nbsp;' . number_format($prezzo,0,'.',',') . '</font>';
                print '    </td>';
                print ($indice % 2 ? '<td bgcolor="#e0e0e0" width="100">' : '<td background="../icone/table_back.png" width="100">');
                print '        <font face="arial,helvetica,sans-serif" size="2">&nbsp;' . number_format($prezzo/1936.73,2,'.',',') . '</font>';
                print '    </td>';
                print ($indice % 2 ? '<td bgcolor="#e0e0e0" width="100">' : '<td background="../icone/table_back.png" width="100">');
                print '        <font face="arial,helvetica,sans-serif" size="2">&nbsp;<a href="info.php">Info</a></font>';
                print '    </td>';
                print '    <td align="right" valign="bottom" width="20" background="../icone/table_right.png">&nbsp;</td>';
                print '</tr>';
            }
            print '<tr>';
            print '    <td align="right" valign="top" width="50"> <img src="../icone/table_bottom.png"   width="50"  height="20" border="0"></td>';
            print '    <td align="right" valign="top" width="200"><img src="../icone/table_bottom.png"   width="200" height="20" border="0"></td>';
            print '    <td align="right" valign="top" width="80"> <img src="../icone/table_bottom.png"   width="80"  height="20" border="0"></td>';
            print '    <td align="right" valign="top" width="100"><img src="../icone/table_bottom.png"   width="100" height="20" border="0"></td>';
            print '    <td align="right" valign="top" width="100"><img src="../icone/table_bottom.png"   width="100" height="20" border="0"></td>';        
            print '    <td align="right" valign="top" width="100"><img src="../icone/table_bottom.png"   width="100" height="20" border="0"></td>';
            print '    <td align="right" valign="top" width="20"> <img src="../icone/table_botright.png" width="20"  height="20" border="0"></td>';
            print '</tr>';
            print '</table>';
        } else {
            print '<table cellspacing="0" cellpadding="0" border="0">';
            print '<tr>';
            print '    <td align="right" valign="bottom" width="630"><img src="../icone/table_top.png" width="630" height="20" border="0"></td>';
            print '    <td align="left"  valign="bottom" width="20"><img src="../icone/table_upright.png" width="20" height="20" border="0"></td>';
            print '</tr>';
            print '<tr bgcolor="#000080">';
            print '    <td align="center" valign="middle" width="630"><font face="arial,helvetica,sans-serif" size="2" color="white">' . $title . '</font></td>';
            print '    <td align="right" valign="bottom" width="20" background="../icone/table_right.png">&nbsp;</td>';
            print '</tr>';                
            print '<tr>';
            print '    <td background="../icone/table_back.png">';
            print '        <font face="arial,helvetica,sans-serif" size="2">&nbsp;Non ci sono articoli</font>';
            print '    </td>';
            print '    <td align="right" valign="bottom" width="20" background="../icone/table_right.png">&nbsp;</td>';
            print '</tr>';
            print '<tr>';
            print '    <td align="right" valign="top" width="630"><img src="../icone/table_bottom.png" width="630" height="20" border="0"></td>';
            print '    <td align="right" valign="top" width="20"><img src="../icone/table_botright.png" width="20" height="20" border="0"></td>';
            print '</tr>';
            print '</table>';
        }
    }

?>