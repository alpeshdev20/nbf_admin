{{-- {!! Form::model($blog, [
    'route' => $blog->exists ? ['blogs.update', $blog->id] : 'blogs.store',
    'method' => $blog->exists ? 'PUT' : 'POST',
    'id' => 'add_app_mat_form',
    'enctype' => 'multipart/form-data'
]) !!} --}}
<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:', ['for' => 'title']) !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'id' => 'title']) !!}
</div>

<!-- Publish Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_published', 'Active:') !!}
    {!! Form::select('is_published', [1 => 'Active', 0 => 'Inactive'], null, ['class' => 'form-control']) !!}
</div>

<!-- Image Field (Editable during both create and edit) -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Cover Image:') !!}
    {!! Form::file('image', ['class' => 'form-control', 'id' => 'image']) !!}

    <small id="image-error" class="form-text text-muted text-danger" style="display: none;"></small>
        <!-- If editing, show current image -->
    @if ($blog->exists && $blog->image)
        <div style="margin-top:10px;margin-left:10">
            <p>{{ $blog->image }}</p>
        </div>
        
    @endif
</div>

<!-- Slug Field -->
<div class="form-group col-sm-6">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', null, ['class' => 'form-control' ,'readonly' => 'readonly']) !!}
    <small id="slug-status" class="form-text text-muted"></small>
</div>

<!-- Content Field -->
<div class="form-group col-sm-12">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control richEdit']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'submit-form']) !!}
    <a href="{{ route('blogs.index') }}" class="btn btn-default">Cancel</a>
</div>

{{-- {!! Form::close() !!} --}}

<script>
   $(document).ready(function () {
    // Slug generation on title input
    $('#title').on('input', function () {
        let title = $(this).val();
        $.ajax({
            url: '{{ route('blog.generate.slug') }}',
            method: 'POST',
            data: {
                title: title,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                $('#slug').val(response.slug);
                $('#slug-status').text('Slug generated: ' + response.slug).css('color', 'green');
            },
            error: function () {
                $('#slug-status').text('Error generating slug.').css('color', 'red');
            }
        });
    });
});
</script>
