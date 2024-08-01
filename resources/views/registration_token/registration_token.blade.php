@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Registration Form
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                   <form action="submit" method="post">
                        @csrf
                        <!-- Teacher Name Field -->
                        <div class="col-md-6">
<div class="form-group">
    {!! Form::label('School', 'School Name:') !!}
   
    <select name="school_id" class="form-control">
        <option>Select school</option>
        @foreach($value as $val)
            <option value="{{$val->id}}" @if(!empty($val) && $val->id == $val->id) selected @endif>{{ $val->name}}</option>
        @endforeach
    </select>
  
</div>
<div class="form-group">
    {!! Form::label('Status', 'Token:') !!}
    <input type="text" name="token" class="form-control">
</div>
<!-- Mobile No Field -->
<!---<div class="form-group">
    {!! Form::label('Status', 'Status:') !!}
    <select name="status" class="form-control" required>
        <option value="1" >{{ trans('Active') }}</option>
        <option value="0" >{{ trans('Deactive') }}</option>
        
    </select>
</div>---->


<div class="form-group">
    <button class="btn btn-primary pull-left" type="submit">{{ trans('save_changes') }}</button>
</div>

<div>

</form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
     $(document).ready(function(){
				setTimeout(function() {
					$('.alert-success').remove();
				}, 2000); 
				
    });

</script>