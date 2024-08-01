<!-- Book Name Field -->
<div class="form-group">
    {!! Form::label('book_name', 'Book Name:') !!}
    <p>{{ $appMaterial->book_name }}</p>
</div>

<!-- Book Image Field -->
<div class="form-group">
    {!! Form::label('book_image', 'Book Image:') !!}
    <p>{{ $appMaterial->book_image }}</p>
</div>

<!-- Publisher Field -->

<?php if(isset(Auth::user()->access->access_role) && Auth::user()->access->access_role != 3) { ?>
<div class="form-group">
    {!! Form::label('publisher', 'Publisher:') !!}
    <p>{{ $appMaterial->bookpublisher->publisher }}</p>
</div>
<?php } ?>

<!-- Year Field -->
<div class="form-group">
    {!! Form::label('year', 'Year:') !!}
    <p>{{ $appMaterial->year }}</p>
</div>

<!-- Book Pdf Field -->
<div class="form-group">
    {!! Form::label('book_pdf', 'Book Pdf:') !!}
    <p>{{ $appMaterial->book_pdf }}</p>
</div>

<!-- Length Field -->
<div class="form-group">
    {!! Form::label('length', 'Length:') !!}
    <p>{{ $appMaterial->length }}</p>
</div>

<!-- Summary Field -->
<div class="form-group">
    {!! Form::label('summary', 'Summary:') !!}
    <p>{{ $appMaterial->summary }}</p>
</div>

<!-- Tags Field -->
<div class="form-group">
    {!! Form::label('tags', 'Tags:') !!}
    <p>{{ $appMaterial->tags }}</p>
</div>

<!-- Author Field -->
<div class="form-group">
    {!! Form::label('author', 'Author:') !!}
    <p>{{ $appMaterial->author }}</p>
</div>

<!-- Language Field -->
<div class="form-group">
    {!! Form::label('language', 'Language:') !!}
    <p>{{ $appMaterial->language }}</p>
</div>

<!-- Material Type Field -->
<div class="form-group">
    {!! Form::label('material_type', 'Material Type:') !!}
    <p>{{ $appMaterial->material_type }}</p>
</div>

<!-- Genre Id Field -->
<div class="form-group">
    {!! Form::label('genre_id', 'Genre Id:') !!}
    <p>{{ $appMaterial->genre_id }}</p>
</div>

<!-- Department Id Field -->
<div class="form-group">
    {!! Form::label('department_id', 'Department Id:') !!}
    <p>{{ $appMaterial->department_id }}</p>
</div>

<!-- Subject Id Field -->
<div class="form-group">
    {!! Form::label('subject_id', 'Subject Id:') !!}
    <p>{{ $appMaterial->subject_id }}</p>
</div>

