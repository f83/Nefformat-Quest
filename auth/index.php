<?php

/*

���������� � ���� �� ����
http://forum.pyha.ru/

*/

session_start();

include ('mysql.php');


// ���� ������������ �� �����������

if (!isset($_SESSION['id']))
{
	// �� ��������� ��� ����
	// ����� ��� ���� ����� � ������ � ������ �������

	if (isset($_COOKIE['login']) && isset($_COOKIE['password']))
	{
		// ���� �� ����� �������
		// �� ������� ������������ ������������ �� ���� ������ � ������
		$login = mysql_escape_string($_COOKIE['login']);
		$password = mysql_escape_string($_COOKIE['password']);

		// � �� �������� � ������������ ����� �����:

		// ������ ������ � ��
		// � ���� ����� � ����� ������� � �������

		$query = "SELECT `id`
					FROM `users`
					WHERE `login`='{$login}' AND `password`='{$password}'
					LIMIT 1";
		$sql = mysql_query($query) or die(mysql_error());

		// ���� ����� ������������ �������
		if (mysql_num_rows($sql) == 1)
		{
			// �� �� ������ �� ���� ����� � ������ (�������� �� ����� ������� ID ������������)

			$row = mysql_fetch_assoc($sql);
			$_SESSION['user_id'] = $row['id'];

			// �� ��������, ��� ��� ������ � ����������� �������, � ��� � ������ ������� ������ �������������� session_start();
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
	
	// ���� ���� ����� ������ � �������������
	// �� ����� ������� ��� ���� �� ����� �� �����.. =)
	// �� ���� ��� ����� ID, ������������� � ������, ����� �� ��� ������
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
	$welcome = '�����';
}

print '<h3>�������, ' . $welcome . '.</h3>

<a href="closed.php">�������� ��������</a><br />';


if (!isset($_SESSION['user_id']))
{
	print '<a href="login.php">�����������</a><br />';
	print '<a href="register.php">�����������</a><br />';
}
else
{
	print '<a href="login.php?logout">�����</a><br />';
}

print '<p><small>* ��� ����������� ������������ �����: <b>md5</b> � ������: <b>password</b></small></p>';


?>