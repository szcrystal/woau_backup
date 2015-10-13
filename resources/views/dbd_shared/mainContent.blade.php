<div class="form-group">
	<label>ヘッダーコンテンツ</label>
	{!! Form::textarea('intro_content', isset($article) ? $article->intro_content : null, ['class' => 'form-control', 'rows'=>10]) !!}
</div>


<div class="form-group">
    <label>メインコンテンツ</label>

    {!! Form::textarea('main_content', isset($article) ? $article->main_content : null, ['id'=>'main_content','class'=>'', 'rows'=>35]) !!}

    <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace( 'main_content', {
            //uiColor: '#e7e7e7',
            //height: '40em',
            customConfig: '/ckeditor/custom_config.js',
            //contentsCss: ['/css/app.css', '/css/main.css'],
            //contentsCss: '/css/main.css',
            //extraPlugins: 'divarea',
            //toolbarCanCollapse: true,
        } );
	</script>    
</div>
