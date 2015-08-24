@extends('app')

    @section('content')
    
    	<?php
        	//$singleArr = explode(';', $singlepage->imgLink);
            //<img src="/{{$singleArr[0]}}" width="420" height="300" />
            //<a href="/reservation/article/{{$singl->job_number}}" class="btn">予約する</a> {{-- idを取ってそこからpageのデータを取るようにする　リンク先もid付きにする --}}
        ?>
        
        <ul class="breadcrumb">
            <li><a href="{{getUrl('/')}}"><span class="octicon octicon-home"></span>Home</a></li>
            <li><a href="{{getUrl('iroha')}}">監査役いろは</a></li>
            <li><a href="{{getUrl('iroha/study')}}">勉強会一覧</a></li>
            <li>@if($singleObj->sub_title != ''){{$singleObj->sub_title}}
            @else{{$singleObj->title}}@endif</li>
        </ul>
        
        {{-- <a href="{{url('recruit/entry/'.$singleObj->job_number)}}" class="btn btn-success">この求人に応募する</a> --}}
        <a href="{{ getUrl('recruit') }}" class="center-block back-tx">企業情報一覧へ戻る</a>
        
        <article style="text-align:left;" class="single study-sgl">
            <header>
            	<small>{!! getStrDate($singleObj->created_at, 'slash') !!}</small>
                <a href="{{ getUrl('recruit/entry/'.$singleObj->job_number) }}" class="edit-btn">この求人に応募する</a>
                <h2>{{$singleObj -> company_name}}</h2>
                <h3>{{$singleObj->title}}</h3>
                
            </header>
            
            <section style="text-align:left;">
                {{$singleObj->sub_title}}
            
                {{$singleObj->first_comment}}
            </section>
            <section style="text-align:left;">
                {{$singleObj->main_comment}}
            
                {{$singleObj->sub_comment}}
            </section>
            <br><br>
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
                            <th scope="row">その他A</th>
                            <td>・・・</td>
                        </tr>
                        <tr>
                            <th scope="row">その他B</th>
                            <td>・・・</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            
            
            
            <footer>
            	<a href="{{ getUrl('recruit/job/'.$singleObj->job_number) }}" class="edit-btn">この求人に応募する</a>   
                {{-- pager('irohas', $singleObj->id) --}}
                <a href="{{ getUrl('recruit') }}" class="center-block back-tx">企業情報一覧へ戻る</a>

            	{{-- 
            	@foreach($singleArr as $single)
            		<img src="/{{$single}}" width="270" height="200" />
                
                @endforeach
                 --}}
            </footer>
        </article>
    @endsection
