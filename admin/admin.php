<?php
include("db.php");

if($_GET['do'] == 'logout'){
	unset($_SESSION['admin']);
	session_destroy();
}

if(!$_SESSION['admin']){
	header("Location: enter.php");
	exit;
}
// Определение запроса
if (isset($_REQUEST) && !empty($_REQUEST)) {
	$request = $_REQUEST;
}

/* СЛАЙДЕР ВЫБРАН ======================================= */
if ($request['mode'] == 'edit-slide') {
	$slider_info = $connection->prepare('SELECT adv_text FROM advantages WHERE id = :id');
	$slider_info->execute(['id' => $request['slider_id']]);
	$slider = $slider_info->fetch(PDO::FETCH_ASSOC);
	$content .= '
<div class="adm">
	<h3>Слайдер</h3>
	<form method="post">
		<textarea name="adv_text" rows="6" cols="100">' . $slider['adv_text'] . '</textarea>
		<input name="slider_id" type="hidden" value="' . $request['slider_id'] . '">
		<input name="mode" type="hidden" value="edit-slide-res">
		<input type="submit" value="Изменить">
	</form>
</div>
';
}
/* СЛАЙДЕР ВЫПОЛНЕНИЕ ======================================= */
elseif ($request['mode'] == 'edit-slide-res') {
	$slider_info = $connection->prepare("UPDATE advantages SET adv_text=:adv_text WHERE id = :id");
	$slider_info->bindParam(':adv_text', $request['adv_text']);
	$slider_info->bindParam(':id', $request['slider_id']);
	$slider_info->execute();
	if ($slider_info == true) {
		$content .= 'Успешно изменено';
	} else {
		$content .= 'Не изменено';
	}
}
/* ОБЩИЕ НАСТРОЙКИ ВЫПОЛНЕНИЕ ======================================= */
/* ADDRESS */
elseif ($request['mode'] == 'edit-sett-address') {
	$sett_info = $connection->prepare("UPDATE settings SET value=:value WHERE title = 'address'");
	$sett_info->bindParam(':value', $request['sett_address']);
	$sett_info->execute();
	if ($sett_info == true) {$content .= 'Адрес успешно изменен';} else {$content .= 'Адрес не изменен';}
}
/* EMAIL */
elseif ($request['mode'] == 'edit-sett-email') {
	$sett_info = $connection->prepare("UPDATE settings SET value=:value WHERE title='email'");
	$sett_info->bindParam(':value',$request['sett_email']);
	$sett_info->execute();
	if ($sett_info == true) {$content .= 'E-mail успешно изменен';} else {$content .= 'E-mail не изменен';}
}
/* PHONE */
elseif ($request['mode'] == 'edit-sett-phone') {
	$sett_info = $connection->prepare("UPDATE settings SET value=:value WHERE title = 'phone'");
	$sett_info->bindParam(':value', $request['sett_phone']);
	$sett_info->execute();
	if ($sett_info == true) {$content .= 'Номер телефона успешно изменен';} else {$content .= 'Номер телефона не изменен';}
}
/* WORKTIME */
elseif ($request['mode'] == 'edit-sett-worktime') {
	$sett_info = $connection->prepare("UPDATE settings SET value=:value WHERE title = 'worktime'");
	$sett_info->bindParam(':value', $request['sett_worktime']);
	$sett_info->execute();
	if ($sett_info == true) {$content .= 'Время работы успешно изменено';} else {$content .= 'Время работы не изменено';}
}
/* СЛАЙДЕР-ПРЕИМУЩЕСТВА ВЫБРАН ======================================= */
elseif ($request['mode'] == 'edit-slide2') {
	$slider2_info = $connection->prepare('SELECT adv_text, icon FROM advantages WHERE id = :id');
	$slider2_info->execute(['id' => $request['slider2_id']]);
	$slider2 = $slider2_info->fetch(PDO::FETCH_ASSOC);
	$content .= '
<div class="adm">
	<h3>Преимущества</h3>
	<form method="post">
		<textarea name="adv_text" rows="6" cols="100">' . $slider2['adv_text'] . '</textarea><br>
		<input name="icon" type="text" size="80" value="' . $slider2['icon'] . '"><br>
		<input name="slider2_id" type="hidden" value="' . $request['slider2_id'] . '">
		<input name="mode" type="hidden" value="edit-slide2-res">
		<input type="submit" value="Изменить">
	</form>
</div>
';
}
/* СЛАЙДЕР-ПРЕИМУЩЕСТВА ВЫПОЛНЕНИЕ ======================================= */
elseif ($request['mode'] == 'edit-slide2-res') {
	$slider2_info = $connection->prepare("UPDATE advantages SET adv_text=:adv_text, icon=:icon WHERE id = :id");
	$slider2_info->bindParam(':adv_text', $request['adv_text']);
	$slider2_info->bindParam(':icon', $request['icon']);
	$slider2_info->bindParam(':id', $request['slider2_id']);
	$slider2_info->execute();
	if ($slider2_info == true) {
		$content .= 'Успешно изменено';
	} else {
		$content .= 'Не изменено';
	}
}
/* ПО УМОЛЧАНИЮ ======================================= */
else {
	// 1 Выборка из базы данных СЛАЙДЕР
	$slider_info = $connection->prepare('SELECT id, adv_text FROM advantages WHERE type = :type');
	$slider_info->execute(['type' => 1]);
	$content .= '
<div class="adm">
	<h3>Слайдеры</h3>
	<form method="post">
';
	while ($row = $slider_info->fetch(PDO::FETCH_ASSOC)) {
		$content .= '	<label><input name="slider_id" type="radio" value="' . $row['id'] . '"> ' . $row['adv_text'] . ';</label><br>
';
	}
	$content .= '	<input name="mode" type="hidden" value="edit-slide">
		<input type="submit" value="Редактировать">
	</form>
</div>
';
	// 2 Выборка из базы данных ОБЩИЕ НАСТРОЙКИ email, телефон, адрес и т.д.
	$sett_info = $connection->prepare('SELECT title, value FROM settings');
	$sett_info->execute();
	$sett_title = array('address' => 'Адрес', 'email' => 'E-mail', 'phone' => 'Номер телефона', 'worktime' => 'Время работы');
	$content .= '
<div class="adm2">
	<h3>Общая информация</h3>
';
	while ($row = $sett_info->fetch(PDO::FETCH_ASSOC)) {
		$content .= '
	<form method="post">
		<label>' . $sett_title[$row['title']] . ':<br><input name="sett_' . $row['title'] . '" type="text" size="80" value="' . $row['value'] . '"></label>
		<input name="mode" type="hidden" value="edit-sett-' . $row['title'] . '">
		<input type="submit" value="Изменить"><br>
	</form>
';
	}
	$content .= '
</div>
';
	// 3 Выборка из базы данных ???
	$content .= '
<div class="adm">
	<h3>???</h3>
	??? Не понял квеста
</div>
';
	// 4 Выборка из базы данных ПРЕИМУЩЕСТВА
	$slider2_info = $connection->prepare('SELECT id, adv_text FROM advantages WHERE type = :type');
	$slider2_info->execute(['type' => 2]);
	$content .= '
<div class="adm2">
	<h3>Преимущества</h3>
	<form method="post">
';
	while ($row = $slider2_info->fetch(PDO::FETCH_ASSOC)) {
		$content .= '	<label><input name="slider2_id" type="radio" value="' . $row['id'] . '"> ' . $row['adv_text'] . ';</label><br>
';
	}
	$content .= '	<input name="mode" type="hidden" value="edit-slide2">
		<input type="submit" value="Редактировать">
	</form>
</div>
';
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="wrapper">
		<p><a href="admin.php">Админка</a> <a href="../index.html">Сайт</a></p>
		<hr />
		Это страница администрации <strong><?= $_SESSION['admin'] ?></strong>[<a href="admin.php?do=logout">Выход</a>]
		<hr />
		<?= $content ?>
	</div>
</body>
</html>