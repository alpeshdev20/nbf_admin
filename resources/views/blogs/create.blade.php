@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Create Blog
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {{-- {!! Form::open(['route' => 'blogs.store']) !!} --}}

                    {!! Form::model($blog, [
                        'route' => $blog->exists ? ['blogs.update', $blog->id] : 'blogs.store',
                        'method' => $blog->exists ? 'PUT' : 'POST',
                        'id' => 'add_app_mat_form',
                        'enctype' => 'multipart/form-data'
                    ]) !!}

                        @include('blogs.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
