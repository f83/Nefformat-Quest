<?

if (@file_exists("config.inc.php")) {require_once("config.inc.php");}
echo $_POST["fdblogin"];
if (isset($_GET['save']))
{
$fileconf = fopen('./config.inc.php', 'w');
fputs($fileconf,"<?php");
fputs($fileconf,"?>");
fclose($fileconf);
}
?>
<h2>Параметры работы с базой данных:</h2>
<center>
<form action="./" method="post" enctype="text/plain">
<table border=1 width="50%" cellspacing="0"  cellpadding="10">

<tr>
<td>Хост:</td><td> <INPUT type="text" NAME="fdblocation" SIZE="30" value="<?=$dblocation;?>"> </td>
</tr><tr>
<td>Логин:</td><td> <INPUT type="text" NAME="fdblogin" SIZE="30" value="<?=$dblogin;?>"> </td>
</tr><tr>
<td>Пароль:</td><td> <INPUT type="text" NAME="fdbpasswd" SIZE="30" value="<?=$dbpasswd;?>"> </td>
</tr><tr>
<td>Имя БД:</td><td> <INPUT type="text" NAME="fdbname" SIZE="30" value="<?=$dbname;?>"> </td>
</tr><tr>
<td>Префикс таблиц:</td><td> <INPUT type="text" NAME="fdbpref" SIZE="30" value="<?=$dbpref;?>"> </td>
</tr>

</table>
<br />
<INPUT type=HIDDEN name="mode" type="text" VALUE="db_param">
<INPUT type=SUBMIT name="save" VALUE="Сохранить настройки">
</form>
</center>
