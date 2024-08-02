<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $appDepartment->id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $appDepartment->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $appDepartment->updated_at }}</p>
</div>

<!-- Department Name Field -->
<div class="form-group">
    {!! Form::label('department_name', 'Department Name:') !!}
    <p>{{ $appDepartment->department_name }}</p>
</div>

<!-- Genre Id Field -->
<div class="form-group">
    {!! Form::label('genre_id', 'Genre Id:') !!}
    <p>{{ $appDepartment->genre_id }}</p>
</div>

