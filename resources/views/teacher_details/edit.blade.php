@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Teacher Detail
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($teacherDetail, ['route' => ['teacherDetails.update', $teacherDetail->id], 'method' => 'patch']) !!}

                        @include('teacher_details.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection