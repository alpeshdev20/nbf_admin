<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $appSubject->id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $appSubject->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $appSubject->updated_at }}</p>
</div>

<!-- Subject Name Field -->
<div class="form-group">
    {!! Form::label('subject_name', 'Subject Name:') !!}
    <p>{{ $appSubject->subject_name }}</p>
</div>

<!-- Department Id Field -->
<div class="form-group">
    {!! Form::label('department_id', 'Department Id:') !!}
    <p>{{ $appSubject->department_id }}</p>
</div>

