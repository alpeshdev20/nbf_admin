@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            App Adv
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($appAdv, ['route' => ['appAdvs.update', $appAdv->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('app_advs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection