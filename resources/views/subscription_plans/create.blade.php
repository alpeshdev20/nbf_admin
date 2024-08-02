@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Subscription Plan
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'subscriptionPlans.store']) !!}

                        @include('subscription_plans.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
