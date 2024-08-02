@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Genre Highlight
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($genreHighlight, ['route' => ['genreHighlights.update', $genreHighlight->id], 'method' => 'patch']) !!}

                        @include('genre_highlights.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection