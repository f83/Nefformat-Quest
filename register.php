<?php
/*
** Функция для генерации соли, используемоей в хешировании пароля
** возращает 3 случайных символа
*/

function GenerateSalt($n=3)
{
	$key = '';
	$pattern = '1234567890abcdefghijklmnopqrstuvwxyz.,*_-=+';
	$counter = strlen($pattern)-1;
	for($i=0; $i<$n; $i++)
	{
		$key .= $pattern{rand(0,$counter)};
	}
	return $key;
}

if (empty($_POST))
{
	?>
<h3>Все поля обязательны для заполнения!</h3>
<center>
<form action="index.php?section=registration" method="post">
<table width="30%">
<tr>
<td>Login:</td><td><input type="text" name="login" maxlength="20" /></td>
</tr><tr>
<td>Пароль:</td><td><input type="password" name="password" maxlength="20" /></td>
</tr><tr>
<td>Повтор пароля:</td><td><input type="password" name="password2" maxlength="20" /></td>
</tr><tr>
<td>Адрес E-Mail:</td><td><input type="text" name="email" maxlength="20" /></td>
</tr><tr>
<td>Имя:</td><td><input type="text" name="fname" maxlength="20" /></td>
</tr><tr>
<td>Фамилия: </td><td><input type="text" name="sname" maxlength="20" /></td>
</tr><tr>
<td>Пол: </td><td><input type="radio" name="gender" value="1"  checked="checked"/>М
<input type="radio" name="gender" value="0"  />Ж</td>
</tr><tr>
<td>Роль в команде: </td><td><select name="role">
<?php
$sqlresult = mysql_query("SELECT * FROM roles");
$numrows = mysql_num_rows($sqlresult);

for ($i=1;$i<=$numrows;$i++){
$sqlrole = mysql_fetch_assoc($sqlresult);
echo "<option value=\"".$sqlrole['id']."\">".$sqlrole['role']."</option>";
}

?>

</select></td>
</tr><tr>
<td></td><td></td>
</table>
<center><input type="submit" value="Зарегистрироваться" /></center>

<input type="hidden" name="action" value="register">
</form>
</center>




	
	<?php
}
else
{
	// обрабатывае пришедшие данные функцией mysql_real_escape_string перед вставкой в таблицу БД
	
	$login = (isset($_POST['login'])) ? mysql_real_escape_string($_POST['login']) : '';
	$password = (isset($_POST['password'])) ? mysql_real_escape_string($_POST['password']) : '';
	$password2 = (isset($_POST['password2'])) ? mysql_real_escape_string($_POST['password2']) : '';
    $email = (isset($_POST['email'])) ? mysql_real_escape_string($_POST['email']) : '';
	$fname = (isset($_POST['fname'])) ? mysql_real_escape_string($_POST['fname']) : '';
	$sname = (isset($_POST['sname'])) ? mysql_real_escape_string($_POST['sname']) : '';
	$gender = (isset($_POST['gender'])) ? mysql_real_escape_string($_POST['gender']) : '';
	$role = (isset($_POST['role'])) ? mysql_real_escape_string($_POST['role']) : '';
	
	// проверяем на наличие ошибок (например, длина логина и пароля)
	
	$error = false;
	$errort = '';
	
	if (strlen($login) < 2)
	{
		$errort .= '<br />Длина логина должна быть не менее 2х символов.<br />';
	}
	if (strlen($password) < 6)
	{
		$errort .= '<br />Длина пароля должна быть не менее 6 символов.<br />';
	}
if ($password2=="") $errort .= "<br />Не заполнено поле Повтор пароля!<br />";
if ($gender=="") $errort .= "<br />Не выбран пол!<br />";
if ($role=="") $errort .= "<br />Не выбрана роль в команде!<br />";
if ($password!=$password2)	$errort .="<br />Введёные пароли не совпадают!<br />";
if ($sname=="") $errort .= "<br />Не указана фамилия!<br />";
if ($fname=="")	$errort .="<br />Не указано имя!<br />";
if ($email=="")	$errort .="<br />Не указан E-mail!<br />";
	
	
	// проверяем, если юзер в таблице с таким же логином
	$query = "SELECT `id`
				FROM `players`
				WHERE `login`='{$login}'
				LIMIT 1";
	$sql = mysql_query($query) or die(mysql_error());
	if (mysql_num_rows($sql)==1)
	{
		$error = true;
		$errort .= '<br />Пользователь с таким логином уже существует в базе данных, введите другой.<br />';
	}
	$query = "SELECT `id`
				FROM `players`
				WHERE `email`='{$email}'
				LIMIT 1";
	$sql = mysql_query($query) or die(mysql_error());
	if (mysql_num_rows($sql)==1)
	{
		$error = true;
		$errort .= '<br />Пользователь с таким E-Mail уже существует в базе данных, введите другой или воспользуйтесь формой восстановлением пароля.
';
	}
	
	// если ошибок нет, то добавляем юзаре в таблицу
	
	if ($errort=="")
	{
		// генерируем соль и пароль
		
		$salt = GenerateSalt();
		$hashed_password = md5(md5($password) . $salt);
		
		$query = "INSERT
					INTO `players`
					SET
						`login`='{$login}',
						`password`='{$hashed_password}',
						`salt`='{$salt}',
						`email`='{$email}',
						`fname`='{$fname}',
						`sname`='{$sname}',
						`gender`={$gender},
						`role_id`={$role} ";
		$sql = mysql_query($query) or die(mysql_error());
		
		
		print '<h4>Поздравляем, Вы успешно зарегистрированы!</h4>';
	}
	else
	{
		print '<h4>Возникли следующие ошибки</h4>' . $errort;
	}
}

?>