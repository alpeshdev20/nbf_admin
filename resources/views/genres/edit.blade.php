@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Genre
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($genre, ['route' => ['genres.update', $genre->id], 'method' => 'patch']) !!}

                        @include('genres.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection