<h2 class="edit-picture">
    Edit Picture
    <span class="right">{{ HTML::linkRoute('picture.list','Cancel',null,['class' => 'button tiny radius']) }}</span>
</h2>
<hr>
{{ Form::open(['route'=>['picture.update',$picture->id]]) }}
<div class="row">
    <div class="small-5 large-5 column">
        {{ Form::label('title','Picture Title:') }}
        {{ Form::text('title',Input::old('title',$picture->title)) }}
    </div>
</div>
<div class="row">
    <div class="small-7 large-7 column">
        {{ Form::label('description','Description:') }}
        {{ Form::textarea('description',Input::old('description',$picture->description),['rows'=>5]) }}
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
{{ Form::submit('Update',['class'=>'button tiny radius']) }}
{{ Form::label('warn', 'hint: you can not change image here, please delete it and reupload one') }}
{{ Form::close() }}
