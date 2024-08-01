{!! Form::hidden('subscription_id', null, ['class' => 'form-control']) !!}
{!! Form::hidden('user_id', null, ['class' => 'form-control']) !!}
<!-- Plan Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('plan_name', 'Plan Name:') !!}
    {!! Form::text('plan_name', null, ['class' => 'form-control']) !!}

</div>

<!-- Plan Validity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('plan_validity', 'Plan Validity:') !!}
    {{ Form::input('dateTime-local','plan end date', \Carbon\Carbon::parse($subscriber->plan_end_date)->format('Y-m-d\TH:i'), array('class' => 'form-control', 'placeholder' => 'Validity date')) }}

</div>

<!-- Status Field -->

<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive','2' => 'Pending'],null, ['class' => 'form-control', $subscriber->status != 1 ? 'disabled' : '']) !!}

</div>

<!-- Status Field -->


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('subscribers.index') }}" class="btn btn-default">Cancel</a>
</div>