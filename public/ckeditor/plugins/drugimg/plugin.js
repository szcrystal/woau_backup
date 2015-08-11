CKEDITOR.plugins.add( 'drugimg', {
    icons: 'drugimg',
    init: function( editor ) {
        //Plugin logic goes here.
        
        editor.addCommand( 'drugimg', {
            exec: function( editor ) {
                
            	$('.container-fluid').append('<div class="plugBack"></div>'); //白背景追加
                $('.plugBack').css({ height:$(window).height() });         
                //.plugBackのcssはdbd.cssに入れている

                $('.imgArea').addClass('plug')
                			//.css({opacity:1})
                			.append('<button style="margin-right:1em;" class="addBtn btn btn-success">O K</button>')
                            .append('<button class="closeBtn btn btn-default">キャンセル</button>');
                //$('.plug').find('.preImg').hide();
                
                $('.addBtn').click(function(){
                	var str = $('code.addCode').text();
                    editor.insertHtml( str );
                    backAll();
                    return false;
                });
                
                $('.closeBtn').click(function(){
                	backAll();
                    return false;
                }); 
                
                function backAll() {
                	$('.imgArea').removeClass('plug');
                    $('.addBtn').remove()
                    $('.closeBtn').remove();
                    $('.plugBack').remove();
                }
            }
        });
        
        editor.ui.addButton( 'Drugimg', {
            label: 'addImage',
            command: 'drugimg',
            toolbar: 'others'
        });
        
        
    }
});