@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Cms Page
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($cmsPage, ['route' => ['cmsPages.update', $cmsPage->id], 'method' => 'patch']) !!}

                        @include('cms_pages.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection