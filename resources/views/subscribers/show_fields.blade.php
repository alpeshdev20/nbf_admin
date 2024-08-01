<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $subscriber->user->name }}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $subscriber->user->email }}</p>
</div>

<!-- Plan Name Field -->
<div class="form-group">
    {!! Form::label('plan_name', 'Plan Name:') !!}
    <p>{{ $subscriber->plan_name }}</p>
</div>

<!-- Plan Validity Field -->
<div class="form-group">
    {!! Form::label('plan_validity', 'Plan Validity:') !!}
    <p>{{ $subscriber->plan_end_date }}</p>
</div>

<div class="form-group">
    {!! Form::label('price', 'Plan Category:') !!}

    @if($subscriber->plan_category == 0)
    <p>Free</p>
    @elseif($subscriber->plan_category == 1)
    <p>Basic</p>
    @else
    <p>Premium</p>
    @endif

</div>

<div class="form-group">
    {!! Form::label('configuration_type', 'Configuration Type:') !!}
    <p>{{ $subscriber->configuration_type != '0' ? 'Customized (Genre, Department, Subject)' : 'Material Type' }}</p>
</div>

@if($subscriber->configuration_type != '0')
<div class="form-group">
    {!! Form::label('publisher', 'Allowed Publisher:') !!}
    <p>
        @foreach($allowedPublisher as $value)
        <span>{{ $value->publisher }}</span><br />
        @endforeach
    </p>
</div>
<div class="form-group">
    {!! Form::label('genre_name', 'Allowed Genres:') !!}
    <p>
        @foreach($allowedGeners as $value)
        <span>{{ $value->genre_name }}</span><br />
        @endforeach
    </p>
</div>
<div class="form-group">
    {!! Form::label('department_name', 'Allowed Departments:') !!}
    <p>
        @foreach($allowedDepartment as $value)
        <span>{{ $value->department_name }}</span><br />
        @endforeach
    </p>
</div>
<div class="form-group">
    {!! Form::label('subject_name', 'Allowed Subject:') !!}
    <p>
        @foreach($allowedSubjects as $value)
        <span>{{ @$value->subject_name }}</span><br />
        @endforeach
    </p>
</div>
@else
<div class="form-group">
    {!! Form::label('book_name', 'Allowed Material:') !!}
    <p>
        @foreach($allowedMaterial as $value)
        <span>{{ $value->material_type }}</span><br />
        @endforeach
    </p>
</div>
@endif

<div class="form-group">
    {!! Form::label('discription', 'Discription:') !!}
    <p>{{ $subscriber->subscription->description }}</p>
</div>