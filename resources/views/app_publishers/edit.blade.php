@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            App Publisher
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($appPublisher, ['route' => ['appPublishers.update', $appPublisher->id], 'method' => 'patch']) !!}

                        @include('app_publishers.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection