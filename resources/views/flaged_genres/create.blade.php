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
                    {!! Form::open(['route' => 'flagedGenres.store']) !!}

                        @include('flaged_genres.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
