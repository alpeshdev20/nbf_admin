<!-- User Id Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::textarea('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Transaction Id Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('transaction_id', 'Transaction Id:') !!}
    {!! Form::textarea('transaction_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Subscription Plan Id Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('subscription_plan_id', 'Subscription Plan Id:') !!}
    {!! Form::textarea('subscription_plan_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Plan Validity Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('plan_validity', 'Plan Validity:') !!}
    {!! Form::textarea('plan_validity', null, ['class' => 'form-control']) !!}
</div>

<!-- Bank Ref No Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('bank_ref_no', 'Bank Ref No:') !!}
    {!! Form::textarea('bank_ref_no', null, ['class' => 'form-control']) !!}
</div>

<!-- Order Status Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('order_status', 'Order Status:') !!}
    {!! Form::textarea('order_status', null, ['class' => 'form-control']) !!}
</div>

<!-- Failure Message Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('failure_message', 'Failure Message:') !!}
    {!! Form::textarea('failure_message', null, ['class' => 'form-control']) !!}
</div>

<!-- Payment Mode Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('payment_mode', 'Payment Mode:') !!}
    {!! Form::textarea('payment_mode', null, ['class' => 'form-control']) !!}
</div>

<!-- Card Name Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('card_name', 'Card Name:') !!}
    {!! Form::textarea('card_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Code Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('status_code', 'Status Code:') !!}
    {!! Form::textarea('status_code', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Message Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('status_message', 'Status Message:') !!}
    {!! Form::textarea('status_message', null, ['class' => 'form-control']) !!}
</div>

<!-- Currency Field -->
<div class="form-group col-sm-6">
    {!! Form::label('currency', 'Currency:') !!}
    {!! Form::text('currency', null, ['class' => 'form-control']) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('subscriptions.index') }}" class="btn btn-default">Cancel</a>
</div>
