$(document).ready(function() {
	//Слайдер после заголовка
	var text_slide_cur=0;
	function showtext_slide(){
		$('#text-slide'+(text_slide_cur+1)).css({opacity: 0}).animate({opacity: 1.0,left: "0"}, 1000);
		setTimeout(hidetext_slide, 4000);
	}
	function hidetext_slide(){
		$('#text-slide'+(text_slide_cur+1)).css({opacity: 1}).animate({opacity: 0,right: "0"}, 1000,function(){showtext_slide();});
		text_slide_cur=(text_slide_cur+1)%2;
	}

	//Слайдер после заголовка
	showtext_slide();

	//Код jQuery, установливающий маску для ввода телефона элементу input
	//1. После загрузки страницы,  когда все элементы будут доступны выполнить...
	/*$(function(){
	//2. Получить элемент, к которому необходимо добавить маску
	$("#phone").mask("8(999) 999-9999");
	});*/
	//2. Получить элемент, к которому необходимо добавить маску
	$(".phone").mask("+7 (999) 999-99-99");

	$(".main_mnu_button").click(function() {
		$(".main_mnu ul").slideToggle();
	});

	//Таймер обратного отсчета
	//Документация: http://keith-wood.name/countdown.html
	//<div class="countdown" date-time="2015-01-07"></div>
	var austDay = new Date($(".countdown").attr("date-time"));
	$(".countdown").countdown({until: austDay, format: 'yowdHMS'});

	//Попап менеджер FancyBox
	//Документация: http://fancybox.net/howto
	//<a class="fancybox"><img src="image.jpg" /></a>
	//<a class="fancybox" data-fancybox-group="group"><img src="image.jpg" /></a>
	$(".fancybox").fancybox();

	//Навигация по Landing Page
	//$(".top_mnu") - это верхняя панель со ссылками.
	//Ссылки вида <a href="#contacts">Контакты</a>
	$(".top_mnu").navigation();

	//Добавляет классы дочерним блокам .block для анимации
	//Документация: http://imakewebthings.com/jquery-waypoints/
	$(".block").waypoint(function(direction) {
		if (direction === "down") {
			$(".class").addClass("active");
		} else if (direction === "up") {
			$(".class").removeClass("deactive");
		};
	}, {offset: 100});

	//Плавный скролл до блока .div по клику на .scroll
	//Документация: https://github.com/flesler/jquery.scrollTo
	$("a.scroll").click(function() {
		$.scrollTo($(".div"), 800, {
			offset: -90
		});
	});

	//Каруселька
	//Документация: http://owlgraphic.com/owlcarousel/
	var owl = $(".carousel");
	owl.owlCarousel({
		items : 1,
		autoHeight: true
	});
	owl.on("mousewheel", ".owl-wrapper", function (e) {
		if (e.deltaY > 0) {
			owl.trigger("owl.prev");
		} else {
			owl.trigger("owl.next");
		}
		e.preventDefault();
	});
	$(".next_button").click(function(){
		owl.trigger("owl.next");
	});
	$(".prev_button").click(function(){
		owl.trigger("owl.prev");
	});

	//Кнопка "Наверх"
	//Документация:
	//http://api.jquery.com/scrolltop/
	//http://api.jquery.com/animate/
	$("#top").click(function () {
		$("body, html").animate({
			scrollTop: 0
		}, 800);
		return false;
	});
	
	//Аякс отправка форм
	//Документация: http://api.jquery.com/jquery.ajax/
	
	$("#formcost").submit(function() {
		$.ajax({
			type: "GET",
			url: "callback.php",
			data: $("#formcost").serialize()
		}).done(function() {
			alert("Спасибо за оставленную заявку! \nСпециалист сейчас с вами свяжется");
		});
		return false;
	});
	$("#callback").submit(function() {
		$.ajax({
			type: "GET",
			url: "callback.php",
			data: $("#callback").serialize()
		}).done(function() {
			alert("Спасибо за оставленную заявку! \nСпециалист сейчас с вами свяжется");
			setTimeout(function() {
				$.fancybox.close();
			}, 1000);
		});
		return false;
	});
	$("#cost").submit(function() {
		$.ajax({
			type: "GET",
			url: "callback.php",
			data: $("#cost").serialize()
		}).done(function() {
			alert("Спасибо за оставленную заявку! \nСпециалист сейчас с вами свяжется");
			setTimeout(function() {
				$.fancybox.close();
			}, 1000);
		});
		return false;
	});
	$("#calculator").submit(function() {
		$.ajax({
			type: "GET",
			url: "callback.php",
			data: $("#calculator").serialize()
		}).done(function() {
			alert("Спасибо за оставленную заявку! \nСпециалист сейчас с вами свяжется");
			setTimeout(function() {
				$.fancybox.close();
			}, 1000);
		});
		return false;
	});
});