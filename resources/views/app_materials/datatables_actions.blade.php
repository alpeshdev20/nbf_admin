{!! Form::open(['route' => ['appMaterials.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('appMaterials.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
    <a href="{{ route('appMaterials.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
    @if(\Auth::user()->access->access_role == 1)
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
    @endif
</div>
{!! Form::close() !!}
