<!-- Banner Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('banner_image', 'Banner Image:') !!}
    {!! Form::file('banner_image', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('carousels.index') }}" class="btn btn-default">Cancel</a>
</div>
