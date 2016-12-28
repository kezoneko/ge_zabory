<?php
// Подключение базы данных
include("admin/db.php");
// Общая информация
$sett_info = $connection->prepare('SELECT title, value FROM settings');
$sett_info->execute();
while ($row = $sett_info->fetch(PDO::FETCH_ASSOC)) {
	if ($row['title'] == 'address') {$address = $row['value'];}
	if ($row['title'] == 'email') {$email = $row['value'];}
	if ($row['title'] == 'phone') {$phone = $row['value'];}
	if ($row['title'] == 'worktime') {$worktime = $row['value'];}
}

// Данные именно этой страницы
// Слайдер
$slider_info = $connection->prepare('SELECT adv_text FROM advantages WHERE type = :type');
$slider_info->execute(['type' => 1]);
$i = 1;
while ($row = $slider_info->fetch(PDO::FETCH_ASSOC)) {
	$slider .= '
					<div id="text-slide' . $i . '">' . $row['adv_text'] . '</div>
';
	$i++;
}
// Слайдер-преимущества
$slider2_info = $connection->prepare('SELECT adv_text, icon FROM advantages WHERE type = :type');
$slider2_info->execute(['type' => 2]);
$i = 1;
while ($row = $slider2_info->fetch(PDO::FETCH_ASSOC)) {
	$slider2 .= '
					<div class="box1 box11-' . $i . '"><div class="' . $row['icon'] . '"></div><div class="box1-1">' . $row['adv_text'] . '</div></div>
';
	$i++;
}
// Формы
$forms_info = $connection->prepare('SELECT title, button FROM forms');
$forms_info->execute();
$i = 1;
while ($row = $forms_info->fetch(PDO::FETCH_ASSOC)) {
	$form[$i]['title'] = $row['title'];
	$form[$i]['button'] = $row['button'];
	$i++;
}
// Виды ограждений
$fence_types_info = $connection->prepare('SELECT title, description, text FROM fence_types');
$fence_types_info->execute();
$i = 1;
while ($row = $fence_types_info->fetch(PDO::FETCH_ASSOC)) {
	$fence_types .= '
				<a href="#cost" class="box2 box2-' . $i . ' fancybox">
					<h3>' . $row['title'] . '</h3>
					<span>' . $row['description'] . '</span>
					<ol>
						' . $row['text'] . '
					</ol>
				</a><!-- end/box2 box2-1 -->
';
	$i++;
}
// Блок клиенты
$clients_info = $connection->prepare('SELECT adv_text FROM advantages WHERE type = :type');
$clients_info->execute(['type' => 3]);
$i = 1;
while ($row = $clients_info->fetch(PDO::FETCH_ASSOC)) {
	$clients .= '
					<div class="box7 box7-' . $i . '">
						<h3>0' . $i . '</h3>
						<span>' . $row['adv_text'] . '</span>
					</div><!-- end/box7 -->
';
	$i++;
}

?>
<!DOCTYPE html>
<!--[if lt IE 7]><html lang="ru" class="lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html lang="ru" class="lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html lang="ru" class="lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="ru">
<!--<![endif]-->
<head>
	<meta charset=UTF-8>
	<title>Первая линия</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="libs/bootstrap/bootstrap-grid-3.3.1.min.css" />
	<link rel="stylesheet" href="libs/font-awesome-4.7.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="libs/fancybox/jquery.fancybox.css" />
	<link rel="stylesheet" href="libs/owl-carousel/owl.carousel.css" />
	<link rel="stylesheet" href="libs/countdown/jquery.countdown.css" />
	<link rel="stylesheet" href="css/font.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/media.css">
</head>
<body>
	
	<div class="wrapper">
		<header>
			<div class="container">
				<div class="logo"><span>Санкт-Петербург и обл.</span></div>
				<div class="main_mnu">
					<button class="main_mnu_button"><i class="fa fa-bars" aria-hidden="true"></i></button>
					<ul>
						<li><a href="#">Главная</a></li>
						<li><a href="#">Преимущества</a></li>
						<li><a href="#">Сроки</a></li>
						<li><a href="#" class="active">Калькулятор</a></li>
						<li><a href="#" class="last-h">Выполненные работы</a></li>
					</ul>
				</div><!-- end/main_mnu -->
				
				<div class="contact_top_phone"><span><?= $phone ?></span><a href="#callback" class="fancybox">Заказать звонок</a></div>
				<div class="contact_top_email"><span>Есть вопросы? - пишите</span><a href="mailto:zakaz@pervoline.ru"><?= $email ?></a></div>
			</div><!-- end/container -->
		</header>
		<section class="jumbotron">
			<div class="container">
				<div class="slider">
<?= $slider ?>

<?= $slider2 ?>
				</div><!-- end/slider -->
				<div class="jumboform">
					<form id="formcost" class="form_cost">
						<h3><?= $form[1]['title'] ?></h3>
						<input type="hidden" name="theme" value="Узнайте стоимость забора за 10 минут">
						<input type="text" name="name" placeholder="Введите ваше имя" />
						<input type="text" name="phone" class="phone" placeholder="Введите ваш телефон*" required>
						<textarea name="message" placeholder="Введите сообщение"></textarea>
						<button class="button" type="submit"><?= $form[1]['button'] ?></button>
					</form>
				</div><!-- end/jumboform -->
				<div class="icon_mouse"></div>
			</div><!-- end/container -->
		</section><!-- end/jumbotron -->
		<section class="fence_types">
			<div class="container">
				<div class="title">
					<h3>Виды ограждений</h3>
					<span>Подберём для вас оптимальный вариант</span>
				</div>
<?= $fence_types ?>
				<a href="#cost" class="button fancybox">Узнать точную стоимость</a>
			</div><!-- end/container -->
		</section><!-- end/fence_types -->
		<section class="fence_install">
			<div class="container">
				<div class="title">
					<h3>Устанавливаем ограждения на любых объектах</h3>
					<span>Все ограждения имеют сертификаты качества и соответствия стандартам</span>
				</div>
				<div class="box3 box3-1">
					<h3>Городские объекты:</h3>
					<ul>
						<li>Торгово-развлекательные комплексы</li>
						<li>Бизнес-центры</li>
						<li>Гипермаркеты</li>
					</ul>
				</div><!-- end/box3 box3-1 -->
				<div class="box4">
					<div class="box6 box3-2">
						<h3>Учебные заведения:</h3>
						<ul>
							<li>Школы</li>
							<li>Вузы</li>
							<li>Специальные учреждения</li>
						</ul>
					</div><!-- end/box6 box3-2 -->
					<div class="box6 box3-3">
						<h3>Жилые объекты:</h3>
						<ul>
							<li>Коттеджные поселки</li>
							<li>Жилые комплексы</li>
							<li>Дачные участки</li>
						</ul>
					</div><!-- end/box6 box3-3 last-v -->
				</div><!-- end/box4 -->
				<div class="box5 box3-4">
					<h3>Сельскохозяйственные объекты:</h3>
					<ul>
						<li>Фермерские хозяйства</li>
						<li>Сельско-хозяйственные угодья</li>
						<li>Конюшни</li>
					</ul>
				</div><!-- end/box5 box3-4 last-h -->
				<div class="box5 box3-5">
					<h3>Транспортные объекты:</h3>
					<ul>
						<li>Парковки</li>
						<li>Транспортные депо</li>
						<li>Аэропорты</li>
						<li>Автодороги</li>
						<li>Порты</li>
					</ul>
				</div><!-- end/box5 box3-5 -->
				<div class="box3 box3-6">
					<h3>Спортивные объекты:</h3>
					<ul>
						<li>Корты</li>
						<li>Стадионы</li>
						<li>Футбольные поля</li>
					</ul>
				</div><!-- end/box3 box3-6 -->
				<div class="box4 box3-9">
					<div class="box6 box3-7">
						<h3>Коммерческие объекты:</h3>
						<ul>
							<li>Предприятия</li>
							<li>Терминалы</li>
							<li>Режимные объекты</li>
						</ul>
					</div><!-- end/box6 box3-7 -->
					<div class="box6 box3-8">
						<h3>Инфраструктурные объекты:</h3>
						<ul>
							<li>Электростанции</li>
							<li>Газопроводы</li>
							<li>Объекты ЖКХ</li>
						</ul>
					</div><!-- end/box6 box3-8 last-v -->
				</div><!-- end/box4 last-h -->
			</div><!-- end/container -->
		</section><!-- end/fence_install -->
		<section class="clients">
			<div class="container">
				<div class="title">
					<h3>Клиенты нам доверяют</h3>
				</div>
				<div class="box7_line">
<?= $clients ?>
				</div><!-- end/box7_line -->
				
				<div class="row1">
					<div class="logos logo-silmash"></div>
					<div class="logos logo-siemens"></div>
					<div class="logos logo-bp"></div>
					<div class="logos logo-lenta"></div>
					<div class="logos logo-scania"></div>
				</div><!-- end/row1 -->
				<div class="row2">
					<div class="logos logo-mega"></div>
					<div class="logos logo-seticity"></div>
					<div class="logos logo-magnit"></div>
					<div class="logos logo-otis"></div>
					<div class="logos logo-rzd"></div>
				</div><!-- end/row2 -->
				<div class="row3">
					<div class="logos logo-shell"></div>
					<div class="logos logo-unilever"></div>
				</div><!-- end/row3 -->
			</div><!-- end/container -->
		</section><!-- end/clients -->
		<center><a href="#politics" class="fancybox">Политика конфиденциальности</a></center>
	</div><!-- end/wrapper -->

	<div class="hidden">
		<form id="callback" class="pop_form">
			<h3><?= $form[2]['title'] ?></h3>
			<input type="hidden" name="theme" value="Узнайте всё о заборах от нашего специалиста. Перезвоним за 5 минут!">
			<input type="text" name="name" placeholder="Введите ваше имя" />
			<input type="text" name="phone" class="phone" placeholder="Введите ваш телефон*" required />
			<button class="button" type="submit"><?= $form[2]['button'] ?></button>
		</form>

		<form id="cost" class="pop_form">
			<h3><?= $form[3]['title'] ?></h3>
			<input type="hidden" name="theme" value="Получите расчёт стоимости от нашего специалиста. Перезвоним за 5 минут!">
			<input type="text" name="name" placeholder="Введите ваше имя" />
			<input type="text" name="phone" class="phone" placeholder="Введите ваш телефон*" required />
			<button class="button" type="submit"><?= $form[3]['button'] ?></button>
		</form>

		<form id="calculator" class="pop_form">
			<h3><?= $form[4]['title'] ?></h3>
			<input type="hidden" name="theme" value="Специалист начал расчёт заполните форму, чтобы он связался с вами">
			<input type="text" name="name" placeholder="Введите ваше имя" />
			<input type="text" name="phone" class="phone" placeholder="Введите ваш телефон*" required />
			<button class="button" type="submit"><?= $form[4]['button'] ?></button>
		</form>

		<div id="politics" class="pop_text">
			<h3>Политика конфиденциальности</h3>
			<p>
				Текст про политику конфиденциальности Текст про политику конфиденциальностиТекст про политику конфиденциальностиТекст про политику конфиденциальностиТекст про политику конфиденциальностиТекст про политику конфиденциальностиТекст про политику конфиденциальности
			</p>
			<p>
				Текст про политику конфиденциальности Текст про политику конфиденциальностиТекст про политику конфиденциальностиТекст про политику конфиденциальностиТекст про политику конфиденциальностиТекст про политику конфиденциальностиТекст про политику конфиденциальности
			</p>
			<p>
				Текст про политику конфиденциальности Текст про политику конфиденциальностиТекст про политику конфиденциальностиТекст про политику конфиденциальностиТекст про политику конфиденциальностиТекст про политику конфиденциальностиТекст про политику конфиденциальности
			</p>
		</div>
	</div>
	<!--[if lt IE 9]>
	<script src="libs/html5shiv/es5-shim.min.js"></script>
	<script src="libs/html5shiv/html5shiv.min.js"></script>
	<script src="libs/html5shiv/html5shiv-printshiv.min.js"></script>
	<script src="libs/respond/respond.min.js"></script>
	<![endif]-->
	<script src="libs/jquery/jquery-1.11.1.min.js"></script>
	<script src="libs/jquery-mousewheel/jquery.mousewheel.min.js"></script>
	<script src="libs/fancybox/jquery.fancybox.pack.js"></script>
	<script src="libs/waypoints/waypoints-1.6.2.min.js"></script>
	<script src="libs/scrollto/jquery.scrollTo.min.js"></script>
	<script src="libs/owl-carousel/owl.carousel.min.js"></script>
	<script src="libs/countdown/jquery.plugin.js"></script>
	<script src="libs/countdown/jquery.countdown.min.js"></script>
	<script src="libs/countdown/jquery.countdown-ru.js"></script>
	<script src="libs/landing-nav/navigation.js"></script>
	<script src="libs/jquery-maskedinput/jquery.maskedinput.min.js"></script>
	<script src="js/common.js"></script>

	<!-- скрипт для sublime text -->
	<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>

</body>
</html>