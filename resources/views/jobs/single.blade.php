@extends('app')

    @section('content')
    
    	<?php
        	//$singleArr = explode(';', $singlepage->imgLink);
            //<img src="/{{$singleArr[0]}}" width="420" height="300" />
            //<a href="/reservation/article/{{$singl->job_number}}" class="btn">予約する</a> {{-- idを取ってそこからpageのデータを取るようにする　リンク先もid付きにする --}}
        ?>
        あいうえお
        <a href="{{url('recruit/entry/'.$singleObj->job_number)}}" class="btn btn-success">この求人に応募する</a>
        
        <article id="single">
            <header>
                <h1>{{$singleObj -> company_name}}</h1>
                <h2>{{$singleObj->title}}</h2>
                
            </header>
            
            <section>
                {{$singleObj->sub_title}}
            </section>
            <section>
                {{$singleObj->first_comment}}
            </section>
            <div>
                {{$singleObj->main_comment}}
            </div>
            <div>
                {{$singleObj->sub_comment}}
            </div>
            
            
            
            <footer>
            
            	{{-- 
            	@foreach($singleArr as $single)
            		<img src="/{{$single}}" width="270" height="200" />
                
                @endforeach
                 --}}
            </footer>
        </article>
    @endsection
