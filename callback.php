<?php

$recepient = "kezoneko@gmail.com";
$sitename = "Первая линия";

$name = trim($_GET["name"]);
$theme = trim($_GET["theme"]);
$phone = trim($_GET["phone"]);
$message = trim($_GET["message"]);

$pagetitle = "Новая заявка с сайта \"$sitename\" - $theme";
$message = "Из формы: $theme \nИмя: $name \nТелефон: $phone \nСообщение: \n $message";
mail($recepient, $pagetitle, $message, "Content-type: text/plain; charset=\"utf-8\"\n From: $recepient");
?>