<!-- Genre Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('genre_id', 'Genre :') !!}
    {!! Form::select('genre_id',$genre, null, ['class' => 'form-control']) !!}
</div>


<!-- Department Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('department_name', 'Department Name:') !!}
    {!! Form::text('department_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('appDepartments.index') }}" class="btn btn-default">Cancel</a>
</div>
