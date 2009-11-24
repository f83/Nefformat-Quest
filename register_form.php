<?php
require_once("./admin/connect.inc.php");
?>
<h3>Все поля обязательны для заполнения!</h3>
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
mysql_close($dbcnx);
?>