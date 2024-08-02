<!-- Materialupload Id Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('materialupload_id', 'Materialupload Id:') !!}
    {!! Form::text('materialupload_id', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Cover Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cover', 'Cover:') !!}
    {!! Form::file('cover') !!}
</div>
<div class="clearfix"></div>

<!-- File Field -->
<div class="form-group col-sm-6">
    {!! Form::label('file', 'File:') !!}
    {!! Form::file('file') !!}
</div>
<div class="clearfix"></div>

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Author Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('author_name', 'Author Name:') !!}
    {!! Form::text('author_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Publisher Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('publisher_name', 'Publisher Name:') !!}
    {!! Form::text('publisher_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Publication Year Field -->
<div class="form-group col-sm-6">
    {!! Form::label('publication_year', 'Publication Year:') !!}
    {!! Form::text('publication_year', null, ['class' => 'form-control']) !!}
</div>

<!-- Genre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('genre', 'Genre:') !!}
    {!! Form::select('genre', $genre, null, ['class' => 'form-control']) !!}
</div>

<!-- Subgenre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subgenre', 'Subgenre:') !!}
    {!! Form::select('subgenre', $sgenre, null, ['class' => 'form-control']) !!}
</div>

<!-- Language Field -->
<div class="form-group col-sm-6">
    {!! Form::label('language', 'Language:') !!}
    {!! Form::select('language', $lang, null, ['class' => 'form-control']) !!}
</div>

<!-- Length Field -->
<div class="form-group col-sm-6">
    {!! Form::label('length', 'Length:') !!}
    {!! Form::text('length', null, ['class' => 'form-control']) !!}
</div>

<!-- Isbn Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('isbn_code', 'Isbn Code:') !!}
    {!! Form::text('isbn_code', null, ['class' => 'form-control']) !!}
</div>

<!-- Summary Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('summary', 'Summary:') !!}
    {!! Form::textarea('summary', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('audioBooks.index') }}" class="btn btn-default">Cancel</a>
</div>
