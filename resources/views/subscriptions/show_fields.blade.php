<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $subscription->user_id }}</p>
</div>

<!-- Transaction Id Field -->
<div class="form-group">
    {!! Form::label('transaction_id', 'Transaction Id:') !!}
    <p>{{ $subscription->transaction_id }}</p>
</div>

<!-- Subscription Plan Id Field -->
<div class="form-group">
    {!! Form::label('subscription_plan_id', 'Subscription Plan Id:') !!}
    <p>{{ $subscription->subscription_plan_id }}</p>
</div>

<!-- Plan Validity Field -->
<div class="form-group">
    {!! Form::label('plan_validity', 'Plan Validity:') !!}
    <p>{{ $subscription->plan_validity }}</p>
</div>

<!-- Bank Ref No Field -->
<div class="form-group">
    {!! Form::label('bank_ref_no', 'Bank Ref No:') !!}
    <p>{{ $subscription->bank_ref_no }}</p>
</div>

<!-- Order Status Field -->
<div class="form-group">
    {!! Form::label('order_status', 'Order Status:') !!}
    <p>{{ $subscription->order_status }}</p>
</div>

<!-- Failure Message Field -->
<div class="form-group">
    {!! Form::label('failure_message', 'Failure Message:') !!}
    <p>{{ $subscription->failure_message }}</p>
</div>

<!-- Payment Mode Field -->
<div class="form-group">
    {!! Form::label('payment_mode', 'Payment Mode:') !!}
    <p>{{ $subscription->payment_mode }}</p>
</div>

<!-- Card Name Field -->
<div class="form-group">
    {!! Form::label('card_name', 'Card Name:') !!}
    <p>{{ $subscription->card_name }}</p>
</div>

<!-- Status Code Field -->
<div class="form-group">
    {!! Form::label('status_code', 'Status Code:') !!}
    <p>{{ $subscription->status_code }}</p>
</div>

<!-- Status Message Field -->
<div class="form-group">
    {!! Form::label('status_message', 'Status Message:') !!}
    <p>{{ $subscription->status_message }}</p>
</div>

<!-- Currency Field -->
<div class="form-group">
    {!! Form::label('currency', 'Currency:') !!}
    <p>{{ $subscription->currency }}</p>
</div>

<!-- Amount Field -->
<div class="form-group">
    {!! Form::label('amount', 'Amount:') !!}
    <p>{{ $subscription->amount }}</p>
</div>

