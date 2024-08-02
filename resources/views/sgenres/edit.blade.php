@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Sgenre
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($sgenre, ['route' => ['sgenres.update', $sgenre->id], 'method' => 'patch']) !!}

                        @include('sgenres.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection