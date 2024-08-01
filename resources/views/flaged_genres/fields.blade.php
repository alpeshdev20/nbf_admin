<!-- Genre Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('genre_id', 'Genre Id:') !!}
    {!! Form::text('genre_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Genre Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('genre_name', 'Genre Name:') !!}
    {!! Form::text('genre_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('flagedGenres.index') }}" class="btn btn-default">Cancel</a>
</div>
