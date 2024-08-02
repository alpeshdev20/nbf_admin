@if($refund_amount && $refund_status == 'pending')

{!! Form::open(['route' => ['transaction.update', $id], 'method' => 'PUT']) !!}
<div class='btn-group'>
    {!! Form::button('<i class="glyphicon glyphicon-ok"></i>', [
    'type' => 'submit',
    'onclick' => "return confirm('Are you sure, you want to mark as done the pending status?')"
    ]) !!}
</div>
{!! Form::close() !!}

@endif