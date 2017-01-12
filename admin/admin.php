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
	$content = '
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
		$content = 'Успешно изменено';
	} else {
		$content = 'Не изменено';
	}
}
/* ОБЩИЕ НАСТРОЙКИ ВЫПОЛНЕНИЕ ======================================= */
/* ADDRESS */
elseif ($request['mode'] == 'edit-sett-address') {
	$sett_info = $connection->prepare("UPDATE settings SET value=:value WHERE title = 'address'");
	$sett_info->bindParam(':value', $request['sett_address']);
	$sett_info->execute();
	if ($sett_info == true) {$content = 'Адрес успешно изменен';} else {$content = 'Адрес не изменен';}
}
/* EMAIL */
elseif ($request['mode'] == 'edit-sett-email') {
	$sett_info = $connection->prepare("UPDATE settings SET value=:value WHERE title='email'");
	$sett_info->bindParam(':value',$request['sett_email']);
	$sett_info->execute();
	if ($sett_info == true) {$content = 'E-mail успешно изменен';} else {$content = 'E-mail не изменен';}
}
/* PHONE */
elseif ($request['mode'] == 'edit-sett-phone') {
	$sett_info = $connection->prepare("UPDATE settings SET value=:value WHERE title = 'phone'");
	$sett_info->bindParam(':value', $request['sett_phone']);
	$sett_info->execute();
	if ($sett_info == true) {$content = 'Номер телефона успешно изменен';} else {$content = 'Номер телефона не изменен';}
}
/* WORKTIME */
elseif ($request['mode'] == 'edit-sett-worktime') {
	$sett_info = $connection->prepare("UPDATE settings SET value=:value WHERE title = 'worktime'");
	$sett_info->bindParam(':value', $request['sett_worktime']);
	$sett_info->execute();
	if ($sett_info == true) {$content = 'Время работы успешно изменено';} else {$content = 'Время работы не изменено';}
}
/* СЛАЙДЕР-ПРЕИМУЩЕСТВА ВЫБРАН ======================================= */
elseif ($request['mode'] == 'edit-slide2') {
	$slider2_info = $connection->prepare('SELECT adv_text, icon FROM advantages WHERE id = :id');
	$slider2_info->execute(['id' => $request['slider2_id']]);
	$slider2 = $slider2_info->fetch(PDO::FETCH_ASSOC);
	$content = '
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
		$content = 'Успешно изменено';
	} else {
		$content = 'Не изменено';
	}
}
/* ФОРМА ВЫБРАНА ======================================= */
elseif ($request['mode'] == 'edit-form') {
	$form_info = $connection->prepare('SELECT title, button FROM forms WHERE id = :id');
	$form_info->execute(['id' => $request['form_id']]);
	$form = $form_info->fetch(PDO::FETCH_ASSOC);
	$content = '
<div class="adm">
	<h3>Форма</h3>
	<form method="post">
		<input name="title" type="text" size="80" value="' . $form['title'] . '"><br>
		<input name="button" type="text" size="80" value="' . $form['button'] . '"><br>
		<input name="form_id" type="hidden" value="' . $request['form_id'] . '">
		<input name="mode" type="hidden" value="edit-form-res">
		<input type="submit" value="Изменить">
	</form>
</div>
';
}
/* ФОРМА ВЫПОЛНЕНИЕ ======================================= */
elseif ($request['mode'] == 'edit-form-res') {
	$form_info = $connection->prepare("UPDATE forms SET title=:title, button=:button WHERE id = :id");
	$form_info->bindParam(':title', $request['title']);
	$form_info->bindParam(':button', $request['button']);
	$form_info->bindParam(':id', $request['form_id']);
	$form_info->execute();
	if ($form_info == true) {
		$content = 'Успешно изменено';
	} else {
		$content = 'Не изменено';
	}
}
/* ВИД ЗАБОРА ВЫБРАН ======================================= */
elseif ($request['mode'] == 'edit-fence-types') {
	$fence_types_info = $connection->prepare('SELECT title, description, text, image FROM fence_types WHERE id = :id');
	$fence_types_info->execute(['id' => $request['fence_type_id']]);
	$fence_types = $fence_types_info->fetch(PDO::FETCH_ASSOC);
	$content = '
<div class="adm">
	<h3>Вид забора</h3>
	<form method="post">
		<input name="title" type="text" size="80" value="' . $fence_types['title'] . '"><br>
		<textarea name="description" rows="6" cols="100">' . $fence_types['description'] . '</textarea><br>
		<textarea name="text" rows="6" cols="100">' . $fence_types['text'] . '</textarea><br>
		<input name="image" type="text" size="80" value="' . $fence_types['image'] . '"><br>
		<input name="fence_types_id" type="hidden" value="' . $request['fence_type_id'] . '">
		<input name="mode" type="hidden" value="edit-fence-types-res">
		<input type="submit" value="Изменить">
	</form>
</div>
';
}
/* ФОРМА ВЫПОЛНЕНИЕ ======================================= */
elseif ($request['mode'] == 'edit-fence-types-res') {
	$fence_types_info = $connection->prepare("UPDATE fence_types SET title=:title, description=:description, text=:text, image=:image WHERE id = :id");
	$fence_types_info->bindParam(':title', $request['title']);
	$fence_types_info->bindParam(':description', $request['description']);
	$fence_types_info->bindParam(':text', $request['text']);
	$fence_types_info->bindParam(':image', $request['image']);
	$fence_types_info->bindParam(':id', $request['fence_types_id']);
	$fence_types_info->execute();
	if ($fence_types_info == true) {
		$content = 'Успешно изменено';
	} else {
		$content = 'Не изменено';
	}
}
/* КЛИЕНТЫ ВЫБРАН ======================================= */
elseif ($request['mode'] == 'edit-clients') {
	$clients_info = $connection->prepare('SELECT adv_text FROM advantages WHERE id = :id');
	$clients_info->execute(['id' => $request['clients_id']]);
	$clients = $clients_info->fetch(PDO::FETCH_ASSOC);
	$content = '
<div class="adm">
	<h3>Клиенты</h3>
	<form method="post">
		<textarea name="adv_text" rows="6" cols="100">' . $clients['adv_text'] . '</textarea>
		<input name="clients_id" type="hidden" value="' . $request['clients_id'] . '">
		<input name="mode" type="hidden" value="edit-clients-res">
		<input type="submit" value="Изменить">
	</form>
</div>
';
}
/* КЛИЕНТЫ ВЫПОЛНЕНИЕ ======================================= */
elseif ($request['mode'] == 'edit-clients-res') {
	$clients_info = $connection->prepare("UPDATE advantages SET adv_text=:adv_text WHERE id = :id");
	$clients_info->bindParam(':adv_text', $request['adv_text']);
	$clients_info->bindParam(':id', $request['clients_id']);
	$clients_info->execute();
	if ($clients_info == true) {
		$content = 'Успешно изменено';
	} else {
		$content = 'Не изменено';
	}
}
/* ГАЛЕРЕЯ ВЫБРАН ======================================= */
elseif ($request['mode'] == 'edit-gallery') {
	$gallery_info = $connection->prepare('SELECT title, image FROM gallery WHERE id = :id');
	$gallery_info->execute(['id' => $request['gallery_id']]);
	$gallery = $gallery_info->fetch(PDO::FETCH_ASSOC);
	$content = '
<div class="adm">
	<h3>Галерея</h3>
	<form method="post">
		<input name="title" type="text" size="80" value="' . $gallery['title'] . '"><br>
		<input name="image" type="text" size="80" value="' . $gallery['image'] . '"><br>
		<input name="gallery_id" type="hidden" value="' . $request['gallery_id'] . '">
		<input name="mode" type="hidden" value="edit-gallery-res">
		<input type="submit" value="Изменить">
	</form>
</div>
';
}
/* ГАЛЕРЕЯ ВЫПОЛНЕНИЕ ======================================= */
elseif ($request['mode'] == 'edit-gallery-res') {
	$gallery_info = $connection->prepare("UPDATE gallery SET title=:title, image=:image WHERE id = :id");
	$gallery_info->bindParam(':title', $request['title']);
	$gallery_info->bindParam(':image', $request['image']);
	$gallery_info->bindParam(':id', $request['gallery_id']);
	$gallery_info->execute();
	if ($gallery_info == true) {
		$content = 'Успешно изменено';
	} else {
		$content = 'Не изменено';
	}
}
/* ПО УМОЛЧАНИЮ ======================================= */
else {
	// 1 Выборка из базы данных СЛАЙДЕР
	$slider_info = $connection->prepare('SELECT id, adv_text FROM advantages WHERE type = :type');
	$slider_info->execute(['type' => 1]);
	$content = '
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
	// 5 Выборка из базы данных ФОРМЫ
	$form_info = $connection->prepare('SELECT id, title FROM forms');
	$form_info->execute();
	$content .= '
<div class="adm">
	<h3>Формы</h3>
	<form method="post">
';
	while ($row = $form_info->fetch(PDO::FETCH_ASSOC)) {
		$content .= '	<label><input name="form_id" type="radio" value="' . $row['id'] . '"> ' . $row['title'] . ';</label><br>
';
	}
	$content .= '	<input name="mode" type="hidden" value="edit-form">
		<input type="submit" value="Редактировать">
	</form>
</div>
';
	// 6 Выборка из базы данных ВИДЫ ОГРАЖДЕНИЙ
	$fence_types_info = $connection->prepare('SELECT id, title FROM fence_types');
	$fence_types_info->execute();
	$content .= '
<div class="adm2">
	<h3>Виды ограждений</h3>
	<form method="post">
';
	while ($row = $fence_types_info->fetch(PDO::FETCH_ASSOC)) {
		$content .= '	<label><input name="fence_type_id" type="radio" value="' . $row['id'] . '"> ' . $row['title'] . ';</label><br>
';
	}
	$content .= '	<input name="mode" type="hidden" value="edit-fence-types">
		<input type="submit" value="Редактировать">
	</form>
</div>
';
	// 7 Выборка из базы данных КЛИЕНТЫ
	$clients_info = $connection->prepare('SELECT id, adv_text FROM advantages WHERE type = :type');
	$clients_info->execute(['type' => 3]);
	$content .= '
<div class="adm">
	<h3>Клиенты</h3>
	<form method="post">
';
	while ($row = $clients_info->fetch(PDO::FETCH_ASSOC)) {
		$content .= '	<label><input name="clients_id" type="radio" value="' . $row['id'] . '"> ' . $row['adv_text'] . ';</label><br>
';
	}
	$content .= '	<input name="mode" type="hidden" value="edit-clients">
		<input type="submit" value="Редактировать">
	</form>
</div>
';
	// 8 Выборка из базы данных ГАЛЕРЕЯ
	$gallery_info = $connection->prepare('SELECT id, title FROM gallery');
	$gallery_info->execute();
	$content .= '
<div class="adm2">
	<h3>Галерея</h3>
	<form method="post">
';
	while ($row = $gallery_info->fetch(PDO::FETCH_ASSOC)) {
		$content .= '	<label><input name="gallery_id" type="radio" value="' . $row['id'] . '"> ' . $row['title'] . ';</label><br>
';
	}
	$content .= '	<input name="mode" type="hidden" value="edit-gallery">
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