@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">App Materials</h1>
		<div class="clearfix"></div>
        <h1 class="pull-right">
            <div style="display:flex">
				<!--<button class="btn btn-primary btn-block" style="margin-top: -10px;margin-bottom: 5px" id="downloadCsv">Download CSV Template</button> -->
				 <a class="btn btn-primary" style="" 
											href="{{ route('appMaterials.create') }}">Add New</a>
				<a class="btn btn-primary" style="" 
							id="downloadCsv1" href="{{url('/csv/book')}}" target="_blank">Download Template</a>
				<a class="btn btn-danger show_upload_div" style="" href="javascript:;">Bulk Upload</a>
            </div>
        </h1>
		<div class="clearfix"></div>
			<!--added/modified 26/1/2022. rahul-->
			<style>
				.bulk-upload-wrapper{
					width: 100%;
					max-width: 500px;
					position: relative;
				}
				.upload-parent {
					display: table;
					width: 100%;
					position: relative;
				}
				.upload-parent>*{
					display:table-cell;
				}
				.upload-parent .ctrl-grp {
					position: relative;
					top: 0;
					line-height:30px;
				}
						
				.upload-parent .progress {
					position: absolute;
					display:block;
					width: 100%;
					top: 0;
					height: 100%;
					background-color:#3e94ff;
					color:white;
				}
						
				.upload-parent .file-input {
					background-color:white;
					width:100%;
				}
				
				#progressbar {
					position: absolute;
					display: block;
					width: 100%;
					height: 100%;
					background-color: #858585;
					top: 0;
					left: 0;
				}
				
				#progresstxt {
					display: block;
					position: absolute;
					width: 100%;
					text-align: center;
				}
				
				#downloadsample {
					position: relative;
					display: block;/*move to new line*/
					margin: 5px 0 0 0;
					text-align:left;
					cursor:pointer;
				}
				#downloadsample:hover{
					text-decoration:underline;
				}
				.alert-danger{
					max-height:150px;
					overflow:auto;
					border:none;
				}
			</style>
		
			<div class="bulk-upload-wrapper Upload_div" style="display:none;">
				<div class="upload-parent">
					<div style="border:1px solid #d1d1d1; ">
					<div class="ctrl-grp" style="display:flex">
						<label style="width:70px;margin:0;padding-left:5px;">Zip file:</label>
						<input type="file" accept="application/zip" class="file-input" id="upload_zip_file">
						<div id="progressBar1" class="progress" style="display:none;">
						<div id="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" 
								style="left:0%;">
						</div>
						<span id="progresstxt"><span>
						</div>
					</div>
					</div>
					<button type="button" class="btn btn-primary btn-sm" id="uploadbtn" onclick="uploadFile()" >Upload</button>
					<!--button type="button" style="display:none;" >Download File</button-->
					
				</div>
				<span id="downloadsample">Download sample file.</span>
			</div>
		<!--added/modfied 26/1/2022. rahul ends-->
    </section>
	
	
	

	
	
	
    <div class="content">
        <div class="clearfix"></div>
	
        

        @include('flash::message')
		
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
        </div>
            @include('app_materials.table')
        </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
	<script type="text/javascript">
	
	
		//let pBar =$('.progress .progress-bar');
	
	
        $(document).on('click','.show_upload_div', function(){
            $('.Upload_div').toggle();
        });
        
        $(document).on('click','#downloadsample', function(){
            $.ajax({
                url: "{{url('/csv/material')}}",
                method: 'GET',
                responseType: 'blob'
            })
            .done(function(data) {
                const url = window.URL.createObjectURL(new Blob([data]));
				const link = document.createElement('a');
				link.href = url;
				link.setAttribute('download', 'material.csv');
				document.body.appendChild(link);
				link.click();
				link.remove();
            });
        });
		

		/*added 26/1/2022. rahul*/
		// makeshift. may use jquery later.
		const pbarp = document.getElementById("progressBar1");
		const pbar = document.getElementById("progressbar");
		const psts = document.getElementById("progresstxt");
		
		function uploadFile(){
			
			let fib = document.getElementById('upload_zip_file')
			let xhr = new XMLHttpRequest();
			
			
			xhr.upload.addEventListener('progress', function(evt){
				let per = evt.loaded/evt.total*100
				psts.innerHTML = Math.round(per)+'%'
				pbar.style['left'] = per+'%';
			});
			xhr.addEventListener('loadend',function(){
				// op finised. reload the page for Flash::*, as intended by the prev. developer.
				setTimeout(function(){$('#progressBar1').hide();window.location.reload(true);},500);
			});
			xhr.addEventListener('readystatechange',function(){
				if(xhr.readyState==3){
					let curr = xhr.responseText.split("|")
					curr = curr[curr.length-2];
					psts.innerHTML = curr || 'Error!';
				}else if(xhr.readyState==4){
					if(xhr.status>=200 && xhr.status<=230){
						pbarp.style['background-color']= '#4caf50';
						//let msg = JSON.parse(xhr.responseText).message;
					}else{
						pbarp.style['background-color']= '#f44336';
						//console.log(msg);
					}
				}
			});
			
			pbarp.style['background-color']= '#3e94ff';
			if(fib.files.length<1){
				alert('Please select a zip file to upload.')
				return;
			}
			
			let file = fib.files[0];
			let fd = new FormData();
			fd.append('file',file);
			xhr.open("POST", "{{ url('material-upload') }}", true);
			xhr.setRequestHeader('X-CSRF-TOKEN'  , '{{ csrf_token() }}');
			xhr.send(fd);
			psts.innerHTML = "";
			$('#progressBar1').show()
		}
		/*added 26/1/2022. rahul ends*/
		
		
		
    </script>
@endsection

