<html>
<head><title>Admin zone!</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<p>include "admin_top.php";</p><hr>
<table border=1 width="100%" cellspacing="0" cellpadding="10">
<tr><td width="25%"> <!-- ЛЕВАЯ КОЛОНКА АДМИНКИ  -->

<ul>

   <li><a href="./?mode=gamez">ИГРЫ</a></li>
   <li><a href="./?mode=db_param">ПАРАМЕТРЫ БД</a></li>
   <li><a href="./?mode=prefs">НАСТРОЙКИ</a></li>

</ul>

</td>
<td> <!-- ЦЕНТРАЛЬНАЯ КОЛОНКА АДМИНКИ  -->


<?
if(!@file_exists("config.inc.php")) { $_GET['mode']="db_param"; }

switch ($_GET['mode']) {

case "gamez": 
require ("gamez.inc.php");
break;
case "db_param": 
require ("db_param.inc.php");
break;
case "prefs": 
require ("prefs.inc.php");
break;

}
?>

</td></tr>
</table>

<?php

require_once "connect.inc.php";

?>


<hr><p>include "admin_bottom.php";</p>
</body></html>
