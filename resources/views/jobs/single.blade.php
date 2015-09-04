@extends('app')

    @section('content')
    
    	<?php
        	//$singleArr = explode(';', $singlepage->imgLink);
            //<img src="/{{$singleArr[0]}}" width="420" height="300" />
            //<a href="/reservation/article/{{$singl->job_number}}" class="btn">予約する</a> {{-- idを取ってそこからpageのデータを取るようにする　リンク先もid付きにする --}}
        ?>
        
        <ul class="breadcrumb">
            <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
            <li><a href="{{getUrl('recruit')}}">案件情報一覧</a></li>
            <li>@if($singleObj->company_name != ''){{$singleObj->company_name}}
            @else{{$singleObj->title}}@endif</li>
        </ul>
        
        {{-- <a href="{{ getUrl('recruit') }}" class="center-block back-tx">案件情報一覧へ戻る</a> --}}
        
        <article style="text-align:left;" class="single job-sgl">
            <header>
            	<small>{!! getStrDate($singleObj->created_at, 'slash') !!}</small>
                @if(isset($already))
                	<span class="done-btn">{{$already}}</span>
                @else
                	<a href="{{ getUrl('recruit/entry/'.$singleObj->job_number) }}" class="edit-btn">この案件に応募する</a>
                @endif
                <h2>{{$singleObj -> company_name}}</h2>
                <h3>{{$singleObj->title}}</h3>
            </header>

			
            <section>
                {!! $singleObj->main_content !!}
            
            </section>
            
            <section>
            @if($singleObj->img_link != '')
            	<?php
                	$imgArr = explode(';', $singleObj->img_link);
                ?>
            <div class="imghere">
            	<img src="{{asset($imgArr[0])}}">
            </div>
            @else
            <div class="imghere"></div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered company-table">
                    <colgroup>
                        <col class="col-xs-2" />
                        <col class="col-xs-7" />
                    </colgroup>
                    <tbody>
                        <tr>
                            <th scope="row">会社名</th>
                            <td>@if($singleObj->work_name != ''){{ $singleObj->work_name }}
                                @else{{$singleObj -> company_name}}@endif</td>
                        </tr>
                        <tr>
                            <th scope="row">ホームページ</th>
                            <td><a href="{{$singleObj->work_site}}">{{$singleObj->work_site}}</a></td>
                        </tr>
                        <tr>
                            <th scope="row">形態</th>
                            <td>{{ $singleObj -> work_format }}</td>
                        </tr>
                        <tr>
                            <th scope="row">勤務日数</th>
                            <td>{{ $singleObj -> work_day }}</td>
                        </tr>
                        <tr>
                            <th scope="row">応募条件</th>
                            <td>{!! nb($singleObj -> work_require) !!}</td>
                        </tr>
                        <tr>
                            <th scope="row">その他</th>
                            <td>{!! nb($singleObj -> work_other) !!}</td>
                        </tr>
                        
                        @if($singleObj->work_other_second != '')
                        <tr>
                            <th scope="row">備考</th>
                            <td>{!! nb($singleObj -> work_other_second) !!}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            </section>

            <footer>
            	@if(isset($already))
                <span class="done-btn">{{$already}}</span>
                @else
            	<a href="{{ getUrl('recruit/entry/'.$singleObj->job_number) }}" class="edit-btn">この案件に応募する</a> 
                @endif  
                {!! pager('jobs', $singleObj->id) !!}
                
                <a href="{{ getUrl('recruit') }}" class="back-tx">案件情報一覧へ戻る</a>

            	{{-- 
            	@foreach($singleArr as $single)
            		<img src="/{{$single}}" width="270" height="200" />
                
                @endforeach
                 --}}
            </footer>
        </article>
    @endsection
