@if( ! $blogObj->cateRelation ->isEmpty())
    <h5><span class="octicon octicon-tag"></span>カテゴリー</h5>
    <ul class="clearfix">   
    <?php 
        $cates = $blogObj->cateRelation;
        $format = "<li><a href=\"%s\">%s</a>%s</li>\n"; 
        foreach($cates as $cate) {
            $cateObj = App\Cate::find($cate->cate_id);
            printf($format, getUrl('blog/category/'.$cateObj->slug), $cateObj->c_name, ($cates->last() == $cate) ? "": "、" );
        }
    ?>

    </ul>
@endif
