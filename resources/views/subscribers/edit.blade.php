@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            User subscription - {{ $subscriber->user->name }}
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($subscriber, ['route' => ['subscribers.update', $subscriber->id], 'method' => 'patch']) !!}

                        @include('subscribers.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection