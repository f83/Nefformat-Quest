<?php
if ($errorlogin!="") echo $errorlogin;
if (!isset($_SESSION['player_id'])) {
print '
<form action="index.php" method="post">
	<table>
		<tr>
			<td>Логин:</td>
			<td><input type="text" name="login" /></td>
		</tr>
		<tr>
			<td>Пароль:</td>
			<td><input type="password" name="password" /></td>
		</tr>
		<tr>
			<td>Запомнить:</td>
			<td><input type="checkbox" name="remember" /></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value="Авторизоваться" /></td>
		</tr>
	</table>
				<a href="index.php?section=registration">Регистрация</a>
</form>
';}
else 
{
				$sqlarrayplayer=mysql_fetch_assoc(mysql_query("SELECT `fname`, `sname`, `team_id` FROM `players` WHERE `id`={$_SESSION['player_id']} LIMIT 1;"));				
			echo $sqlarrayplayer['fname']." ".$sqlarrayplayer['sname']."<br />" ;
			
			if 	(isset ($sqlarrayplayer['team_id'])) {
			$sqlarray=mysql_fetch_assoc(mysql_query("SELECT `team` FROM `teams` WHERE `id`={$sqlarrayplayer['team_id']} LIMIT 1;")) or die(mysql_error());
			echo "Вы в команде <a href=index.php?section=teams&id={$sqlarrayplayer['team_id']}>{$sqlarray['team']}</a>";
			}
			else
			{
			echo "Вы не состоите ни в одной команде <br />";
			}			
				print '<br /><a href="index.php?logout">Выход</a><br />
					<a href="index.php?section=profile">Профиль</a><br />';
	}
?>