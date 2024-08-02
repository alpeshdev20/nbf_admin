<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $adminAccess->id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $adminAccess->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $adminAccess->updated_at }}</p>
</div>

<!-- Access Role Field -->
<div class="form-group">
    {!! Form::label('access_role', 'Access Role:') !!}
    <p>{{ $adminAccess->access_role }}</p>
</div>

<!-- Admin Id Field -->
<div class="form-group">
    {!! Form::label('admin_id', 'Admin Id:') !!}
    <p>{{ $adminAccess->admin_id }}</p>
</div>

<!-- Active Field -->
<div class="form-group">
    {!! Form::label('active', 'Active:') !!}
    <p>{{ $adminAccess->active }}</p>
</div>

