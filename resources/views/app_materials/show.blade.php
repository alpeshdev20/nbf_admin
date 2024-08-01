@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            App Material
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('app_materials.show_fields')
                    <a href="{{ route('appMaterials.index') }}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
