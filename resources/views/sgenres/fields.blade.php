<!-- Genre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('genre', 'Genre:') !!}
    {!! Form::select('genre',$genre, null, ['class' => 'form-control']) !!}
</div>

<!-- Subgenre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subgenre', 'Subgenre:') !!}
    {!! Form::text('subgenre', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('sgenres.index') }}" class="btn btn-default">Cancel</a>
</div>
