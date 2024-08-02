<div class="table-responsive">
    <table class="table" id="accessRoles-table">
        <thead>
            <tr>
                <th>Role</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($accessRoles as $accessRole)
            <tr>
                <td>{{ $accessRole->role }}</td>
                <td>
                    {!! Form::open(['route' => ['accessRoles.destroy', $accessRole->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('accessRoles.show', [$accessRole->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('accessRoles.edit', [$accessRole->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
