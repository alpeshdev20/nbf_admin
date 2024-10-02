@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Resources For Ai Integration</h1>
		<div class="clearfix"></div>
        <h1 class="pull-right">
        </h1>
		<div class="clearfix"></div>
			<!--added/modified 26/1/2022. rahul-->
			<style>
                .btn-ai-integration {
                    margin-left: 10px !important;
                }
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
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
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
	
      
        // Handle click event for the select all checkbox
        $('#select-all').click(function() {
            var checked = $(this).is(':checked');
            $('.row-select').prop('checked', checked);
        });

        // Handle individual checkbox click
        $(document).on('click', '.row-select', function() {
            if ($('.row-select:checked').length == $('.row-select').length) {
                $('#select-all').prop('checked', true);
            } else {
                $('#select-all').prop('checked', false);
            }
        });
        
        function toggleAIIntegration() {
        let selectedIds = [];
        
        // Collect selected IDs
        $('.row-select:checked').each(function() {
            selectedIds.push($(this).val());
        });

        // Check if any records are selected
        if (selectedIds.length === 0) {
            alert("Please select at least one record.");
            return;
        }

        var token = '{{ csrf_token() }}';

        // Perform AJAX request
        $.ajax({
            url: "{{ route('update-ai-integration') }}", // Ensure this route is defined in your Laravel routes
            method: 'POST',
            data: {
                ids: selectedIds,
                _token: token // Ensure this meta tag is included in your HTML
            },
            success: function(response) {
                // Handle success
                // Optionally display a success message
                alert('AI integration toggled successfully!');
                // Reload the DataTable
                $('.table-striped').DataTable().ajax.reload();
            },
            error: function(xhr) {
                // Handle error
                console.error(xhr);
                alert('An error occurred while toggling AI integration.');
            }
        });
       }		
    </script>
@endsection

