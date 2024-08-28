<!-- Teacher Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('teacher_name', 'Teacher Name:') !!}
    {!! Form::text('teacher_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Mobile No Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mobile_no', 'Mobile No:') !!}
    {!! Form::text('mobile_no', null, ['class' => 'form-control', (isset($teacherDetail) ? ' disabled' : '')]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control', (isset($teacherDetail) ? ' disabled' : '')]) !!}
</div>
<?php if(isset($teacherDetail)) { ?>

<?php } else { ?>
    <div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('password_confirmation', 'Confirm Password:') !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
</div>
<?php } ?>

<!-- Inst Name Field -->
<div class="form-group col-sm-6">
{!! Form::label('institute_id', 'Institute:') !!}
<select name="institute_id" class="form-control">
        <option value="">Select Institute</option>
        @foreach ($institutes as $institute)
            <option value="{{ $institute->id }}" {{ isset($teacherDetail) && $institute->id == $teacherDetail->institute_id ? 'selected' : '' }} >{{ $institute->name }}</option>
        @endforeach
    </select>
</div>


<!-- Department Field -->
<div class="form-group col-sm-6">
    {!! Form::label('department', 'Department:') !!}
    {!! Form::text('department', null, ['class' => 'form-control']) !!}
</div>

<!-- Designation Field -->
<div class="form-group col-sm-6">
    {!! Form::label('designation', 'Designation:') !!}
    {!! Form::text('designation', null, ['class' => 'form-control']) !!}
</div>

<!-- Sub Taught Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subject_taught', 'Sub Taught:') !!}
    {!! Form::text('subject_taught', null, ['class' => 'form-control']) !!}
</div>

<!-- Resource Planing Field -->
<div class="form-group col-sm-6">
    {!! Form::label('resource_planning', 'Resource Planing:') !!}
    {!! Form::text('resource_planning', null, ['class' => 'form-control']) !!}
</div>

<!-- Teaching Resource Field -->
<div class="form-group col-sm-6">
    {!! Form::label('teaching_resource', 'Teaching Resource:') !!}
    {!! Form::text('teaching_resource', null, ['class' => 'form-control']) !!}
</div>

<!-- Student Strength Field -->
<div class="form-group col-sm-6">
    {!! Form::label('student_strength', 'Student Strength:') !!}
    {!! Form::text('student_strength', null, ['class' => 'form-control']) !!}
</div>
<!-- Number of Tokens -->
<div class="form-group col-sm-6">
    {!! Form::label('number_of_token', 'Number of Tokens:') !!}
    {!! Form::Number('number_of_token', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('teacherDetails.index') }}" class="btn btn-default">Cancel</a>
</div>
