@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            App Logos
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($appLogos, ['route' => ['appLogos.update', $appLogos->id], 'method' => 'patch','files' => true]) !!}

                        @include('app_logos.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection