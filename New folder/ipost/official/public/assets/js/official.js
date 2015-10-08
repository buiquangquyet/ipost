/*$(function() {

    $('.sub_img1')

    .hover(

        function(){

            $(this).stop().animate({
				

                'width':'120%',//拡大で表示させておくサイズ

                'height':'135px',

                'margin-top':'-45px'//トップのマージンをマイナスで指定す事で底辺を起点としています

            },'fast');

        },

        function () {

            $(this).stop().animate({

                'margin':'55px',//デフォルトで表示させておくサイズ

                'margin-top':'80px',

            },'fast');

        }

    );

});
*/


/*------------------    ぴょこんとでてくるTOP画像   ---------------------------*/
$(function() {
	var showFlug = false;
	var topBtn = $('#page-top');	
	topBtn.css('bottom', '-100px');
	var showFlug = false;
	//スクロールが500に達したらボタン表示
	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			if (showFlug == false) {
				showFlug = true;
				topBtn.stop().animate({'bottom' : '20px'}, 200); 
			}
		} else {
			if (showFlug) {
				showFlug = false;
				topBtn.stop().animate({'bottom' : '-100px'}, 200); 
			}
		}
	});
	//スクロールしてトップ
    topBtn.click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 500);
		return false;
    });
});




/*------------------  マウスオーバーで拡大 -------------------------------*/
/*  ipost */
$(function(){

    var thumbSize = 250; //元のwidth
  var magnifySize = 300; //拡大後のwidth

 

    $(".magnify").each(function(){

        $(this).css({width:(thumbSize)});

    });

 

    var objWidth = $('.magnify').width();

    var objHeight = $('.magnify').height();

 

    $(".magnify").each(function(){

        $(this).wrapAll('<span class="magnify_cover"></span>');

        $(this).parent('.magnify_cover').css({

            //margin: '0px 10px 10px 0px',

            width: (objWidth),

            height: (objHeight),

            //float: 'left',

            position: 'relative'

        });

    });

 

    $(".magnify").hover(function(){

        $(this).css({top:'0',left:'0',position: 'absolute'/*, transform-origin:'right bottom'*/});

        $(this).stop().animate({width:(magnifySize)},420,function(){  //拡大後のheight
			  
/*            $(this).addClass('shadow');
*/
        });

    }, function(){

        $(this).stop().animate({width:(thumbSize)},350,function(){   //元のheight

            $(this).css({top:'',left:'',position: 'relative'});

/*            $(this).removeClass('shadow');
*/
        });

    });
});



/*  price */
$(function(){

    var thumbSize = 250; //元のwidth
  var magnifySize = 300; //拡大後のwidth

 

    $(".magnify2").each(function(){

        $(this).css({width:(thumbSize)});

    });

 

    var objWidth = $('.magnify2').width();

    var objHeight = $('.magnify2').height();

 

    $(".magnify2").each(function(){

        $(this).wrapAll('<span class="magnify2_cover"></span>');

        $(this).parent('.magnify2_cover').css({

            margin: '0',

            width: (objWidth),

            height: (objHeight),

            float: 'left',

            position: 'relative'

        });

    });

 

    $(".magnify2").hover(function(){

        $(this).css({top:'0',left:'0',position: 'absolute'});

        $(this).stop().animate({width:(magnifySize)},180,function(){  //拡大後のheight

/*            $(this).addClass('shadow');
*/
        });

    }, function(){

        $(this).stop().animate({width:(thumbSize)},150,function(){   //元のheight

            $(this).css({top:'',left:'',position: 'relative'});

/*            $(this).removeClass('shadow');
*/
        });

    });
});

/*-- kinou --*/
$(function(){

    var thumbSize = 320; //元のwidth
  var magnifySize = 370; //拡大後のwidth

 

    $(".magnify3").each(function(){

        $(this).css({width:(thumbSize)});

    });

 

    var objWidth = $('.magnify3').width();

    var objHeight = $('.magnify3').height();

 

    $(".magnify3").each(function(){

        $(this).wrapAll('<span class="magnify3_cover"></span>');

        $(this).parent('.magnify3_cover').css({

            margin: '0 10px 10px 0',

            width: (objWidth),

            height: (objHeight),

            float: 'left',

            position: 'relative'

        });

    });

 

    $(".magnify3").hover(function(){

        $(this).css({top:'0',left:'0',position: 'absolute'});

        $(this).stop().animate({width:(magnifySize)},214,function(){  //拡大後のheight

/*            $(this).addClass('shadow');
*/
        });

    }, function(){

        $(this).stop().animate({width:(thumbSize)},184,function(){   //元のheight

            $(this).css({top:'',left:'',position: 'relative'});

/*            $(this).removeClass('shadow');
*/
        });

    });
});

/*  application */
$(function(){

    var thumbSize = 270; //元のwidth
  var magnifySize = 320; //拡大後のwidth

 

    $(".magnify4").each(function(){

        $(this).css({width:(thumbSize)});

    });

 

    var objWidth = $('.magnify4').width();

    var objHeight = $('.magnify4').height();

 

    $(".magnify4").each(function(){

        $(this).wrapAll('<span class="magnify4_cover"></span>');

        $(this).parent('.magnify4_cover').css({

            margin: '0 10px 10px 0',

            width: (objWidth),

            height: (objHeight),

            float: 'left',

            position: 'relative'

        });

    });

 

    $(".magnify4").hover(function(){

        $(this).css({top:'0',left:'0',position: 'absolute'});

        $(this).stop().animate({width:(magnifySize)},218,function(){  //拡大後のheight

/*            $(this).addClass('shadow');
*/
        });

    }, function(){

        $(this).stop().animate({width:(thumbSize)},184,function(){   //元のheight

            $(this).css({top:'',left:'',position: 'relative'});

/*            $(this).removeClass('shadow');
*/
        });

    });
});

/*  contact */
$(function(){

    var thumbSize = 135; //元のwidth
  var magnifySize = 170; //拡大後のwidth

 

    $(".magnify5").each(function(){

        $(this).css({width:(thumbSize)});

    });

 

    var objWidth = $('.magnify5').width();

    var objHeight = $('.magnify5').height();

 

    $(".magnify5").each(function(){

        $(this).wrapAll('<span class="magnify5_cover"></span>');

        $(this).parent('.magnify5_cover').css({

            margin: '0 10px 10px 0',

            width: (objWidth),

            height: (objHeight),

            float: 'left',

            position: 'relative'

        });

    });

 

    $(".magnify5").hover(function(){

        $(this).css({top:'0',left:'0',position: 'absolute'});

        $(this).stop().animate({width:(magnifySize)},398,function(){  //拡大後のheight

/*            $(this).addClass('shadow');
*/
        });

    }, function(){

        $(this).stop().animate({width:(thumbSize)},316,function(){   //元のheight

            $(this).css({top:'',left:'',position: 'relative'});

/*            $(this).removeClass('shadow');
*/
        });

    });
});




