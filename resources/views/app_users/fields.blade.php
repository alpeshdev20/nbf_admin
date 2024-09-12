<!-- Form Start -->
{{-- <input type="hidden" name="user_email" value="{{$appUser->email}}" /> --}}

{!! Form::open(['id' => 'userForm', 'route' => 'appUsers.store']) !!}

<!-- User Type (Individual or Institutional) Field -->
<div class="form-group col-sm-6" style="margin-top:10px;">
    {!! Form::label('user_type', 'User Type:') !!}
    <div>
        {!! Form::radio('user_type', 'Individual User', false, ['id' => 'individual_user', 'required' => 'required']) !!} Individual User
        {!! Form::radio('user_type', 'Institutional User', false, ['id' => 'institutional_user', 'required' => 'required']) !!} Institutional User
    </div>
</div>


<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:*') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:*') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>

<!-- Mobile Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mobile', 'Mobile:') !!}
    {!! Form::text('mobile', null, ['class' => 'form-control' ,'required' => 'required']) !!}
</div>
<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    @if (isset($appUser)) 
        {{-- In edit mode, password is not required --}}
        {!! Form::password('password', ['class' => 'form-control']) !!}
    @else
        {{-- In create mode, password is required --}}
        {!! Form::password('password', ['class' => 'form-control', 'required' => 'required']) !!}
    @endif
</div>


<!-- Birthday Field -->
<div class="form-group col-sm-6">
    {!! Form::label('birthday', 'Birthday:') !!}
    {!! Form::date('birthday', null, ['class' => 'form-control', 'id' => 'birthday', 'required' => 'required']) !!}
</div>

<!-- Gender Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gender', 'Gender:') !!}
    {!! Form::select('gender', ['Male' => 'Male', 'Female' => 'Female'], null, ['class' => 'form-control','required' => 'required', 'placeholder' => 'Select Gender']) !!}
</div>

<!-- Preferred Segment Field -->
<div class="form-group col-sm-6" style="margin-top:20px;">
    {!! Form::label('preferred_segment', 'Preferred Segment:*') !!}
    <div>
        {!! Form::radio('preferred_segment', 'K12/School', false, ['id' => 'k12_school', 'required' => 'required']) !!} K12/School
        {!! Form::radio('preferred_segment', 'Higher Education', false, ['id' => 'higher_education', 'required' => 'required']) !!} Higher Education
    </div>
</div>

<!-- Class Field -->
<div class="form-group col-sm-12">
    {!! Form::label('class', 'Class:*') !!}
    {!! Form::select('class', $classesData, null, ['class' => 'form-control', 'placeholder' => 'Select Class']) !!}
</div>

<!-- Subscription Plan Field (Dropdown) -->
<div class="form-group col-sm-6">
    {!! Form::label('subscription_plan', 'Select Subscription Plan:*') !!}
    <select name="subscription_plan" class="form-control" required>
        <option value="">-- Select Plan --</option>
        @foreach($subscriptions as $plan)
            <option value="{{ $plan->id }}">
                {{ $plan->name }} - price {{ $plan->price }}  - 
                {{ $plan->plan_category == 1 ? 'Basic Plan' : 'Premium Plan' }} - 
                Validity {{ $plan->validity }} days
            </option>
        @endforeach
    </select>
</div>

<!-- User Active Field -->
<div class="form-group col-sm-6" style="margin-top:20px;">
    {!! Form::label('is_active', 'Is Active:') !!}
    <div>
        {!! Form::radio('is_active', '1', true, ['id' => 'active_yes']) !!} Active
        {!! Form::radio('is_active', '2', false, ['id' => 'active_no']) !!} Inactive
    </div>
</div>


<!-- Personal Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('personal_address', 'Personal Address:') !!}
    {!! Form::textarea('personal_address', null, ['class' => 'form-control' ,'required' => 'required']) !!}
</div>

<!-- Institute Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('institute_address', 'Institute Address:') !!}
    {!! Form::textarea('institute_address', null, ['class' => 'form-control' ,]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('appUsers.index') }}" class="btn btn-default">Cancel</a>
</div>

{!! Form::close() !!}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js" defer></script>
    
<script>

$(document).ready(function() {
  
        var today = new Date().toISOString().split('T')[0];
        $('#birthday').attr('max', today);
    
});

</script>