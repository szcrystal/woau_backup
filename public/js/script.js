(function($){

	var waDo = (function() {
    
    	return {
        	
            opts: {
            
            },


		dragdrop: function() {
            
            //jQueryではdataTransferプロパティがeventに入っていない
            $.event.props.push( "dataTransfer" );
            
            // global
            var dr = $('#dropArea');
            var imgArr = new Array();
            
            dr.children('img.preimg').each(function(){
                imgArr.push($(this).attr('src'));
            });
            
            //境界内に入った時
            dr.on('dragenter', function(e){
            	$(this).addClass('dover');
                //$('#page-main').append('<p>bbb</p>');
                $('#progBar').css({width:0}).fadeTo(100,1);
            });
            
            //drop領域上にある時
            dr.on('dragover', function(e) {
            	e.preventDefault();
            	
                //$('p').text(pt);
                
            	for(var i=0; i < e.dataTransfer.types.length; i++) {
                	if(e.dataTransfer.types[i] == 'text/plain') {
                    	e.preventDefault();
                        break;
                    }
                }
                
                //$('#page-main').append('<p>ccc</p>');
            });
            
            //境界から離れた時
            dr.on('dragleave', function(e){
            	$(this).removeClass('dover');
                
                
            });
            
            //Dropされた時 Fileドロップと要素ドロップ兼用
            dr.on('drop', function(e){
            	e.preventDefault();
                
                var $th = $(this);
                
                $(e.target).removeClass('dover');
                
                if(e.dataTransfer.files.length) { //Fileドロップ時                    
                    
                    var fileLength = e.dataTransfer.files.length;
                    //$('h1').text(fileLength);
                    
                    //datas.append("files[]", e.dataTransfer.files[0]);
					
                    var datas = new FormData();
                    
                    var fls = e.dataTransfer.files;
                    
                    //var imgArr = new Array();
                    
                    //for (var k in fls) { 
                    //for eachだと効かない forEach()メソッドも効かない　なぜか?? -> 元々javascript独自拡張で for each構文は廃止らしい
                    //現在は for of 構文らしい　for (let i of arr) {} from MDN Document
                    $.each(fls, function(index, value){	//jQueryでは、$.each()で配列とObjectのループをさせることが可能。 $('').each()はDOM Eelement用
                        //var file = fls[k];
                        var file = value;
                        console.log(file);
                    	
                        datas.append('text', 'abcde');
                        datas.append("files[]", file); //<input type="file" name="files[]" /> の要素を追加することと同じ
                    	
                        var reader = new FileReader(); //fileReaderコンストラクター
                        
                        //FileReader プログレスバー reader.readAsDataURL(file);より前にある必要あり
                        reader.onprogress = function(e) {
                        	if(e.lengthComputable) {
                            	var loaded = e.loaded / e.total;
                                $('#progBar').animate({width: 100 * loaded + '%'}, 300, 'linear').fadeTo(800, 0); //$('#page').width()*loaded + 'px'
                            }
                        };
                        
                        reader.readAsDataURL(file);
                        
                        
                        reader.onload = function(e){ //FileReader()に対してjQuery-onメソッドが効かない。 -> 必要ならbindで
                        	
                            //console.log(reader.result);
                            
                            var dataURL = e.target.result; //reader.resultとして直接指定とすると効かない 下記のwhile構文でおかしくなるのもこれが原因か
                            //イベントハンドラ内（関数）は非同期に進むので上位スコープ外の変数（ここではvar readerなど、繰り返し構文内で毎回代入するもの）を利用する時は注意。何かとおかしくなる（変数内容がずれる）
                            
                            if(dataURL.indexOf('base64') > -1) {
                            	dr.find('span').hide();
                                
                                //imgArrに、このタイミングですでに登録されている画像のlinkが入っている（Line:20）
                                
                                $link = '/images/upload/' + file.name;
                                imgArr.push($link);
                                //この配列をpostする動作は下記ajaxのsuccess内に記述
                                
                                dr.append('<img src="' + dataURL + '" class="addImg" />');
                                
                                //<code>にクラス付けをするためのselectからの値を取る
                                var posi = $('#position').val();
                                var size = $('#size').val();
                                var posiClass, sizeClass;
                                
                                if(posi == 'left') {
                                	posiClass = 'left';
                                }
                                else if(posi == 'center') {
                                	posiClass = 'center';
                                }
                                else if(posi == 'right') {
                                	posiClass = 'right';
                                }
                                
                                if(size == 'large') {
                                	sizeClass = ' large';
                                }
                                else if(size == 'middle') {
                                	sizeClass = ' middle';
                                }
                                else if(size == 'small') {
                                	sizeClass = ' small';
                                }
                                
                                //<code>にソースコードを表示させる
                                if(! $('.imgArea').hasClass('plug')) {
	                                $('#codeArea:hidden').slideDown(300);
                                }
//                                else {
//                                	$('button:first').focus();
//                                }
                                $('code.addCode').append("&lt;img src=&quot;"+ $link +"&quot; class=&quot;"+ posiClass + sizeClass +"&quot; /&gt;\n");
                                
                                //del btn表示
                                $('#del_btn').fadeIn(300);
    
                            } //dataUrl.indexOf
                            else {
                            	dr.text(reader.result);
                            }
                        }; //onLoad
                        
                        reader.onerror = function(e) {
                        	if(reader.error.code === reader.error.ENCODING_ERR) {
                            	dr.text('Error' + reader.error);
                            	return;
                            }
                        };
                    	
                    
                    }); //$.each
                    //}
                    
                    /*
                	while(i < fileLength) {
	                	
                        //★★File オブジェクト
                        var file = e.dataTransfer.files[i];
    	                
                        //$(this).append('<p>' + file.name + '</p>');
                        
                        //★★FileReader オブジェクト
                    	var reader = new FileReader();
                        
                        //FileReader プログレスバー reader.readAsDataURL(file);より前にある必要あり
//                        reader.onprogress = function(e) {
//                        	if(e.lengthComputable) {
//                            	var loaded = e.loaded / e.total;
//                                $('#progBar').animate({width: 100 * loaded + '%'}, 300, 'linear'); //$('#page').width()*loaded + 'px'
//                            }
//                        };
						
                        
                        // ★★ POINT Formインスタンスへの追加メソッド
						// POST data reader.onloadの外にある必要あり
                        //FormData()のオブジェクトに追加することでinputと同じ処理が出来る 第一引数はname属性に該当、第二引数は値
                        datas.append('text', 'abcde');
                        datas.append("files[]", file);
                        
                        
                        //★★FileReaderのファイル読み込みメソッド -----
                        //reader.readAsArrayBuffer(file);
                        //reader.readAsBinaryString(file);
                        //reader.readAsText(file);
                        reader.readAsDataURL(file);
                        
                        console.log('LOGLOGLOG_1>> '+ i);
                        

                    
                    
                        reader.onload = function(e){ //FileReader()に対してonメソッドが効かない。ないみたい
                        	//console.log(reader.result);
                            
                            var dataURL = reader.result;
                            
                            if(dataURL.indexOf('base64') > -1) {
                                dr.append('<img src="' + dataURL + '" class="addimg" style="position:relative; top:0; left:' + i*150 + 'px; width:120px; height:auto;" />');
                                
                                console.log('LOGLOGLOG_2>> '+ i);
                                return;
                                
                                //console.log('dataURL >>> ' + dataURL);
                                
                                //WebStorage のlocalStorage(Global Object)に保存 
                                //localStorage.bg = dataURL;
                                
                                //データベースに入れる処理をここに書けるか
                                //------------------------------------
                                   
                                   
                            	//---------------------------------
                                
                            } //dataUrl.indexOf
                            else {
                            	dr.text(reader.result);
                            }
                        }; //onLoad
                        
                        reader.onerror = function(e) {
                        	if(reader.error.code === reader.error.ENCODING_ERR) {
                            	dr.text('Error' + reader.error);
                            	return;
                            }
                        };
                        
                        i++;
                    } //while   
					*/
//                    aaa = new Array();
//                    aaa.push('ddd');
//                    var imgLink = imgArr.join(';');
//                    console.log('LOGLOG>> ' + imgLink);
//                    
//                    dr.append('<input type="hidden" name="imgLink" value="' + imgLink + '" />');
                    
 
                    /* Ajax */
                    $.ajax({
                        type: "POST",
                        url: '/upload.php', //laravelではweb rootからのフルパスが安全
                        data: datas, //datas:<input type="file" .. />をupload.phpにPOSTするということ
                        processData: false,
                        contentType: false,
                        success: function(datas) { //success
                            console.log('upload is done' + datas);
                            
                            //ファイルのリンク先をDBにpostするための処理 dataform.blade.phpに<input type="hidden">をappendする
                            var imgLink = imgArr.join(';'); //implode
                    		dr.append('<input type="hidden" name="img_link" value="' + imgLink + '" />');
                            
                        },//success
                        
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            $("div").html('送信出来ませんでした。'+ errorThrown);
                        } //ajax error
                        
                    }); //ajax
                    
                    
                    //console.log(file); //fileオブジェクトのプロパティが確認出来る
                    
                } //if(e.dataTransfer.files.length) { //Fileドロップ時 
                else { //要素ドロップ line:58辺り
                	var name = e.dataTransfer.getData('text/plain');
                    var html = e.dataTransfer.getData('text/html');
                    
                    //$(this).text(html);
                    
//                    if($(this).children('li').is(':visible')) {
//                        $('li',this).after(html);
//                        //$(this).html(html);
//                    }
//                    else {
                        $(this).append(html);
                    //}
                                
                    console.log(html);
                }
                
                //$('#page-main').append('<p>aaa</p>');
                
            }); //dr.onDrop
            
            /*drag dropでのデスクトップへのダウンロード：仕様がなくなったか？　効かない
            $('.dragout').on('dragstart', function(e){
            	console.log(this.dataset.downloadurl);
            	e.preventDefault();
            	e.dataTransfer.setData('DownLoadURL', this.dataset.downloadurl);
                
                
            });
            */
            
        }, //func dd
        
        eventFunc: function() {
        	$('#del_btn').on('click', function(){
                $('#dropArea').find('img').not('.preimg').remove();
                $('#codeArea').hide(300, function(){
                	$(this).find('code').empty();
                });
                $('input[name="img_link"]').remove();
                
                //ここで$.ajaxでupload.phpにPOSTを送ってupした画像を削除する
                
                return false;
            });
        },
        
        sidebarFunc: function() {
        	$('.nav-sidebar > li > a.onSlide').on('click', function(e){
            	$(e.target).parent('li').next('li').find('ul.slide').slideToggle();
                return false;
            });
        },
        
        
        downLoadFile: function() {
        	$('.dlf').click(function(){
            	//$('h2').text('aaa');
            	var datas = {
                	fPath: $('input[name="fPath"]').val(),
                    fName: $('input[name="fName"]').val(),
                };
                location.href="/download.php?fPath="+datas.fPath +"&fName=" + datas.fName;
//				var formElement = $("#dlFile");
//				var datas = new FormData(formElement);

                //var form = $('#dlFile').get(0);
   
                // FormData オブジェクトを作成
               // var datas = new FormData( form ); //https://developer.mozilla.org/ja/docs/Web/Guide/Using_FormData_Objects
                
//                $('h2').text(datas.fName);
//                console.log(datas);
                
//                var oReq = new XMLHttpRequest();
//                oReq.open("POST", "/download.php");
//                oReq.onload = function(oEvent) {
                	//$(document).load("/download.php", datas);
                
//                };
//                oReq.send(datas);
                
//                $(document).load('/download.php', datas, function(){
//                	console.log('LOAD is done');
//                    //Location.href('/download.php');
//                });
                
                
            
//            	$.ajax({
//                    type: "POST",
//                    url: '/download.php', //laravelではweb rootからのフルパスが安全
//                    data: datas, //datas:<input type="file" .. />をupload.phpにPOSTするということ
//                    processData: false,
//                    contentType: false,
//                    async: true,
//        			cache: false,
//                    success: function(data) { //success
//                        console.log('upload is done');
//                        //$(window).load(data);
//                        //$('body').html(data);
//                       //location.href = data;
//                       
//                       //var res = eval(data);
////                        if (res.err_msg != undefined ){
////                            alert( res.err_msg );
////                            return;
////                        }
//                        console.log(data);
//                        //location.href = res.redirect_url;
//                       
//                        //ファイルのリンク先をDBにpostするための処理 dataform.blade.phpに<input type="hidden">をappendする
//                        //var imgLink = imgArr.join(';'); //implode
//                        //dr.append('<input type="hidden" name="img_link" value="' + imgLink + '" />');
//                        
//                    },//success
//                    error: function(XMLHttpRequest, textStatus, errorThrown) {
//                        $("div").html('送信出来ませんでした。'+ errorThrown);
//                    } //ajax error
//                    
//                }); //ajax
            	
            	return false;
            });
        },
        
        insertLink: function() {
        	$('#insertLink').hide(0).css({position:"absolute", top:"30%", left:"35%"});
            
//            var obj;
//            
//            $('textarea[name="main_content"]').focus(function(){
//            	obj = document.activeElement;
//            	$('label').text(obj);
//            });
            
        	$('.insLink').click( function(){
            	var il = $('#insertLink');
            
            	il.show(0, function(){
                	il.find('input:first').focus();
            	
                	il.find('input:submit').click(function(){
                    
                    	var str_1 = $('.linkUrl').val();
                        var str_2 = $('.linkStr').val();
                        var str = '<a href="' + str_1 + '">'+ str_2 + '</a>';
                        
                        var obj = $('textarea[name="main_content"]');
                        //var obj = document.activeElement;
                        obj.focus();
                        
                        var s = obj.val();
                        var p = obj.get(0).selectionStart;
                        var np = p + str.length;
                        obj.val(s.substr(0, p) + str + s.substr(p));
                        obj.get(0).setSelectionRange(np, np);
                    
                        il.hide(0);

                    	return false;
                	});
                });
                
                $('input[name="cancel"]').click(function(){
    				il.hide(0);        	
	            });
  
            });
                         
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
        
        
        dropDown: function() {
        	var speed = 450;
            
        	$('.dd-toggle').click(function(){
                $('.dd-toggle').not(this).next('ul:visible').fadeOut(speed);
            	$(this).next('ul').fadeToggle(speed);
                
                return false;
            });
            
            $('body').click(function(e){
            	var t = $(e.target);
                if(!t.parents().hasClass('dropdown')) {
                	$('.dd-toggle').next('ul:visible').fadeOut(speed);
                }
            
                
            });  
        },
        
        loginFunc: function() {
        	$('.login').click(function(){
            	
                url = location.href;
                
                h = $(window).height();
                w = $(window).width();
            
            	history.pushState('', 'login', '/auth/login'); //詳細はbookにあり HTML5のHistoryAPIを使用してリロードなしのページ遷移が出来る
        		
                $('html,body').css({overflow:'hidden'});
                
                $('body').append('<div class="inBack"></div>');
                $('.inBack').css({height:h}).load('/auth/login/ .panel', function(){
                
                    var pw = $('.panel').width();
                    var ph = $('.panel').height();
                    
                    var up = (h/2 - ph/2)-160;
                    var pad = 17;
                    
                    $(this).append('<span class="octicon octicon-x"></span>')
                            .find('.panel').addClass('addPanel').css({top:up, left:w/2 - pw/2 -pad, opacity:0})
                            .next('.octicon').css({top:up+pad, left:w/2 + pw/2 + 25 });
                    
                    //$('.inBack .panel').addClass('addPanel').css({top:up, left:w/2 - pw/2 -pad, opacity:0}); 
                    //$('.inBack > .octicon').css({top:up+pad, left:w/2 + pw/2 + 25 });
                    
                    //$('.inBack .panel');
                    $(this).find('.panel, .octicon-x').show(0, function(){
                        $(this).animate({top:'+=60', opacity:1}, 700, 'swing');
                    });
                
               	}).fadeIn(300).click(function(e){
                    
                    var t = $(e.target).not('span');
                    var $inBack = $(this); 
                    
                    if(!t.parents().hasClass('panel')) {
                    	$inBack.find('.panel, .octicon-x').animate({top:'-=60', opacity:0}, 400, 'linear', function(){
                            history.pushState('', 'cancel', url);
                            
                            $('html,body').css({overflow:'visible'});
                            
                            $inBack.fadeOut(400, function(){
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
                $('html, body').animate({ scrollTop:0 }, 700, 'swing', function(){
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
	
    
    waDo.dragdrop();
    
    waDo.eventFunc();
    waDo.sidebarFunc();
    
    //waDo.downLoadFile();
    
    waDo.insertLink();
    
    waDo.paginateStyle();
    waDo.dropDown();
    waDo.loginFunc();
    waDo.scrollFunc();
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
