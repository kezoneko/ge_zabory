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
	if ($row['title'] == 'phone2') {$phone2 = $row['value'];}
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
// Блок Работаем с организациями и частными клиентами (ВТОРОЙ СЛАЙДЕР)
$slider3_info = $connection->prepare('SELECT title, image FROM gallery');
$slider3_info->execute();
$i = 1;
while ($row = $slider3_info->fetch(PDO::FETCH_ASSOC)) {
	$slider3 .= '
					<li><img src="img/' . $row['image'] . '" title="' . $row['title'] . '" /></li>
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
	<link rel="stylesheet" href="libs/font-awesome-4.7.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="libs/fancybox/jquery.fancybox.css" />	
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
						<li><a href="#" class="advantages">Преимущества</a></li>
						<li><a class="terms" href="#">Сроки</a></li>
						<li><a href="#" class="calc active">Калькулятор</a></li>
						<li><a href="#" class="works last-h">Выполненные работы</a></li>
					</ul>
				</div><!-- end/main_mnu -->
				
				<div class="contact_top_phone"><span><?= $phone ?></span><a href="#callback" class="fancybox">Заказать звонок</a></div>
				<div class="contact_top_email"><span>Есть вопросы? - пишите</span><a href="mailto:<?= $email ?>"><?= $email ?></a></div>
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
				<button href="#cost" class="button fancybox">Узнать точную стоимость</button>
			</div><!-- end/container -->
		</section><!-- end/fence_types -->
		<section class="fence_install">
			<div class="container">
				<div class="title">
					<h3>Устанавливаем ограждения на любых объектах</h3>
					<span>Все ограждения имеют сертификаты качества и соответствия стандартам</span>
				</div>
				<div class="boxes_wrapper">
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
			</div>
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
		<section class="under_key">
			<h2>Быстро и под ключ</h2>
			<div class="under_key_wrapper">
				<div class="under_key_up">
					<div class="under_key_div">
						<h4>Сейчас</h4>
						<div>Оставьте заявку на <button href="#cost" class="button fancybox">Расчет себестоимости</button></div>
						<div>либо позвоните по телефону <span><?= $phone2 ?></span></div>
						<div>или напишите на почту <span><?= $email ?></span></div>
					</div>
					<div class="under_key_div">
						<h4>1 день</h4>
						<div>Замеры и заключение договора на месте,</div>
						<div>доставка всех необходимых материалов</div>
					</div>				
				</div>
				<div class="under_key_down">
					<div class="under_key_div">
						<h4>10 минут</h4>
						<div>Менеджер проконсультирует, поможет с выбором</div>
						<div>и составит предварительный расчет</div>
					</div>
					<div class="under_key_div">					
						<h4>1 - 5 дней</h4>
						<div>Монтаж забора, в зависимости от условий</div>
						<div>и объема работ</div>
					</div>
				</div>
			</div>
			<div class="bottom_text">Сроки на изготовление нестандартных материалов<br>согласовываются индивидуально</div>			
		</section>
		<section class="calculate_cost">		
			<div class="calculate_cost_wrapper">
				<h2>Рассчитайте стоимость вашего забора</h2>			
				<div class="row">
					<div class="prop">
						<img src="img/type.png">Выберите тип забора
					</div>
					<div class="val">
						<input type="checkbox" id="fencetype1" name="fence[]" value="профлист" form="calculator">
						<label for="fencetype1" id="fencetypebutton1">Профлист</label>

						<input type="checkbox" id="fencetype2" name="fence[]" value="3d сетка гиттер" form="calculator">
						<label for="fencetype2" id="fencetypebutton2">3D сетка Гиттер</label>

						<input type="checkbox" id="fencetype3" name="fence[]" value="сетка Рабица" form="calculator">
						<label for="fencetype3" id="fencetypebutton3">Сетка Рабица</label>

						<input type="checkbox" id="fencetype4" name="fence[]" value="поликарбонат" form="calculator">
						<label for="fencetype4" id="fencetypebutton4">Поликарбонат</label>

						<input type="checkbox" id="fencetype5" name="fence[]" value="металлический штакетник" form="calculator">
						<label for="fencetype5" id="fencetypebutton5">Металлический штакетник</label>

						<input type="checkbox" id="fencetype6" name="fence[]" value="деревянный штакетник" form="calculator">
						<label for="fencetype6" id="fencetypebutton6">Деревянный штакетник</label>
					</div>
				</div>
				<div class="row">
					<div class="prop prop_height">
						<img src="img/height.png">Высота, м
					</div>
					<div class="val val_height">
						<input type="radio" id="height1" name="height" value="1,5" form="calculator">
						<label for="height1" id="heightbutton1">1,5</label>

						<input type="radio" id="height2" name="height" value="2" form="calculator">
						<label for="height2" id="heightbutton2">2</label>
					</div>
					<div class="prop prop_length">
						<img src="img/total_length.png">Общая длина ограждения, м
					</div>
					<div class="val val_length">
						<input type="text" value="140" name="length" form="calculator">
					</div>
				</div>			
				<div class="row">
					<div class="prop">
						<img src="img/gates.png">Ворота 4&times;2 м., шт
					</div>
					<div class="val">
						<input type="radio" id="gatestype1" name="gatestype" value="откатные" form="calculator">
						<label for="gatestype1" id="gatestypebutton1">Откатные</label>

						<input type="radio" id="gatestype2" name="gatestype" value="распашные" form="calculator">
						<label for="gatestype2" id="gatestypebutton2">Распашные</label>
						<input type="text" name="gates" placeholder="Введите количество" form="calculator">
						
					</div>
				</div>
				<div class="row last_row">
					<div class="prop">
						<img src="img/wicket.png">Калитки 1&times;2 м., шт
					</div>
					<div class="val">				
						<input type="text" name="wickets" placeholder="Введите количество" form="calculator">	
					</div>			
				</div>
				<div class="clear"></div>
				<div class="dwb">				
					<button class="button fancybox" href="#calculator" type="submit" formaction="callback.php" formmethod="get">Узнать точную стоимость</button>
				</div>
				<div class="bottom_text">Не знаете какой забор подойдет<br>или желаете ограждение с нестандартными<br>характеристиками - закажите консультацию
				</div>
			</div>
		</section>
	 	<section class="slider_image_wrapper">
			<h2>Работаем с организациями и частными клиентами</h2>
			<div class="slider_image">
				<ul class="bxslider">
<?= $slider3 ?>
				</ul>
			</div>
	 	</section>	
		<section class="phone-form">
			<p class="fig"><img  alt="" src="img/phone-form.png"></p>
			<div class="form">
				<p> Получите бесплатную консультацию<br> по выбору забора прямо сейчас </p>
				<form action="" method="post">
			    	<input class="name-1" type="text" name="name" placeholder="Введите ваше имя">
			    	<input class="name-2 phone" type="text" pattern="2[0-9]{3}-[0-9]{3}" name="surname" placeholder="Введите ваш телефон*" required>
			    	<button class="button" type="submit">Перезвоните мне</button>
				</form>
			</div>	
		</section>
		<section class="contacts">
			<div class="container_txt">
				<h1>Контакты</h1>
				<div class="icons">
					<img src="img/icon1.png" alt="">
					<p><?= $phone ?></p>
				</div>
				<div class="icons">
					<img src="img/icon2.png" alt="">
					<p><?= $worktime ?></p>
				</div>
				<div class="icons icons3">
					<img src="img/icon3.png" alt="">
					<p><a href="mailto:<?= $email ?>"><?= $email ?></a></p>
				</div>
				<div class="icons">
					<img src="img/icon4.png" alt="">
					<p><?= $address ?></p>
				</div>
			</div>
		</section>
		<section class="map"></section>
		<footer>	
			<div class="container_txt">
				<p><img src="img/logo-footer.png"><p>
				<p class="right">Разработано: <span>MadMedia</span></p>
				<p class="politic"><a href="#popup1" class="fancybox">Политика конфиденциальности</a></p>
			</div>
		</footer>
	</div>
	<!-- end/wrapper -->
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
			<input type="hidden" name="theme" value="Специалист начал расчёт заполните форму, чтобы он связался с вами" form="calculator">
			<input type="hidden" name="theme2" value="Batman forever" form="calculator">
			<input type="text" name="name" placeholder="Введите ваше имя" form="calculator" />
			<input type="text" name="phone" class="phone" placeholder="Введите ваш телефон*" required form="calculator" />
			<button class="button" type="submit" form="calculator"><?= $form[4]['button'] ?></button>
		</form>

		<div class="b-popup" id="popup1">
	        <div class="popup-div"> 
	        	<h1>Политика конфиденциальности</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate laudantium, rem earum fugiat voluptatum ratione cupiditate dolorum, iure maiores doloremque amet recusandae ullam, fugit in officiis! Iure officia architecto atque.Veritatis odio, nostrum a id, laudantium unde vitae iusto vel repellendus eos dolorem animi, repellat, dicta molestiae maxime optio. Fugiat quidem minima in obcaecati doloremque numquam possimus, nulla magni odio? Lorem ipsum dolor sit amet, consectetur adipisicing elit.<br><br> Quibusdam obcaecati, possimus quam ea impedit aspernatur neque repellat, numquam repellendus doloremque a temporibus, rerum dicta quaerat, odio iste nemo molestiae nulla. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse non delectus sint, repellendus quod asperiores! At adipisci placeat, qui perferendis eveniet deleniti, eligendi harum illum eius, unde magni error voluptate. 	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora sit modi necessitatibus asperiores voluptatibus mollitia aliquam neque, corporis eligendi quibusdam, in veniam, odio aliquid nesciunt. Animi quisquam harum, ea accusantium.</p>
	        </div>
	    </div>		
	</div>
	<div id="toTop">Вверх</div>
	<!--[if lt IE 9]>
	<script src="libs/html5shiv/es5-shim.min.js"></script>
	<script src="libs/html5shiv/html5shiv.min.js"></script>
	<script src="libs/html5shiv/html5shiv-printshiv.min.js"></script>
	<script src="libs/respond/respond.min.js"></script>
	<![endif]-->
	<script src="libs/jquery/jquery-1.11.1.min.js"></script>	
	<script src="libs/fancybox/jquery.fancybox.pack.js"></script>	
	<script src="libs/scrollto/jquery.scrollTo.min.js"></script>	
	<script src="libs/jquery-maskedinput/jquery.maskedinput.min.js"></script>
	<script src="libs/bxslider/jquery.bxslider.js"></script>
	<script src="js/common.js"></script>
</body>
</html>
