<h1 class="page-header">
    @if(Request::is('*/pages'))
        <span class="mega-octicon octicon-book"></span>固定ページ一覧
    @elseif(Request::is('*/jobs'))
        <span class="mega-octicon octicon-file-directory"></span>案件情報一覧
    @elseif(Request::is('*/topics'))
        <span class="mega-octicon octicon-megaphone"></span>トピックス一覧
    @elseif(Request::is('*/irohas'))
        <span class="mega-octicon octicon-repo"></span>いろはページ一覧
    @elseif(Request::is('*/study'))
        <span class="mega-octicon octicon-repo"></span>勉強会一覧
    @elseif(Request::is('*/blog'))
        <span class="mega-octicon octicon-file-text"></span>ブログ一覧
    @else
        <span class="octicon octicon-alert"></span>No Title
    @endif
</h1>