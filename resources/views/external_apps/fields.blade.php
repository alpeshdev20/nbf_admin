<!-- Name Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<?php $private_key=Illuminate\Support\Str::uuid();
$public_key=Illuminate\Support\Str::random(64);?>
<input type="hidden" name="private_key" value="{{$private_key}}">
<input type="hidden" name="public_key" value="{{$public_key}}">
<!-- Url Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('url', 'Url:') !!}
    {!! Form::text('url', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <!-- {!! Form::text('status', null, ['class' => 'form-control']) !!} -->
    {!! Form::select('status', ['ACTIVE' => 'Active', 'INACTIVE' => 'Inactive'], null, ['class' => 'form-control subjectObject']) !!}

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('externalApps.index') }}" class="btn btn-default">Cancel</a>
</div>
