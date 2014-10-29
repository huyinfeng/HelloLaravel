<article class="picture">
    <header class="picture-header">
        <h1 class="picture-title">
            {{$picture->title}}
        </h1>
        <div class="clearfix">
            <span class="left date">{{explode(' ',$picture->created_at)[0]}}</span>
            <span class="right label">{{HTML::link('#reply','Reply',['style'=>'color:inherit'])}} </span>
        </div>
    </header>
    <div>
			{{HTML::image($picture['image'],$picture['image'])}}
	</div>
    <div class="picture-description">
        <p>{{ $picture->description }}</p>
    </div>
    <footer class="picture-footer">
        <hr>
    </footer>
</article>
<section class="comments">
    @if(!$comments->isEmpty())
        <h2>Comments on {{$picture->title}}</h2>
        <ul>
            @foreach($comments as $comment)
                <li>
                    <article>
                        <header>
                            <div class="clearfix">
                                <span class="right date">{{explode(' ',$comment->created_at)[0]}}</span>
                                <span class="left commenter">{{link_to_route('picture.show',$comment->commenter,$picture->id)}}</span>
                            </div>
                        </header>
                        <div class="comment-content">
                            <p>{{{$comment->comment}}}</p>
                        </div>
                        <footer>
                            <hr>
                        </footer>
                    </article>
                </li>
            @endforeach
        </ul>
    @else
        <h2>No Comments on [{{$picture->title}}]</h2>
    @endif
    <!--comment form -->
    @include('comments.commentform')
</section>
