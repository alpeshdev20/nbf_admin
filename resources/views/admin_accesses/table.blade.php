<div class="table-responsive">
    <table class="table" id="adminAccesses-table">
        <thead>
            <tr>
                <th>Access Role</th>
        <th>Admin Id</th>
        <th>Active</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($adminAccesses as $adminAccess)
            <tr>
                <td>{{ $adminAccess->access_role }}</td>
            <td>{{ $adminAccess->admin_id }}</td>
            <td>{{ $adminAccess->active }}</td>
                <td>
                    {!! Form::open(['route' => ['adminAccesses.destroy', $adminAccess->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('adminAccesses.show', [$adminAccess->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('adminAccesses.edit', [$adminAccess->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
