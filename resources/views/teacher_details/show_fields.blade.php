<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $teacherDetail->id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $teacherDetail->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $teacherDetail->updated_at }}</p>
</div>

<!-- Teacher Name Field -->
<div class="form-group">
    {!! Form::label('teacher_name', 'Teacher Name:') !!}
    <p>{{ $teacherDetail->teacher_name }}</p>
</div>

<!-- Mobile No Field -->
<div class="form-group">
    {!! Form::label('mobile_no', 'Mobile No:') !!}
    <p>{{ $teacherDetail->mobile_no }}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $teacherDetail->email }}</p>
</div>

<!-- Inst Name Field -->
<div class="form-group">
    {!! Form::label('inst_name', 'Inst Name:') !!}
    <p>{{ $teacherDetail->institute_name }}</p>
</div>

<!-- Department Field -->
<div class="form-group">
    {!! Form::label('department', 'Department:') !!}
    <p>{{ $teacherDetail->department }}</p>
</div>

<!-- Designation Field -->
<div class="form-group">
    {!! Form::label('designation', 'Designation:') !!}
    <p>{{ $teacherDetail->designation }}</p>
</div>

<!-- Sub Taught Field -->
<div class="form-group">
    {!! Form::label('sub_taught', 'Sub Taught:') !!}
    <p>{{ $teacherDetail->subject_taught }}</p>
</div>

<!-- Resource Planing Field -->
<div class="form-group">
    {!! Form::label('resource_planing', 'Resource Planing:') !!}
    <p>{{ $teacherDetail->resource_planning }}</p>
</div>

<!-- Teaching Resource Field -->
<div class="form-group">
    {!! Form::label('teaching_resource', 'Teaching Resource:') !!}
    <p>{{ $teacherDetail->teaching_resource }}</p>
</div>

<!-- Student Strength Field -->
<div class="form-group">
    {!! Form::label('student_strength', 'Student Strength:') !!}
    <p>{{ $teacherDetail->student_strength }}</p>
</div>
<?php if($teacherDetail->is_pending == 1) { ?>
<div class="form-group">
<a href="{{ route('get_token_modal', ['id' => $teacherDetail->id]) }}" class="btn btn-success">Approve</a>
</div>
<?php } ?>

