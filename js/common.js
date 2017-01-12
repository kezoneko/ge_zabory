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
	$(".phone").mask("+7 (999) 999-99-99");	

	//Попап менеджер FancyBox	
	$(".fancybox").fancybox();

	//slider for images in middle part
	$('.bxslider').bxSlider({
  		minSlides: 2,
  		maxSlides: 2,
  		slideWidth: 590,
  		slideMargin: 30,
  		captions: true,
  		auto: true
	});

  	// position of the navigation arrows in section slider_image_wrapper
  	var coord = (($(".bx-wrapper").width() - ($(".bx-pager-item").width() * $(".bx-pager").children().length) )  / $(".bx-wrapper").width())*50;
  	if($(window).width() > 1024) {    
    	$(".bx-prev").css("left", coord - 5 + "%");
    	$(".bx-next").css("right", coord - 5 + "%");
  	} else {
     	$(".bx-prev").css("left", coord - 10 + "%");
     	$(".bx-next").css("right", coord - 10 + "%");
  	}

  	//handler for click on button in section "calculate_cost"
  	$("button").on("click", function() {
    	$(this).toggleClass("active");    
  	});	

	//Плавный скролл до блока .div по клику на .scroll
	//Документация: https://github.com/flesler/jquery.scrollTo

	$("a.advantages").click(function() {
		$.scrollTo($(".clients"), 1500);
	});
	$("a.terms").click(function() {
		$.scrollTo($(".under_key"), 1500);
	});
	$("a.calc").click(function() {
		$.scrollTo($(".calculate_cost"), 1500);
	});
	$("a.works").click(function() {
		$.scrollTo($(".slider_image_wrapper"), 1500);
	});

	//Кнопка "Наверх"
	//Документация:
	//http://api.jquery.com/scrolltop/
	//http://api.jquery.com/animate/
	$(function() { 
		$(window).scroll(function() { 
			if($(this).scrollTop() != 0) { 
				$('#toTop').fadeIn(); 
			} else { 
				$('#toTop').fadeOut(); 
			} 
		}); 
		$('#toTop').click(function() { 
			$('body,html').animate({scrollTop:0},800); 
		}); 
	});	
	
	//Аякс отправка форм	
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
