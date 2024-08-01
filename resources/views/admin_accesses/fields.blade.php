<!-- Access Role Field -->
<div class="form-group col-sm-6">
    {!! Form::label('access_role', 'Access Role:') !!}
    {!! Form::text('access_role', null, ['class' => 'form-control']) !!}
</div>

<!-- Admin Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('admin_id', 'Admin Id:') !!}
    {!! Form::text('admin_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Active Field -->
<div class="form-group col-sm-6">
    {!! Form::label('active', 'Active:') !!}
    {!! Form::text('active', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('adminAccesses.index') }}" class="btn btn-default">Cancel</a>
</div>
