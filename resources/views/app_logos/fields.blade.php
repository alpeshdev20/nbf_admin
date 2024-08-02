<!-- File Path Field -->
<?php $base = "https://ebook.netbookflix.com/";?>
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('file_path', 'File Path:') !!}
    {!! Form::file('file_path', null, ['class' => 'form-control']) !!}
</div>

<!-- Text 1 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('text_1', 'Text 1:') !!}
    {!! Form::text('text_1', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Text 2 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('text_2', 'Text 2:') !!}
    {!! Form::text('text_2', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Text 3 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('text_3', 'Text 3:') !!}
    {!! Form::text('text_3', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('appLogos.index') }}" class="btn btn-default">Cancel</a>
</div>
