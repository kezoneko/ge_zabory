<?php
include("db.php");

if($_SESSION['admin']){
	header("Location: admin.php");
	exit;
}
if($_POST['submit']){
	// Выборка из базы данных
	$usr_info = $connection->prepare('SELECT login FROM users WHERE login = :login AND pass = :pass');
	$usr_info->execute([
		'login' => $_POST['user'],
		'pass' => md5($_POST['pass'])
	]);
	$user = $usr_info->fetch(PDO::FETCH_ASSOC);
	if(!empty($user['login'])){
		$_SESSION['admin'] = $user['login'];
		header("Location: admin.php");
		exit;
	} else echo '<p>Логин или пароль неверны!</p>';
}
?>
<p><a href="admin.php">Админка</a> <a href="../index.html">Сайт</a></p>
<hr />
Это страница авторизации.
<br />
<form method="post">
	Логин: <input type="text" name="user" /><br />
	Пароль: <input type="password" name="pass" /><br />
	<input type="submit" name="submit" value="Войти" />
</form>
<?php
/* для дешифрации пароля */
//echo md5('mypass');
?>