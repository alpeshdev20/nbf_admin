@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Audio Book
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'audioBooks.store', 'files' => true]) !!}

                        @include('audio_books.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection