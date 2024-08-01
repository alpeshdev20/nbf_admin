@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Access Role
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($accessRole, ['route' => ['accessRoles.update', $accessRole->id], 'method' => 'patch']) !!}

                        @include('access_roles.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection