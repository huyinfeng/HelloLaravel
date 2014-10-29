<div class="small-3 large-3 column">
    <aside class="sidebar">
        <h2>Menu</h2>
        <ul class="side-nav">
            <li>{{HTML::link('/','Home')}}</li>
            <li class="divider"></li>
            <li class="{{ (strpos(URL::current(),route('picture.new'))!== false) ? 'active' : '' }}">
                {{HTML::linkRoute('picture.new','New picture')}}
            </li >
            <li class="{{ (strpos(URL::current(),route('picture.list'))!== false) ? 'active' : '' }}">
                {{HTML::linkRoute('picture.list','List pictures')}}
            </li>
            <li class="divider"></li>
            <li class="{{ (strpos(URL::current(),route('comment.list'))!== false) ? 'active' : '' }}">
                {{HTML::linkRoute('comment.list','List Comments')}}
            </li>
        </ul>
    </aside>
</div>
<div class="small-9 large-9 column">
    <div class="content">
        @if(Session::has('success'))
        <div data-alert class="alert-box round">
            {{Session::get('success')}}
            <a href="#" class="close">&times;</a>
        </div>
        @endif
		@if(Session::has('failure'))
        <div data-alert class="alert-box warning round">
            {{Session::get('failure')}}
            <a href="#" class="close">&times;</a>
        </div>
        @endif
        {{$content}}
    </div>
    <div id="comment-show" class="reveal-modal small" data-reveal>
        {{-- quick comment --}}
    </div>
</div>

