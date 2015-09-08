<section class="jobs clearfix">
    <h2>NEW</h2>
    <div>
        @foreach($jobs as $job)
            <article>
                <a href="{{getUrl('recruit/job/'.$job->job_number)}}">
                <small>{{ getStrDate($job->created_at) }}</small>
                <h3>{{ $job->company_name }}<br><span>{{ $job ->title }}</span></h3>
                </a>
            </article>
        @endforeach

        <a href="{{getUrl('recruit')}}" class="user-link">案件情報一覧</a>
    </div>
</section>
