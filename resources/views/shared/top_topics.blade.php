<section class="tp-topics clearfix">
    <h2>TOPICS</h2>
    <div>
        @foreach($topTopics as $topic)
        <article>
            <a href="{{ getUrl('topics/'.$topic->id) }}">
                <small>{{ getStrDate($topic->created_at) }}</small>
                <h3>{{ $topic -> title}}</h3>
            </a>
        </article>
        @endforeach
        
        <a href="{{getUrl('topics')}}" class="topic-link">トピックス一覧</a>
    </div>
</section>

