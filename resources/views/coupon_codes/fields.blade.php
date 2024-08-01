<div class="form-group col-sm-6">
    {!! Form::label('code', ' Code:') !!}
    {!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('discount_percentage', 'Discount (%):') !!}
    {!! Form::number('discount_percentage', null, ['class' => 'form-control', 'min' => 5, 'max' => '99']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('expiry_date', 'Expiry Date:') !!}
    {!! Form::date('expiry_date',null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'],null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('coupon_codes.index') }}" class="btn btn-default">Cancel</a>
</div>