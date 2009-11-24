<?php

/*

приложение к ФАКу на ПЫХЕ
http://forum.pyha.ru/

*/

session_start();

include ('mysql.php');


// если пользователь не авторизован

if (!isset($_SESSION['id']))
{
	// то проверяем его куки
	// вдруг там есть логин и пароль к нашему скрипту

	if (isset($_COOKIE['login']) && isset($_COOKIE['password']))
	{
		// если же такие имеются
		// то пробуем авторизовать пользователя по этим логину и паролю
		$login = mysql_escape_string($_COOKIE['login']);
		$password = mysql_escape_string($_COOKIE['password']);

		// и по аналогии с авторизацией через форму:

		// делаем запрос к БД
		// и ищем юзера с таким логином и паролем

		$query = "SELECT `id`
					FROM `users`
					WHERE `login`='{$login}' AND `password`='{$password}'
					LIMIT 1";
		$sql = mysql_query($query) or die(mysql_error());

		// если такой пользователь нашелся
		if (mysql_num_rows($sql) == 1)
		{
			// то мы ставим об этом метку в сессии (допустим мы будем ставить ID пользователя)

			$row = mysql_fetch_assoc($sql);
			$_SESSION['user_id'] = $row['id'];

			// не забываем, что для работы с сессионными данными, у нас в каждом скрипте должно присутствовать session_start();
		}
	}
}



if (isset($_SESSION['user_id']))
{
	$query = "SELECT `login`
				FROM `users`
				WHERE `id`='{$_SESSION['user_id']}'
				LIMIT 1";
	$sql = mysql_query($query) or die(mysql_error());
	
	// если нету такой записи с пользователем
	// ну вдруг удалили его пока он лазил по сайту.. =)
	// то надо ему убить ID, установленный в сессии, чтобы он был гостем
	if (mysql_num_rows($sql) != 1)
	{
		header('Location: login.php?logout');
		exit;
	}
	
	$row = mysql_fetch_assoc($sql);
	
	$welcome = $row['login'];
}
else
{
	$welcome = 'гость';
}

print '<h3>Здрасте, ' . $welcome . '.</h3>

<a href="closed.php">Закрытая страница</a><br />';


if (!isset($_SESSION['user_id']))
{
	print '<a href="login.php">Авторизация</a><br />';
	print '<a href="register.php">Регистрация</a><br />';
}
else
{
	print '<a href="login.php?logout">Выход</a><br />';
}

print '<p><small>* Для авторизации использовать логин: <b>md5</b> и пароль: <b>password</b></small></p>';


?>