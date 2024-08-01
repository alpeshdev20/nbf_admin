@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            App Material
        </h1>
    </section>
    <div class="content">
	 @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::model($appMaterial, ['route' => 'appMaterials.store', 'files' => true, 'id'=>'add_app_mat_form']) !!}

                        @include('app_materials.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    @include('app_materials.ajaxreq')
@endsection
