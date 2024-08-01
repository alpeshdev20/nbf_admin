@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Coupon code
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($coupon_codes, ['route' => ['coupon_codes.update', $coupon_codes->id], 'method' => 'patch']) !!}

                        @include('coupon_codes.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection