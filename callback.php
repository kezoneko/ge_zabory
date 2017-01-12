<?php
include 'admin/db.php';

$email_info = $connection->prepare('SELECT value FROM settings WHERE title = :title');
$email_info->execute(['title' => 'email']);
$email = $email_info->fetch(PDO::FETCH_ASSOC);
$recepient = $email['value'];
$sitename = "Первая линия";

$name = trim($_GET["name"]);
$theme = trim($_GET["theme"]);
$theme2 = trim($_GET["theme2"]);

$phone = trim($_GET["phone"]);
$message = trim($_GET["message"]);

// Дополнительные переменные из калькулятора
if(
	isset($_GET["length"]) && !empty($_GET['length']) &&
	isset($_GET["gates"]) && !empty($_GET['length']) &&
	isset($_GET["wickets"]) && !empty($_GET['length'])
) {
	$length = trim($_GET["length"]);
	$gates = trim($_GET["gates"]);
	$wickets = trim($_GET["wickets"]);

	if(isset($_GET['fence'])) {
		$fence = $_GET["fence"];
		$fence = implode(', ', $fence);
	}
	if(isset($_GET['height'])) {
		$height = $_GET["height"];
	}
	if(isset($_GET['gatestype'])) {
		$gatestype = $_GET["gatestype"];
	}
}
else {
	$fence = '';
	$height = '';
	$length = '';
	$gatestype = '';
	$gates = '';
	$wickets = '';
}

if (!empty($length) && !empty($gates) && !empty($wickets)) {
	$calculator = "Данные из полей калькулятора: \n Тип забора: $fence\n Высота, м: $height\n Общая длина ограждения: $length; \n Ворота 4 х 2 м. - тип: $gatestype \n Ворота 4 х 2 м. - количество: $gates\n Калитки 1 х 2 м. - количество: $wickets\n";
}
else {
	$calculator = '';
}

// fence, height, gate, gatecount, wickets

$pagetitle = "Новая заявка с сайта \"$sitename\" - $theme";
$message = "Из формы: $theme \nИмя: $name \nТелефон: $phone \nСообщение: \n $message\n\n $calculator\n";
mail($recepient, $pagetitle, $message, "Content-type: text/plain; charset=\"utf-8\"\n From: $recepient");
?>