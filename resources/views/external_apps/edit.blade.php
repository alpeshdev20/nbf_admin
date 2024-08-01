@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            External App
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($externalApp, ['route' => ['externalApps.update', $externalApp->id], 'method' => 'patch']) !!}

                        @include('external_apps.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection