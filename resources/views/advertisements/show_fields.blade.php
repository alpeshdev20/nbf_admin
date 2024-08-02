<!-- Image Field -->
<div class="form-group">
    {!! Form::label('image', 'Image:') !!}
    <p>{{ $advertisement->image }}</p>
</div>

<!-- Heading Field -->
<div class="form-group">
    {!! Form::label('heading', 'Heading:') !!}
    <p>{{ $advertisement->heading }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $advertisement->description }}</p>
</div>

