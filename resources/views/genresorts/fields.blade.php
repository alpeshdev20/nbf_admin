<!-- Genre Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('genre_id', 'Genre Id:') !!}
    {!! Form::text('genre_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Sort Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sort', 'Sort:') !!}
    {!! Form::text('sort', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('genresorts.index') }}" class="btn btn-default">Cancel</a>
</div>
