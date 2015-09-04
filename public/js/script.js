(function($){

	var waDo = (function() {
    
    	return {
        	
        opts: {
        	imageLink: '',    
        },        
        
        paginateStyle: function() {
        	$p = $('.pagination');
            
        	if($p.find('li:first > a').attr('rel') == 'prev') {
            	$p.find('.disabled > span').replaceWith('<span><img src="/images/main/double-arrow-gray.png"></span>');
            }
            else {
        		$p.find('.disabled > span').replaceWith('<span><img src="/images/main/double-arrow-gray-left.png"></span>');
            }
            
            $p.find('a[rel="prev"]').empty().append('<img src="/images/main/double-arrow-gray-left.png">');
            $p.find('a[rel="next"]').empty().append('<img src="/images/main/double-arrow-gray.png">');
        },
        
        
        dropDownFade: function() {
        	var speed = 450;
            var ease = 'easeInSine';
            
        	$('.dd-toggle').click(function(){
                $('.dd-toggle').not(this).next('ul:visible').fadeOut(speed);
                $(this).next('ul').fadeToggle(speed, ease);
                            
                return false;
            });
            
            $('body').click(function(e){
            	var t = $(e.target);
                if(!t.parents().hasClass('dropdown')) {
                	$('.dd-toggle').next('ul:visible').fadeOut(speed, ease);
                }
            
                
            });  
        },
        
        
        dropDownSlide: function() {
        	var speed = 450;
            var ease = 'easeOutBack';
            var easeBack = 'easeInBack';
            
        	$('.dd-toggle').click(function(){
                $('.dd-toggle').not(this).next('ul:visible').slideUp(speed, easeBack);
                
                if($(this).next('ul').is(':hidden')) {
	            	$(this).next('ul').slideDown(speed, ease);
                    
    			}
                else {
                	$(this).next('ul').slideUp(speed, easeBack);
                }            
                return false;
            });
            
            $('body').click(function(e){
            	var t = $(e.target);
                if(!t.parents().hasClass('dropdown')) {
                	$('.dd-toggle').next('ul:visible').slideUp(speed, easeBack);
                }
            
                
            });  
        },
        
        loginFunc: function() {
        	$('.login').click(function(){
            	
                var url = location.href;
                
                var h = $(window).height();
                var w = $(window).width();
            
            	history.pushState('', 'login', '/auth/login'); //詳細はbookにあり HTML5のHistoryAPIを使用してリロードなしのページ遷移が出来る
        		
                $('html,body').css({overflow:'hidden'});
                
                /*
                $('body').append('<div class="inBack"></div>');
                
                var $inBack = $('.inBack');
                
                $inBack.css({height:h}).append('<span class="octicon octicon-x"></span>');
                
                
                    
                    //$('.inBack .panel').addClass('addPanel').css({top:up, left:w/2 - pw/2 -pad, opacity:0}); 
                    //$('.inBack > .octicon').css({top:up+pad, left:w/2 + pw/2 + 25 });
                    
                $inBack.fadeIn(300, function(){
                
                	var pw = $('.panel').width();
                    var ph = $('.panel').height();
                    
                    console.log(ph);
                    
                    var up = (h/2 - ph/2)-220;
                    var pad = 17;
                    
                    $inBack.find('.panel').addClass('addPanel').css({top:up, left:w/2 - pw/2 -pad, opacity:0})
                    $inBack.find('.octicon').css({top:up+pad, left:w/2 + pw/2 + 25, cursor:'pointer', opacity:0});
                	
                
                    $(this).find('.panel, .octicon-x').show(0).animate({top:'+=120', opacity:1}, 1000, 'easeOutBack');
                
                }).click(function(e){
                    
                    var t = $(e.target).not('span');
                     
                    
                    if(!t.parents().hasClass('panel')) {
                    	$(this).find('.addPanel, .octicon-x').animate({top:'-=100', opacity:0}, 600, 'easeInBack', function(){
                            history.pushState('', 'cancel', url);
                            
                            $('html,body').css({overflow:'visible'});
                            
                            $inBack.fadeOut(500, function(){
                                $(this).find('.panel').removeClass('addPanel').next('.octicon').remove();
                                //$(this).remove();
                            });
                        
                        });
                    }
                });
                */
                
                
                
                $('body').append('<div class="inBack"></div>');
                
                var $inBack = $('.inBack');
                
                $inBack.css({height:h}).load('/auth/login .panel', function(){
                
                    var pw = $('.panel').width();
                    var ph = $('.panel').height();
                    
                    var up = (h/2 - ph/2)-320;
                    var pad = 17;
                    
                    $(this).append('<span class="octicon octicon-x"></span>')
                            .find('.panel').addClass('addPanel').css({top:up, left:w/2 - pw/2 -pad, opacity:0})
                            .next('.octicon').css({top:up+pad, left:w/2 + pw/2 + 25, cursor:'pointer', opacity:0});
                    
                    //$('.inBack .panel').addClass('addPanel').css({top:up, left:w/2 - pw/2 -pad, opacity:0}); 
                    //$('.inBack > .octicon').css({top:up+pad, left:w/2 + pw/2 + 25 });
                    
                    //$('.inBack .panel');
                    $(this).find('.panel, .octicon-x').animate({top:'+=220', opacity:1}, 800, 'easeOutBack');
                    //});
                
               	}).fadeIn(300).click(function(e){
                    
                    var t = $(e.target).not('span');
                     
                    
                    if(!t.parents().hasClass('panel')) {
                    	$(this).find('.panel, .octicon-x').animate({top:'-=100', opacity:0}, 600, 'easeInBack', function(){
                            history.pushState('', 'cancel', url);
                            
                            $('html,body').css({overflow:'visible'});
                            
                            $inBack.fadeOut(500, function(){
                                $(this).find('.panel').removeClass('addPanel').parent(this).remove();
                                //$(this).remove();
                            });
                        
                        });
                    }
                });
                
                
                /*
                $('.inBack').load('/auth/login/ .panel', function(){
                    var pw = $('.panel').width();
                    var ph = $('.panel').height();
                    
                    var up = (h/2 - ph/2)-170;
                    var pad = 17;
                    
                    $('.inBack').append('<span class="octicon octicon-x"></span>');
                    
                    $('.inBack .panel').addClass('addPanel').css({top:up, left:w/2 - pw/2 -pad, opacity:0}); 
                    $('.inBack > .octicon').css({top:up+pad, left:w/2 + pw/2 + 25 });
                    
                    //$('.inBack .panel');
                    $('.inBack .panel, .octicon-x').fadeIn(0,function(){
                    	$(this).animate({top:'+=70', opacity:1}, 500, 'linear');
                    });
                    
                });
                */
                
                
                

//                $('#content').load('/wp-content/themes/twentyfifteen/page.php', data, function(){
//                                    $(this).fadeIn(600);
//                                    
//                                    th.typeWriter();
//                                    
//                                    //$('h1').text(u);
//                                });
                
                
            	return false;
            });
        },
        
        //未使用
        aLink: function() {
        	$('a').on({
            	mouseover: function(){
                	$(this).stop().fadeTo(200, 0.7);
                },
                mouseout: function(){
                	$(this).stop().fadeTo(200, 1);
                }
            });
        },
        
        
        scrollFunc: function() {
            var tb = $('.toTop');
            
            tb.click( function() {
                $('html, body').animate({ scrollTop:0 }, 1200, 'easeOutExpo', function(){ //ORG swing 700 / InOutcubic
                	$(this).queue([]).stop();
                });
            });

            $(document).scroll(function(){
                if($(this).scrollTop() <= 50){
                    tb.fadeOut(300, function(){
                    	$(this).queue([]).stop();
                    });
                }
                else {
                	tb.fadeIn(300, function(){
                    	$(this).queue([]).stop();
                    });
                }
            });
            
        },
        
        
    } //return
})(); //var waDo
    	
$(function(){
	
    //$(this).load('/auth/login/ .panel');
    
    //waDo.dragdrop();
    
    //waDo.eventFunc();
    //waDo.sidebarFunc();
    
    //waDo.downLoadFile();
    
    //waDo.insertLink();
    
    waDo.paginateStyle();
    waDo.dropDownFade();
    //waDo.dropDownSlide();
    waDo.loginFunc();
    waDo.scrollFunc();
    
    //waDo.preDeleteImg();
}); //doc.ready



/* easing ********************* */
// easingは、jQuery内にあるデフォルトeasingを拡張するだけなのでjQueryモジュール内のGlobalスコープ内（(function($){　この中　})(jQuery)）に書けばOK

$.easing['jswing'] = $.easing['swing'];

$.extend( $.easing,
{
	def: 'easeOutQuad',
	swing: function (x, t, b, c, d) {
		//alert($.easing.default);
		return $.easing[$.easing.def](x, t, b, c, d);
	},
	easeInQuad: function (x, t, b, c, d) {
		return c*(t/=d)*t + b;
	},
	easeOutQuad: function (x, t, b, c, d) {
		return -c *(t/=d)*(t-2) + b;
	},
	easeInOutQuad: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t + b;
		return -c/2 * ((--t)*(t-2) - 1) + b;
	},
	easeInCubic: function (x, t, b, c, d) {
		return c*(t/=d)*t*t + b;
	},
	easeOutCubic: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t + 1) + b;
	},
	easeInOutCubic: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t + b;
		return c/2*((t-=2)*t*t + 2) + b;
	},
	easeInQuart: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t + b;
	},
	easeOutQuart: function (x, t, b, c, d) {
		return -c * ((t=t/d-1)*t*t*t - 1) + b;
	},
	easeInOutQuart: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
		return -c/2 * ((t-=2)*t*t*t - 2) + b;
	},
	easeInQuint: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t*t + b;
	},
	easeOutQuint: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t*t*t + 1) + b;
	},
	easeInOutQuint: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
		return c/2*((t-=2)*t*t*t*t + 2) + b;
	},
	easeInSine: function (x, t, b, c, d) {
		return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
	},
	easeOutSine: function (x, t, b, c, d) {
		return c * Math.sin(t/d * (Math.PI/2)) + b;
	},
	easeInOutSine: function (x, t, b, c, d) {
		return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
	},
	easeInExpo: function (x, t, b, c, d) {
		return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
	},
	easeOutExpo: function (x, t, b, c, d) {
		return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
	},
	easeInOutExpo: function (x, t, b, c, d) {
		if (t==0) return b;
		if (t==d) return b+c;
		if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
		return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
	},
	easeInCirc: function (x, t, b, c, d) {
		return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
	},
	easeOutCirc: function (x, t, b, c, d) {
		return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
	},
	easeInOutCirc: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
		return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
	},
	easeInElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
	},
	easeOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
	},
	easeInOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
		return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
	},
	easeInBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*(t/=d)*t*((s+1)*t - s) + b;
	},
	easeOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
	},
	easeInOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158; 
		if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
		return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
	},
	easeInBounce: function (x, t, b, c, d) {
		return c - $.easing.easeOutBounce (x, d-t, 0, c, d) + b;
	},
	easeOutBounce: function (x, t, b, c, d) {
		if ((t/=d) < (1/2.75)) {
			return c*(7.5625*t*t) + b;
		} else if (t < (2/2.75)) {
			return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
		} else if (t < (2.5/2.75)) {
			return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
		} else {
			return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
		}
	},
	easeInOutBounce: function (x, t, b, c, d) {
		if (t < d/2) return $.easing.easeInBounce (x, t*2, 0, c, d) * .5 + b;
		return $.easing.easeOutBounce (x, t*2-d, 0, c, d) * .5 + c*.5 + b;
	}
});




})(jQuery);
