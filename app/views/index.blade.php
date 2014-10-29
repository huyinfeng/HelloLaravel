@if(!empty($notFound))
<p>Sorry nothing found for your query!</p>
@else
@foreach($pictures as $picture)
	<article class="picture">
		<header class="picture-header">
			<h1 class="picture-title">
				{{link_to_route('picture.show',$picture->title,$picture->id)}}
			</h1>
			<div class="clearfix">
				<span class="left date">{{explode(' ',$picture->created_at)[0]}}</span>
				<span class="right label">{{$picture->comment_count}} comments </span>
			</div>
		</header>
		<div>
			{{HTML::image($picture['image'],$picture['image'])}}
		</div>
		<div class="picture-description">
			<p>{{$picture->description}}</p>
		</div>
		<footer class="picture-footer">
			<hr>
		</footer>
	</article>
@endforeach
{{$pictures->links()}}
@endif
