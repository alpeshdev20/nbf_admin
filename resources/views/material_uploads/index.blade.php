@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Material Uploads</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('materialUploads.create') }}">Add New</a>
           &nbsp;&nbsp;<br>
            <div class="clearfix"></div>
            <div class="row" style="display:flex">
                <div style="padding-right:10px">
                    <a class="btn btn-primary btn-block" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('appMaterials.create') }}">Download CSV File</a>
                </div>
                <div>
                    <a class="btn btn-danger  btn-block pull-right show_upload_div" style="margin-top: -10px;margin-bottom: 5px" href="javascript:;">Bulk Upload</a>
                </div>
            </div>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('material_uploads.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

