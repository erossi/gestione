<? if (file_exists('../default.php')) { include('../default.php'); } ?>
<? if (file_exists('./procedure/utility.php')) { include('./procedure/utility.php'); } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title>Gestione Web</title>
</head>
<body bgcolor="white" text="black" link="#000080" alink="#000080" vlink="#000080">

<font face="arial,helvetica,sans-serif" size="2">
<div align="left">
<br>

<?
    print_title("Informazioni clienti");

    // connessione al database
    $conn = db_connect($db_host,$db_porta,$db_nome,$db_utente);

    // inizializzo la query
    $query="SELECT oid,* FROM clienti WHERE oid=" . $oid;
    // eseguo la query
    $result = pg_exec ($conn, $query );
    if (!$result) {
        echo "errore durante l'esecuzione della query.<br>" .
             "query: <b>" . $query . "</b><br>" .
             "file: <b>clienti_info</b><br>";
        exit;
    }

    // leggo il risultato
    $arr=pg_fetch_array ($result, 0);

    print '&nbsp;<img src="../icone/freccia.png" width="15" height="15" border="0" vspace="2" align="absmiddle"> Informazioni generali';

    // stampo tutta la tabella
    print '<form action="clienti_modifica.php">';
    print '<table width="90%" cellpadding="1" cellspacing="5" border="0">';
    print '<tr>';
    print '    <td align="right" valign="middle">';
    print '        <font size="2" face="arial,helvetica">';
    print '            Codice unico identificativo del database (oid):<br>';
    print '            Data di iscrizione:';
    print '        </font>';
    print '    </td>';
    print '    <td align="left" valign="middle">';
    print '        <font size="2" face="arial,helvetica">';
    print '            <i>' . $arr["oid"] . '</i> (non modificabile)<br>';
    print '            <i>' . $arr["iscrdata"] . '</i> (non modificabile)';
    print '        </font>';
    print '    </td>';
    print '</tr>';
    //

    if ($arr["status"]=="a") {
        print '<tr>';
        print '    <td align="right" valign="middle">';
        print '        <font size="2" face="arial,helvetica">';
        print '            Stato:<br>';
        print '        </font>';
        print '    </td>';
        print '    <td align="left" valign="middle">';
        print '        <font size="2" face="arial,helvetica">';
        print '            <i>Abilitato</i><br>';
        print '        </font>';
        print '    </td>';
        print '</tr>';
        print '<tr>';
        print '    <td align="right" valign="middle">';
        print '        <font size="2" face="arial,helvetica">';
        print '            Listino assegnato al cliente:<br>';
        print '        </font>';
        print '    </td>';
        print '    <td align="left" valign="middle">';
        print '        <font size="2" face="arial,helvetica">';
        print '            <select name="listino">';
        for ($count=0; $count<sizeof($nome_listino); $count++) {
            if ($count == $arr["listino"]) {
                print '<option selected>';
            } else {
                print '<option>';
            }
            print $nome_listino[$count];
        }
        print '            </select>';
        print '        </font>';
        print '    </td>';
        print '</tr>';
        print '<tr>';
        print '    <td align="right" valign="middle">';
        print '        <font size="2" face="arial,helvetica">';
        print '             Codice utente (username):<br>';
        print '        </font>';
        print '    </td>';
        print '    <td align="left" valign="middle">';
        print '        <font size="2" face="arial,helvetica">';
        print '            <input type="text" size="40" name="username" value="' . $arr["codice"] . '"></input><br>';
        print '        </font>';
        print '    </td>';
        print '</tr>';
        print '<tr>';
        print '    <td align="right" valign="middle">';
        print '        <font size="2" face="arial,helvetica">';
        print '            Password:<br>';
        print '        </font>';
        print '    </td>';
        print '    <td align="left" valign="middle">';
        print '        <font size="2" face="arial,helvetica">';
        print '            <input type="text" size="40" name="password" value="' . $arr["password"] . '"></input>';
        print '        </font>';
        print '    </td>';
        print '</tr>';
    } else {
        print '<tr>';
        print '    <td align="right" valign="middle">';
        print '        <font size="2" face="arial,helvetica">';
        print '            Stato:<br>';
        print '            Listino assegnato al cliente:<br>';
        print '            Codice utente (username):<br>';
        print '            Password:<br>';
        print '        </font>';
        print '    </td>';
        print '    <td align="left" valign="middle">';
        print '        <font size="2" face="arial,helvetica">';
        print '            <i>In attesa di registrazione</i><br>';
        print '            <i>' . $nome_listino[$arr["listino"]] . ' (&egrave necessario che sia abilitato per cambiarlo)</i><br>';
        print '            <i>' . $arr["codice"] . '</i><br>';
        print '            <i>' . $arr["password"] . '</i><br>';
        print '        </font>';
        print '    </td>';
        print '</tr>';
    }
    print '</table>';

    print '&nbsp;<img src="../icone/freccia.png" width="15" height="15" border="0" vspace="2" align="absmiddle"> Informazioni anagrafiche';

    print '<table width="90%" cellpadding="1" cellspacing="5" border="0">';
    print '<tr>';
    print '    <td align="right" valign="middle"><font size="2" face="arial,helvetica">Ragione sociale:</font></td>';
    print '    <td align="left" valign="middle"><input type="text" size="40" name="rag_soc" value="' . $arr["ragsoc"] . '"></input></td>';
    print '</tr>';
    print '<tr>';
    print '    <td align="right" valign="middle"><font size="2" face="arial,helvetica">Partita IVA:</font></td>';
    print '    <td align="left" valign="middle"><input type="text" size="40" name="part_iva" value="' . $arr["piva"] . '"></input></td>';
    print '</tr>';
    print '<tr>';
    print '    <td align="right" valign="middle"><font size="2" face="arial,helvetica">Responsabile commerciale:</font></td>';
    print '    <td align="left" valign="middle"><input type="text" size="40" name="resp_nome" value="' . $arr["respcom"] . '"></input></td>';
    print '</tr>';
    print '<tr>';
    print '    <td align="right" valign="middle"><font size="2" face="arial,helvetica">E-mail:</font></td>';
    print '    <td align="left" valign="middle"><input type="text" size="40" name="resp_mail" value="' . $arr["email"] . '"></input></td>';
    print '</tr>';
    print '</table>';

    print '&nbsp;<img src="../icone/freccia.png" width="15" height="15" border="0" vspace="2" align="absmiddle"> Indirizzo altra sede';

    print '<table width="90%" cellpadding="1" cellspacing="5" border="0">';
    print '<tr>';
    print '    <td align="right" valign="middle"><font size="2" face="arial,helvetica">Indirizzo e numero civico:</font></td>';
    print '    <td align="left" valign="middle">';
    print '        <input type="text" size="34" name="sede_indirizzo" value="' . $arr["sede_via"] . '"></input>';
    print '        <input type="text" size="4" name="sede_civico" value="' . $arr["sede_civico"] . '"></input>';
    print '    </td>';
    print '</tr>';
    print '<tr>';
    print '    <td align="right" valign="middle"><font size="2" face="arial,helvetica">Citt&aacute;, Provincia e CAP:</font></td>';
    print '    <td align="left" valign="middle">';
    print '        <input type="text" size="25" name="sede_citta" value="' . $arr["sede_citta"] . '"></input>&nbsp;(&nbsp;';
    print '        <input type="text" size="2"2 name="sede_prov" value="' . $arr["sede_prov"] . '"></input>&nbsp;)&nbsp;&nbsp;&nbsp;';
    print '        <input type="text" size="5" name="sede_cap" value="' . $arr["sede_cap"] . '"></input>';
    print '    </td>';
    print '</tr>';
    print '<tr>';
    print '    <td align="right" valign="middle"><font size="2" face="arial,helvetica">Stato:</font></td>';
    print '    <td align="left" valign="middle"><input type="text" size="40" name="sede_stato" value="' . $arr["sede_stato"] . '"></input></td>';
    print '</tr>';
    print '<tr>';
    print '    <td align="right" valign="middle"><font size="2" face="arial,helvetica">Telefono/Fax:</font></td>';
    print '    <td align="left" valign="middle">';
    print '        <input type="text" size="18" name="sede_tel" value="' . $arr["sede_tel"] . '"></input>&nbsp;&nbsp;/&nbsp;';
    print '        <input type="text" size="18" name="sede_fax" value="' . $arr["sede_fax"] . '"></input>';
    print '    </td>';
    print '</tr>';
    print '</table>';

    print '&nbsp;<img src="../icone/freccia.png" width="15" height="15" border="0" vspace="2" align="absmiddle"> Informazioni altra sede';

    print '<table width="90%" cellpadding="1" cellspacing="5" border="0">';
    print '<tr>';
    print '    <td align="right" valign="middle"><font size="2" face="arial,helvetica">Indirizzo e numero civico:</font></td>';
    print '    <td align="left" valign="middle">';
    print '        <input type="text" size="34" name="altre_indirizzo" value="' . $arr["sede_via_2"] . '"></input>';
    print '        <input type="text" size="4" name="altre_civico" value="' . $arr["sede_civico_2"] . '"></input>';
    print '    </td>';
    print '</tr>';
    print '<tr>';
    print '    <td align="right" valign="middle"><font size="2" face="arial,helvetica">Citt&aacute;, Provincia e CAP:</font></td>';
    print '    <td align="left" valign="middle">';
    print '        <input type="text" size="25" name="altre_citta" value="' . $arr["sede_citta_2"] . '"></input>&nbsp;(&nbsp;';
    print '        <input type="text" size="2" name="altre_prov" value="' . $arr["sede_prov_2"] . '"></input>&nbsp;)&nbsp;&nbsp;&nbsp;';
    print '        <input type="text" size="5" name="altre_cap" value="' . $arr["sede_cap_2"] . '"></input>';
    print '    </td>';
    print '</tr>';
    print '<tr>';
    print '    <td align="right" valign="middle"><font size="2" face="arial,helvetica">Stato:</font></td>';
    print '    <td align="left" valign="middle"><input type="text" size="40" name="altre_stato" value="' . $arr["sede_stato_2"] . '"></input></td>';
    print '</tr>';
    print '<tr>';
    print '	<td align="right" valign="middle"><font size="2" face="arial,helvetica">Telefono/Fax:</font></td>';
    print '	<td align="left" valign="middle">';
    print '	    <input type="text" size="18" name="altre_tel" value="' . $arr["sede_tel_2"] . '"></input>&nbsp;&nbsp;/&nbsp;';
    print '         <input type="text" size="18" name="altre_fax" value="' . $arr["sede_fax_2"] . '"></input>';
    print '	</td>';
    print '</tr>';
    print '</table>';

    print '&nbsp;<img src="../icone/freccia.png" width="15" height="15" border="0" vspace="2" align="absmiddle"> Attivit&agrave; della ditta';

    print '<table width="90%" cellpadding="1" cellspacing="5" border="0">';
    print '<tr>';
    print '     <td align="right" valign="top"><font size="2" face="arial,helvetica">Descrizione attivit&agrave:</font></td>';
    print '	<td><textarea name="attivita" rows="5" cols="38">' . $arr["attivita"] . '</textarea></td>';
    print '</tr>';
    print '</table>';

    print '<input type="hidden" name="tipo" value="' . $tipo . '"></input>';
    print '<input type="hidden" name="oid" value="' . $oid . '"></input>';
    print '<input type="submit" value="Salva modifiche"></input>&nbsp;<input type="reset" value="Annulla modifiche"></input>';
    print '</form>';

    if ($tipo=='r') {
        print '<form action="clienti_abilita.php">';
        print '    <input type="hidden" name="tipo" value="' . $tipo . '"></input>';
        print '    <input type="hidden" name="oid" value="' . $oid . '"></input>';
        print '    <input type="submit" value="Abilita"></input>';
        print '</form>';
    }
    
    // chiudo la connessione
    pg_close ($conn);
?>

</body>
</html>