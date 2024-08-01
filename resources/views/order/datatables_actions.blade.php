<div class='btn-group'>
    <a target="_blank" href="{{ env('NBF_API_URL') }}/uploads/invoices/{{ $id }}.pdf" class='btn btn-default btn-xs'>
    <i class="fa fa-download" aria-hidden="true"></i>
    </a>
    <a href="{{ route('order.show', $id) }}" class='btn btn-default btn-xs hide'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
</div>
