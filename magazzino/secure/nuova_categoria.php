<? if (file_exists('../../default.php'))
 { include '../../default.php'; } ?>

<? if (file_exists('../../procedure/utility.php'))
 { include '../../procedure/utility.php'; } ?>

<? if (file_exists('../../procedure/function_crea_categoria.php'))
 { include '../../procedure/function_crea_categoria.php'; } ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <link rel="stylesheet" href="../../stylesheet.css">
</head>
<body>

<? print_title('Crea categoria'); ?>

<?php
print '<br>';

$link='nuova_categoria_commit.php';
 
crea_categoria ($link);

print '<br>';
print'<a href="javascript:history.back(1)">Torna</a> allo schermo precedente.';
?>

</body>
</html>
