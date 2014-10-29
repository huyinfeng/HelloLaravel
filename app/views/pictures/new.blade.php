<h2 class="new-picture">
    Add New Picture
    <span class="right">{{ HTML::link('admin/dash-board','Cancel',['class' => 'button tiny radius']) }}</span>
</h2>
<hr>
{{ Form::open(['route'=>['picture.save'], 'enctype' => 'multipart/form-data']) }}
<div class="row">
    <div class="small-5 large-5 column">
        {{ Form::label('title','Picture Title:') }}
        {{ Form::text('title',Input::old('title')) }}
    </div>
</div>
<div class="row">
    <div class="small-7 large-7 column">
        {{ Form::label('description','Description:') }}
        {{ Form::textarea('description',Input::old('description'),['rows'=>5]) }}
    </div>
</div>
<div class="row">
	<div class="small-7 large-7 column">
		{{ Form::label('picture','Load your picture:') }}
		{{ Form::file('picture') }}
	</div>
</div>
@if($errors->has())
@foreach($errors->all() as $error)
<div data-alert class="alert-box warning round">
    {{$error}}
    <a href="#" class="close">&times;</a>
</div>
@endforeach
@endif
{{ Form::submit('Save',['class'=>'button tiny radius']) }}
{{ Form::close() }}
