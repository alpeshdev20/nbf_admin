<!-- File Path Field -->
<?php $base = "https://ebook.netbookflix.com";?>
<div class="form-group">
    {!! Form::label('file_path', 'File Path:') !!}
    <img src={{ $base.$appLogos->file_path }} height=100>
    <!-- <p>{{ $appLogos->file_path }}</p> -->
</div>

<!-- Text 1 Field -->
<div class="form-group">
    {!! Form::label('text_1', 'Text 1:') !!}
    <p>{{ $appLogos->text_1 }}</p>
</div>

<!-- Text 2 Field -->
<div class="form-group">
    {!! Form::label('text_2', 'Text 2:') !!}
    <p>{{ $appLogos->text_2 }}</p>
</div>

<!-- Text 3 Field -->
<div class="form-group">
    {!! Form::label('text_3', 'Text 3:') !!}
    <p>{{ $appLogos->text_3 }}</p>
</div>

