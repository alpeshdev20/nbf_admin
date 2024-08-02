<!-- Page Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('page_name', 'Page Name:') !!}
    {!! Form::text('page_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Active Field -->
<div class="form-group col-sm-6">
    {!! Form::label('active', 'Active:') !!}
    {!! Form::select('active', ['1' => 'Active', '0' => 'Inactive'], null, ['class' => 'form-control']) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-12">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control richEdit']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('cmsPages.index') }}" class="btn btn-default">Cancel</a>
</div>
