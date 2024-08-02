<!-- Language Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('language_name', 'Language Name:') !!}
    {!! Form::text('language_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('languages.index') }}" class="btn btn-default">Cancel</a>
</div>
