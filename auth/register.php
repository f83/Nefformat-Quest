<?php

session_start();

include ('mysql.php');

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
	
<h3>Введи Ваши данные</h3>
Все поля обязательны для заполнения!
<form action="register.php" method="post">
<p>
Login: 
<input type="text" name="login" maxlength="20" />
</p> 
<p>
Пароль: 
<input type="password" name="password" maxlength="20" />
</p> 
<p>
Повтор пароля: 
<input type="password" name="password2" maxlength="20" />
</p> 
<p>
Адрес E-Mail: 
<input type="text" name="email" maxlength="20" />
</p> 
<p>
Имя: 
<input type="text" name="fname" maxlength="20" />
</p> 
<p>
Фамилия: 
<input type="text" name="sname" maxlength="20" />
</p> 
<p>
Пол: 
<input type="radio" name="gender" value="1"  checked="checked"/>М
<input type="radio" name="gender" value="0"  />Ж
</p> 

<p>
Роль в команде: 
<select name="role">
<?php
$sqlresult = mysql_query("SELECT * FROM roles");
$numrows = mysql_num_rows($sqlresult);

for ($i=1;$i<=$numrows;$i++){
$sqlrole = mysql_fetch_assoc($sqlresult);
echo "<option value=\"".$sqlrole['id']."\">".$sqlrole['role']."</option>";
}

?>

</select>
</p> 

<p>
<input type="submit" value="Зарегистрироваться" />
</p> 
</form>




	
	<?php
}
else
{
	// обрабатывае пришедшие данные функцией mysql_real_escape_string перед вставкой в таблицу БД
	
	$login = (isset($_POST['login'])) ? mysql_real_escape_string($_POST['login']) : '';
	$password = (isset($_POST['password'])) ? mysql_real_escape_string($_POST['password']) : '';
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
		$error = true;
		$errort .= 'Длина логина должна быть не менее 2х символов.<br />';
	}
	if (strlen($password) < 6)
	{
		$error = true;
		$errort .= 'Длина пароля должна быть не менее 6 символов.<br />';
	}
	
	// проверяем, если юзер в таблице с таким же логином
	$query = "SELECT `id`
				FROM `players`
				WHERE `login`='{$login}'
				LIMIT 1";
	$sql = mysql_query($query) or die(mysql_error());
	if (mysql_num_rows($sql)==1)
	{
		$error = true;
		$errort .= 'Пользователь с таким логином уже существует в базе данных, введите другой.<br />';
	}
	
	
	// если ошибок нет, то добавляем юзаре в таблицу
	
	if (!$error)
	{
		// генерируем соль и пароль
		
		$salt = GenerateSalt();
		$hashed_password = md5(md5($password) . $salt);
		
		$query = "INSERT
					INTO `players`
					SET
						`login`='{$login}',
						`password`='{$hashed_password}',
						`salt`='{$salt}'";
		$sql = mysql_query($query) or die(mysql_error());
		
		
		print '<h4>Поздравляем, Вы успешно зарегистрированы!</h4><a href="login.php">Авторизоваться</a>';
	}
	else
	{
		print '<h4>Возникли следующие ошибки</h4>' . $errort;
	}
}

?>