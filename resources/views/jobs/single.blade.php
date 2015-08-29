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
                <h2 style="text-align:left; width: 100%;">{{$singleObj -> company_name}}</h2>
                <h3 style="text-align:left;">{{$singleObj->title}}</h3>
            </header>
            
            <section style="text-align:left;">
                {{$singleObj->sub_title}}
            
                {{$singleObj->first_comment}}
            </section>
            <section style="text-align:left;">
                {{$singleObj->main_comment}}
            
                {{$singleObj->sub_comment}}
            </section>
            
            <section>
            <div class="imghere">企業の画像やロゴなど・・？？</div>
            <div class="table-responsive">
                <table class="table table-bordered company-table">
                    <colgroup>
                        <col class="col-xs-2" />
                        <col class="col-xs-7" />
                    </colgroup>
                    <tbody>
                        <tr>
                            <th scope="row">会社名</th>
                            <td>{{$singleObj -> company_name}}</td>
                        </tr>
                        <tr>
                            <th scope="row">時間</th>
                            <td>9:00〜</td>
                        </tr>
                        <tr>
                            <th scope="row">項目A</th>
                            <td>・・・</td>
                        </tr>
                        <tr>
                            <th scope="row">項目B</th>
                            <td>・・・</td>
                        </tr>
                        <tr>
                            <th scope="row">項目C</th>
                            <td>・・・</td>
                        </tr>
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
                {{-- pager('irohas', $singleObj->id) --}}
                <a href="{{ getUrl('recruit') }}" class="back-tx">案件情報一覧へ戻る</a>

            	{{-- 
            	@foreach($singleArr as $single)
            		<img src="/{{$single}}" width="270" height="200" />
                
                @endforeach
                 --}}
            </footer>
        </article>
    @endsection
