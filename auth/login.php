<?php

session_start();

include ('mysql.php');

if (isset($_GET['logout']))
{
	if (isset($_SESSION['user_id']))
		unset($_SESSION['user_id']);
		
	setcookie('login', '', 0, "/");
	setcookie('password', '', 0, "/");
	// и переносим его на главную
	header('Location: index.php');
	exit;
}

if (isset($_SESSION['user_id']))
{
	// юзер уже залогинен, перекидываем его отсюда на закрытую страницу
	
	header('Location: closed.php');
	exit;

}



if (!empty($_POST))
{
	$login = (isset($_POST['login'])) ? mysql_real_escape_string($_POST['login']) : '';
	
	$query = "SELECT `salt`
				FROM `users`
				WHERE `login`='{$login}'
				LIMIT 1";
	$sql = mysql_query($query) or die(mysql_error());
	
	if (mysql_num_rows($sql) == 1)
	{
		$row = mysql_fetch_assoc($sql);
		
		// итак, вот она соль, соответствующа€ этому логину:
		$salt = $row['salt'];
		
		// теперь хешируем введенный пароль как надо и повтор€м шаги, которые были описаны выше:
		$password = md5(md5($_POST['password']) . $salt);
		
		// и пошло поехало...

		// делаем запрос к Ѕƒ
		// и ищем юзера с таким логином и паролем

		$query = "SELECT `id`
					FROM `users`
					WHERE `login`='{$login}' AND `password`='{$password}'
					LIMIT 1";
		$sql = mysql_query($query) or die(mysql_error());

		// если такой пользователь нашелс€
		if (mysql_num_rows($sql) == 1)
		{
			// то мы ставим об этом метку в сессии (допустим мы будем ставить ID пользовател€)

			$row = mysql_fetch_assoc($sql);
			$_SESSION['user_id'] = $row['id'];
			
			
			// если пользователь решил "запомнить себ€"
			// то ставим ему в куку логин с хешем парол€
			
			$time = 86400; // ставим куку на 24 часа
			
			if (isset($_POST['remember']))
			{
				setcookie('login', $login, time()+$time, "/");
				setcookie('password', $password, time()+$time, "/");
			}
			
			// и перекидываем его на закрытую страницу
			header('Location: closed.php');
			exit;

			// не забываем, что дл€ работы с сессионными данными, у нас в каждом скрипте должно присутствовать session_start();
		}
		else
		{
			die('“акой логин с паролем не найдены в базе данных. » даЄм ссылку на повторную авторизацию. Ч <a href="login.php">јвторизоватьс€</a>');
		}
	}
	else
	{
		die('пользователь с таким логином не найден, даЄм ссылку на повторную авторизацию. Ч <a href="login.php">јвторизоватьс€</a>');
	}
}

print '
<form action="login.php" method="post">
	<table>
		<tr>
			<td>Ћогин:</td>
			<td><input type="text" name="login" /></td>
		</tr>
		<tr>
			<td>ѕароль:</td>
			<td><input type="password" name="password" /></td>
		</tr>
		<tr>
			<td>«апомнить:</td>
			<td><input type="checkbox" name="remember" /></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value="јвторизоватьс€" /></td>
		</tr>
	</table>
</form>
';

?>