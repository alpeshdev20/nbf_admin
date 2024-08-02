<!-- Company Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('company_name', 'Company Name:') !!}
    {!! Form::text('company_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<!-- City Field -->
<div class="form-group col-sm-6">
    {!! Form::label('city', 'City:') !!}
    {!! Form::text('city', null, ['class' => 'form-control']) !!}
</div>

<!-- Postal Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('postal_code', 'Postal Code:') !!}
    {!! Form::text('postal_code', null, ['class' => 'form-control']) !!}
</div>

<!-- Upload Address Proof Field -->
<div class="form-group col-sm-6">
    {!! Form::label('upload_address_proof', 'Upload Address Proof:') !!}
    {!! Form::text('upload_address_proof', null, ['class' => 'form-control']) !!}
</div>

<!-- Pan Card Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pan_card', 'Pan Card:') !!}
    {!! Form::text('pan_card', null, ['class' => 'form-control']) !!}
</div>

<!-- Aadhar Card Field -->
<div class="form-group col-sm-6">
    {!! Form::label('aadhar_card', 'Aadhar Card:') !!}
    {!! Form::text('aadhar_card', null, ['class' => 'form-control']) !!}
</div>

<!-- Gst Or Tin Card Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gst_or_tin_card', 'Gst Or Tin Card:') !!}
    {!! Form::text('gst_or_tin_card', null, ['class' => 'form-control']) !!}
</div>

<!-- First Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('first_name', 'First Name:') !!}
    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Last Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('last_name', 'Last Name:') !!}
    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Username Field -->
<div class="form-group col-sm-6">
    {!! Form::label('username', 'Username:') !!}
    {!! Form::text('username', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Select Question Field -->
<div class="form-group col-sm-6">
    {!! Form::label('select_question', 'Select Question:') !!}
    {!! Form::text('select_question', null, ['class' => 'form-control']) !!}
</div>

<!-- Security Answer Field -->
<div class="form-group col-sm-6">
    {!! Form::label('security_answer', 'Security Answer:') !!}
    {!! Form::text('security_answer', null, ['class' => 'form-control']) !!}
</div>

<!-- Check Box Field -->
<div class="form-group col-sm-6">
    {!! Form::label('check_box', 'Check Box:') !!}
    {!! Form::text('check_box', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('appPublishers.index') }}" class="btn btn-default">Cancel</a>
</div>
