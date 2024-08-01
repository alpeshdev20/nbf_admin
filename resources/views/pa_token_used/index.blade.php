@extends('layouts.app')
<style>
.table.dataTable{
    font-size: 14px !important;
}
.dt-buttons.btn-group{
    width: 100%;
    margin-bottom: 10px;
}

#dataTableBuilder_length{
    float: left;
    clear: both;
}
</style>
@section('content')
    <section class="content-header">
        <h1 class="pull-left">PA Token uses</h1>
        <h1 class="pull-right">
        
           &nbsp;&nbsp;<br>
		   <!--
            <div class="clearfix"></div>
            <div class="row" style="display:flex">
                <div style="padding-right:10px">
                    <a class="btn btn-primary btn-block" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('prescribedReadingLists.create') }}">Download CSV File</a>
                </div>
                <div>
                    <a class="btn btn-danger  btn-block pull-right show_upload_div" style="margin-top: -10px;margin-bottom: 5px" href="javascript:;">Bulk Upload</a>
                </div>
            </div>
			-->
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('pa_token_used.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection