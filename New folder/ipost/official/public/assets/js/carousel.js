// カルーセル
$(function(){
	$('#carousel').each(function(){
		var slideTime = 500;
		var delayTime = 5000;

		var carouselWidth = $(this).width();
		var carouselHeight = $(this).height();
		$(this).append('<div id="carousel_prev"></div><div id="carousel_next"></div>');
		$(this).children('ul').wrapAll('<div id="carousel_wrap"><div id="carousel_move"></div></div>');

		$('#carousel_wrap').css({
			width: (carouselWidth),
			height: (carouselHeight),
			position: 'relative',
			overflow: 'hidden'
		});

		var listWidth = parseInt($('#carousel_move').children('ul').children('li').css('width'));
		var listCount = $('#carousel_move').children('ul').children('li').length;

		var ulWidth = (listWidth)*(listCount);

		$('#carousel_move').css({
			top: '0',
			left: -(ulWidth),
			width: ((ulWidth)*3),
			height: (carouselHeight),
			position: 'absolute'
		});

		$('#carousel_wrap ul').css({
			width: (ulWidth),
			float: 'left'
		});
		$('#carousel_wrap ul').each(function(){
			$(this).clone().prependTo('#carousel_move');
			$(this).clone().appendTo('#carousel_move');
		});

		carouselPosition();

		$('#carousel_prev').click(function(){
			clearInterval(setTimer);
			$('#carousel_move:not(:animated)').animate({left: '+=' + (listWidth)},slideTime,function(){
				carouselPosition();
			});
			timer();
		});

		$('#carousel_next').click(function(){
			clearInterval(setTimer);
			$('#carousel_move:not(:animated)').animate({left: '-=' + (listWidth)},slideTime,function(){
				carouselPosition();
			});
			timer();
		});

		function carouselPosition(){
			var ulLeft = parseInt($('#carousel_move').css('left'));
			var maskWidth = (carouselWidth) - ((listWidth)*(listCount));
			if(ulLeft == ((-(ulWidth))*2) || ulLeft == ((-(ulWidth))*2)+1) {
				$('#carousel_move').css({left:-(ulWidth)});
			} else if(ulLeft == 0) {
				$('#carousel_move').css({left:-(ulWidth)});
			};
		};

		timer();

		function timer() {
			setTimer = setInterval(function(){
				$('#carousel_next').click();
			},delayTime);
		};

	});
});
