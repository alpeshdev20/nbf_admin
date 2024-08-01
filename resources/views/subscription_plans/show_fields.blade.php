<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $subscriptionPlan->name }}</p>
</div>

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', 'Price:') !!}
    <p>{{ $subscriptionPlan->price }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $subscriptionPlan->description }}</p>
</div>

<!-- Validity Field -->
<div class="form-group">
    {!! Form::label('validity', 'Validity:') !!}
    <p>{{ $subscriptionPlan->validity }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $subscriptionPlan->status }}</p>
</div>
