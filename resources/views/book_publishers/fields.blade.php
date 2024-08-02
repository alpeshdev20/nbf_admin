<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'Owner :') !!}
    {!! Form::select('user_id',$admins, null, ['class' => 'form-control']) !!}
</div>

<!-- Publisher Field -->
<div class="form-group col-sm-6">
    {!! Form::label('publisher', 'Publisher:') !!}
    {!! Form::text('publisher', null, ['class' => 'form-control']) !!}
</div>

<!-- Active Field -->
<div class="form-group col-sm-6">
    {!! Form::label('active', 'Active:') !!}
    {!! Form::select('active',  ['1' => 'Active', '0' => 'Inactive'],null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('bookPublishers.index') }}" class="btn btn-default">Cancel</a>
</div>
