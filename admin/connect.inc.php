<?php

if(@file_exists("./admin/config.inc.php")){require_once "./admin/config.inc.php";
// Устанавливаем соединение с базой данных   $dbcnx = @mysql_connect($dblocation,$dblogin,$dbpasswd);
  echo "<p> Connected to \"".$dblocation."\"</p>";   if(!$dbcnx)   {      echo "<p>В настоящий момент сервер базы данных не доступен...</p>";         }   if(! @mysql_select_db($dbname,$dbcnx) )   {      echo "<p>База данных не доступна...</p>";         }  echo "<p>\"".$dbname."\" Database opened</p>";  mysql_query("SET NAMES 'utf8' ");}?>
