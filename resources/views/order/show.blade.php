@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>
        Order details
    </h1>
</section>
<div class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div class="row" style="padding-left: 20px">

                <div class="form-group">
                    {!! Form::label('name', 'Name:') !!}
                    <p>{{ @$order_details->user->name ? $order_details->user->name : 'NA' }}</p>
                </div>

                <div class="form-group">
                    {!! Form::label('subscription_name', 'Subscription name:') !!}
                    <p>{{ $order_details->subscription_name ? $order_details->subscription_name : 'NA' }}</p>
                </div>

                <div class="form-group">
                    {!! Form::label('subscription_validity', 'Subscription validity:') !!}
                    <p>{{ $order_details->subscription_validity ? $order_details->subscription_validity : 'NA' }}</p>
                </div>

                <div class="form-group">
                    {!! Form::label('coupon_code_id', 'Applied coupon code:') !!}
                    <p>{{ $user_details->code ? $user_details->code : 'NA'}}</p>
                </div>

                <div class="form-group">
                    {!! Form::label('discounted_amount', 'Discounted amount:') !!}
                    <p>{{ $order_details->discounted_amount ? $order_details->discounted_amount : 'NA'}}</p>
                </div>

                <div class="form-group">
                    {!! Form::label('amount', ' Amount paid:') !!}
                    <p>{{ $order_details->amount ? $order_details->amount : 'NA' }}</p>
                </div>

                <div class="form-group">
                    {!! Form::label('address', 'Address:') !!}
                    <p>{{ @$order_details->user_address->address ? $order_details->user_address->address : 'NA' }}</p>
                </div>

                <div class="form-group">
                    {!! Form::label('state', 'State:') !!}
                    <p>{{ @$user_details->name ? $user_details->name : 'NA' }}</p>
                </div>

                <div class="form-group">
                    {!! Form::label('city', ' City:') !!}
                    <p>{{ @$order_details->user_address->city ? $order_details->user_address->city : 'NA' }}</p>
                </div>

                <a href="{{ route('order.index') }}" class="btn btn-default">Back</a>
                <a target="_blank" href="{{ env('NBF_API_URL') }}/uploads/invoices/{{ $id }}.pdf"
                    class='btn btn-default btn-xs'>
                    <i class="fa fa-download fa-2x" style="height: 30px" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection