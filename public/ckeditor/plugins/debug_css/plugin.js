/*
Copyright (c) 2003-2009, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.plugins.add(
	'debug_css',
	{
		requires : [ 'richcombo' ],

		// 初期化前にコンボボックスの設定処理を上書き
		
		beforeInit: function( editor ) {
			CKEDITOR.ui.prototype.addRichCombo = function( name, definition ) {
				if ( definition.panel ) {
					if ( definition.panel.css ) {
						// 一旦CSVにしてから分割
						var csv = definition.panel.css.join( ',' ) ;
						definition.panel.css = ( csv == '' ) ? [] : csv.split( /\s*,\s*/ ) ;
					}
				}
				
				this.add( name, CKEDITOR.UI_RICHCOMBO, definition );
			} ;
		},
		
		// 準備完了後に編集領域のHTMLのCSSを削除・追加
		
		init: function( editor ) {
			editor.on( 'instanceReady', function() {
				var doc = editor.document.$ ;
				var link = doc.getElementsByTagName( 'link' ) ;
				
				var remove = [] ;
				
				for ( var n = 0 ; n < link.length ; n++ ) {
					if ( ! link[ n ].rel ) continue ;
					if ( link[ n ].rel.toLowerCase() != 'stylesheet' ) continue ;
					remove.push( link[ n ] ) ;
				}
				
				for ( var n = 0 ; n < remove.length ; n++ ) {
					remove[ n ].parentNode.removeChild( remove[ n ] ) ;
				}
				
				var css = ( editor.config.contentsCss == '' ) ? [] : editor.config.contentsCss.split( /\s*,\s*/ ) ;
				
				var head = doc.getElementsByTagName( 'head' )[ 0 ] ;
				
				for ( var n = 0 ; n < css.length ; n++ ) {
					var link = doc.createElement( 'link' ) ;
					link.href = css[ n ] ;
					link.type = 'text/css' ;
					link.rel = 'stylesheet' ;
					link._fcktemp = 'true' ;
					
					head.appendChild( link ) ;
				}
			} ) ;
		}
	}
) ;
