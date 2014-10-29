{{ Form::open(['url' => 'search','method'=>'get']) }}
	<div class="row">
		<div class="small-8 large-8 column">
			{{ Form::text('s',Input::old('username'),['placeholder'=>'Search blog...']) }}
		</div>
			{{ Form::submit('Search',['class'=>'button tiny radius']) }}
	</div>
{{ Form::close() }}
<div>
	<h3>Recent Pictures</h3>
	<ul>
	@foreach($recentPictures as $picture)
		<li>{{link_to_route('picture.show',$picture->title,$picture->id)}}</li>
	@endforeach
	</ul>
</div>

