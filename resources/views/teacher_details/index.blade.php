@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Teacher Details</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary btn-block" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('teacherDetails.create') }}">Add New</a>
            &nbsp;&nbsp;<br>
            <div class="clearfix"></div>
            <div class="row" style="display:flex">
                <div style="padding-right:10px">
                    <a class="btn btn-primary btn-block" style="margin-top: -10px;margin-bottom: 5px" id="downloadCsv">Download CSV Template</a>
                </div>
                <div>
                    <a class="btn btn-danger  btn-block pull-right show_upload_div" style="margin-top: -10px;margin-bottom: 5px" href="javascript:;">Bulk Upload</a>
                </div>
            </div>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>
        <div class="row Upload_div" style="display:none;">
            <div class="col-md-4">
                <label>Upload File</label>
        <form action="{{url('teacherdetailuploads')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="file" name="file" class="form-control">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>

        </div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('teacher_details.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
	
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).on('click','.show_upload_div', function(){
            $('.Upload_div').show();
        })
        $(document).on('click','#downloadCsv', function(){
            $.ajax({
                url: "{{url('/csv/teacher')}}",
                method: 'GET',
                responseType: 'blob'
            })
            .done(function(data) {

                const url = window.URL.createObjectURL(new Blob([data]));
        const link = document.createElement('a');
        link.href = url;
        link.setAttribute('download', 'teacher.csv');
        document.body.appendChild(link);
        link.click();
        link.remove();
            });
        });
    </script>
@endsection

