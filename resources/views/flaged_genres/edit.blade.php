@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Flaged Genre
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($flagedGenre, ['route' => ['flagedGenres.update', $flagedGenre->id], 'method' => 'patch']) !!}

                        @include('flaged_genres.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection