<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $sgenre->id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $sgenre->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $sgenre->updated_at }}</p>
</div>

<!-- Genre Field -->
<div class="form-group">
    {!! Form::label('genre', 'Genre:') !!}
    <p>{{ $sgenre->genre }}</p>
</div>

<!-- Subgenre Field -->
<div class="form-group">
    {!! Form::label('subgenre', 'Subgenre:') !!}
    <p>{{ $sgenre->subgenre }}</p>
</div>

