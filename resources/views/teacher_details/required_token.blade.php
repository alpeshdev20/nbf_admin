@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Teacher Detail
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                {!! Form::open(['id'=>'token_form', 'route' => 'approved']) !!}
						
                        <!-- Parent Group Field -->
                        <input type="hidden" name="id" value="{{$id}}" />
						<div class="form-group col-sm-6">
							{!! Form::label('allowed_token', 'Allowed token:') !!}
							{!! Form::number('allowed_token', 0, ['class' => 'form-control','max' => 999999,'type' => 'number']) !!}
						</div>
						
						<!-- Submit Field -->
						<div class="form-group col-sm-12">
							{!! Form::submit('Approve', ['class' => 'btn btn-primary']) !!}
							<a href="{{ route('teacherDetails.index') }}" class="btn btn-default">Cancel</a>
						</div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection