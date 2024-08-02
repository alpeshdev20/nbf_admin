@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
        Regions
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($region_data, ['route' => ['region.update', $region_data->id], 'method' => 'patch']) !!}

                        @include('regions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection