<? if (file_exists('../default.php')) { include '../default.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title>Lamda Informatica Web Site</title>
    <link rel="stylesheet" href="../lamda.css">
</head>
<body text="black" bgcolor="white" link="#ffa000" alink="#ffa000" vlink="#ffa000" leftmargin="0" topmargin="0">

<div align="left">
<font face="arial,helvetica,sans-serif" size="2">
    <h4>Gestione Web</h4>
    <ul>
        <li><a href="listino_elenca.php">Elenca articoli nel listino</a>
        <li><a href="categorie_elenca.php">Elenco categorie</a>
        <br><br>
        <li>Elenco accessi
        <br><br>
        <li><a href="clienti_elenca.php?tipo=r">Elenco clienti in attesa di registrazione</a>
        <li><a href="clienti_elenca.php?tipo=a">Elenco clienti gi&agrave; attivati</a>
        <br><br>        
    </ul>
</font>
</div>

</body>
</html>