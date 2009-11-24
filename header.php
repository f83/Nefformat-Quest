<?php
include ('mysql.php');
session_start();

if (isset($_GET['logout']))
{
	if (isset($_SESSION['player_id']))
		unset($_SESSION['player_id']);
		
	setcookie('login', '', 0, "/");
	setcookie('password', '', 0, "/");
	// и переносим его на главную
	header('Location: index.php');
	exit;	
}

if (!empty($_POST))
{
	$login = (isset($_POST['login'])) ? mysql_real_escape_string($_POST['login']) : '';
	
	$query = "SELECT `salt`
				FROM `players`
				WHERE `login`='{$login}'
				LIMIT 1";
	$sql = mysql_query($query) or die(mysql_error());
	
	if (mysql_num_rows($sql) == 1)
	{
		$row = mysql_fetch_assoc($sql);
		
		// итак, вот она соль, соответствующая этому логину:
		$salt = $row['salt'];
		
		// теперь хешируем введенный пароль как надо и повторям шаги, которые были описаны выше:
		$password = md5(md5($_POST['password']) . $salt);
		
		// и пошло поехало...

		// делаем запрос к БД
		// и ищем юзера с таким логином и паролем

		$query = "SELECT `id`
					FROM `players`
					WHERE `login`='{$login}' AND `password`='{$password}'
					LIMIT 1";
		$sql = mysql_query($query) or die(mysql_error());

		// если такой пользователь нашелся
		if (mysql_num_rows($sql) == 1)
		{
			// то мы ставим об этом метку в сессии (допустим мы будем ставить ID пользователя)

			$row = mysql_fetch_assoc($sql);
			$_SESSION['player_id'] = $row['id'];
			
			
			// если пользователь решил "запомнить себя"
			// то ставим ему в куку логин с хешем пароля
			
			if (isset($_POST['remember']))
			{
				echo "Пользователь попросил поставить ему куки";
				$time = 86400; // ставим куку на 24 часа
				setcookie('login', $login, time()+$time, "/");
				setcookie('password', $password, time()+$time, "/");
			}
			
			// и перекидываем его на закрытую страницу
			//header('Location: closed.php');
			//exit;


			// не забываем, что для работы с сессионными данными, у нас в каждом скрипте должно присутствовать session_start();
		}
		else
		{
			$errorlogin='Такой логин с паролем не найдены в базе данных.<br />';
		}
	}
	else
	{
			$errorlogin='Такой логин с паролем не найдены в базе данных.<br />';
//die('пользователь с таким логином не найден, даём ссылку на повторную авторизацию. — <a href="login.php">Авторизоваться</a>');
	}
}
			


			echo $_COOKIE['login']." ".$_COOKIE['password'];
	if (!empty($_COOKIE)) {
			$login = (isset($_COOKIE['login'])) ? mysql_real_escape_string($_COOKIE['login']) : '';
			$password = (isset($_COOKIE['password'])) ? mysql_real_escape_string($_COOKIE['password']) : '';
			$query = "SELECT `id`
				FROM `players`
				WHERE `login`='{$login}' AND `password`='{$password}'
				LIMIT 1";
	$sql = mysql_query($query) or die(mysql_error());
	if (mysql_num_rows($sql) == 1)
		{
			// то мы ставим об этом метку в сессии (допустим мы будем ставить ID пользователя)
			$row = mysql_fetch_assoc($sql);
			$_SESSION['player_id'] = $row['id'];
			unset($login,$password,$row,$query);
			}
	}



?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Quest Nefformat.RU
</title>
</head>

<body bgcolor="#444444" text="#FFFFFF" topmargin="0" leftmargin="0" rightmargin="3" marginwidth="0" marginheight="0">
