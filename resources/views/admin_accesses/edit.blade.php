@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Admin Access
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($adminAccess, ['route' => ['adminAccesses.update', $adminAccess->id], 'method' => 'patch']) !!}

                        @include('admin_accesses.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection