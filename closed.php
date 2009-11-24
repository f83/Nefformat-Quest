<?php

session_start();

if (isset($_SESSION['player_id']))
{
	// показываем защищенные от гостей данные.
	
	print '<h1>Здрасте! '.$_SESSION['player_id'].'</h1>
	<p>Это закрытая страница.</p>
	<p><a href="index.php">Перейти на главную</a></p>';
}
else
{
	die('Доступ закрыт, даём ссылку на авторизацию. — <a href="login.php">Авторизоваться</a>');
}


?>