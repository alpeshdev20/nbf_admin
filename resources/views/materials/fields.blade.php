<!-- Material Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('material_type', 'Material Type:') !!}
    {!! Form::text('material_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('materials.index') }}" class="btn btn-default">Cancel</a>
</div>
