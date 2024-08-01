@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Material Upload
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($materialUpload, ['route' => ['materialUploads.update', $materialUpload->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('material_uploads.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection