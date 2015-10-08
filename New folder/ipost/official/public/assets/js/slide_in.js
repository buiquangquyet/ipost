// スライドイン
//左から
$(function(){
    var setElm = $('.scrImg'),
    delayHeight = 200;
    setElm.css({display:'block',opacity:'0'});
    $('html,body').animate({scrollTop:0},1);
    $(window).on('load scroll resize',function(){
        setElm.each(function(){
            var setThis = $(this),
            elmTop = setThis.offset().top,
            elmHeight = setThis.height(),
            scrTop = $(window).scrollTop(),
            winHeight = $(window).height();
            if (scrTop > elmTop - winHeight + delayHeight && scrTop < elmTop + elmHeight){
                setThis.stop().animate({left:'0',opacity:'1'},500);
            } else if (scrTop < elmTop - winHeight + delayHeight && scrTop < elmTop + delayHeight){
                setThis.stop().animate({left:'-100px',opacity:'0'},500);
            }
        });
    });
});



//右から
$(function(){
    var setElm = $('.scrImg2'),
    delayHeight = 200;
    setElm.css({display:'block',opacity:'0'});
    $('html,body').animate({scrollTop:0},1);
    $(window).on('load scroll resize',function(){
        setElm.each(function(){
            var setThis = $(this),
            elmTop = setThis.offset().top,
            elmHeight = setThis.height(),
            scrTop = $(window).scrollTop(),
            winHeight = $(window).height();
            if (scrTop > elmTop - winHeight + delayHeight && scrTop < elmTop + elmHeight){
                setThis.stop().animate({right:'0',opacity:'1'},500);
            } else if (scrTop < elmTop - winHeight + delayHeight && scrTop < elmTop + delayHeight){
                setThis.stop().animate({right:'-90px',opacity:'0'},500);
            }
        });
    });
});

//フェードイン
$(function(){
    var setElm = $('.scrEvent'),
    delayHeight = 100;
    setElm.css({display:'block',opacity:'0'});
    $('html,body').animate({scrollTop:0},1);
    $(window).on('load scroll resize',function(){
        setElm.each(function(){
            var setThis = $(this),
            elmTop = setThis.offset().top,
            elmHeight = setThis.height(),
            scrTop = $(window).scrollTop(),
            winHeight = $(window).height();
            if (scrTop > elmTop - winHeight + delayHeight && scrTop < elmTop + elmHeight){
                setThis.stop().animate({opacity:'1'},500); // 【上】からスクロールしてきた時のイベント
            } else if (scrTop < elmTop - winHeight + delayHeight && scrTop < elmTop + delayHeight){
                setThis.stop().animate({opacity:'0'},500); // 【下】からスクロールしてきた時のイベント
            }
        });
    });
});

