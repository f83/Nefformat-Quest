<?php
//Проверка введённых данных

$errormsg="";
if ($_POST['login']=="") $errormsg=$errormsg."Не заполнено поле Login!<br />";
if ($_POST['password']=="") $errormsg=$errormsg."Не заполнено поле Пароль!<br />";
if ($_POST['password2']=="") $errormsg=$errormsg."Не заполнено поле Повтор пароля!<br />";
if ($_POST['gender']=="") $errormsg=$errormsg."Не выбран пол!<br />";
if ($_POST['role']=="") $errormsg=$errormsg."Не выбрана роль в команде!<br />";
if ($_POST['password']!=$_POST['password2']) $errormsg=$errormsg."Введёные пароли не совпадают!<br />";
if (!ctype_alnum($_POST['login']) or !ctype_alnum($_POST['password']) or !ctype_alnum($_POST['fname']) or 
!ctype_alnum($_POST['sname']) or !is_numeric($_POST['gender']) or !is_numeric($_POST['role'])) 
$errormsg=$errormsg."Вводить можно только символы A-Z, a-z, 0-9!<br />";

echo $errormsg;
if ($errormsg !="") die('Вернитесь на страницу назад и перепроверьте введённые данные...');

//Создание записи в таблице

require_once("./admin/connect.inc.php"); 
$sqlresult = mysql_query("SELECT * FROM `players` where `login` = \"".$_POST['login']."\"");
if (mysql_num_rows($sqlresult)>0) die ("Логин ".$_POST['login']." уже существует");
$sqlresult = mysql_query("SELECT * FROM `players` where `email` =\"".$_POST['email']."\"");
if (mysql_num_rows($sqlresult)>0) die ("Пользователь с e-mail'ом ".$_POST['email']." уже существует");
$query = "INSERT INTO players (login,password,email,fname,sname,gender,role_id) VALUES ('".
$_POST['login']."', '".
md5(md5($_POST['password']))."', '".
$_POST['email']."', '".
$_POST['fname']."', '".
$_POST['sname']."', ".
$_POST['gender'].", ".
$_POST['role'].");";
echo $query;
mysql_query($query);



?>