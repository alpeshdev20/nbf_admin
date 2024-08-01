@extends('layouts.app')
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<style>
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }
    
    .switch input { 
      opacity: 0;
      width: 0;
      height: 0;
    }
    
    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }
    
    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }
    
    input:checked + .slider {
      background-color: #2196F3;
    }
    
    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }
    
    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }
    
    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }
    
    .slider.round:before {
      border-radius: 50%;
    }
	.pagination{
		float:right;
		padding-right:50px;
	}
    </style>
@section('content')
    <section class="content-header">
       <div class="row">
			<div class="col-md-8">
				<h3>
					Edit Form
				</h3>
			</div>

		  <form action="">
			<div class="col-md-4" style="margin-top:25px;">
				<input type="search" name="search"  placeholder="Search token..." style="padding:4px;" value="{{$search}}">
				<button class="btn btn-primary btn-sm">Search</button>
			</div>
		  </form>
		</div>
    </section>
	
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left:40px;">
					
                    <table class="table" id="member_table" >
                        <thead>
                          <tr>
                            <th scope="col">S.no</th>
                            <th scope="col">School</th>
                            <th scope="col">token</th>
                            <th scope="col">Status</th>
                            <th scope="col">Control</th>
							
                          </tr>
                        </thead>
                        <tbody>
                         
                          @foreach($edittoken as $edittok)
							<?php 
                                $school_data = \DB::table('schools')->where('id',$edittok->school_id)->first();
								//dd($school_data);
                            ?>
                         <tr>
                            <th scope="row">{{$edittok->id}}</th>
							<td>{{!empty($school_data) ? $school_data->name : 'N/A'}}</td>
                            <td>{{$edittok->token}}</td>
                           <td> <?php
						   
							if($edittok->status==1)
                            {
                              echo '<span class="btn btn-success btn-sm" style="padding-left:9px;margin-left: 8px;">Active</span>';
                            }elseif ($edittok->status==0){
                                echo '<span class="btn btn-danger btn-sm">Deactive</span>';
                            }elseif($edittok->status==2){
								echo '<span class="btn btn-info btn-sm">Used</span>';
							}
							
							?></td> 
                            <td>
								<?php if($edittok->status!=2){ ?>
								<label class="switch">
									<input type="checkbox" onchange="update_published(this,{{ $edittok->id }})" data-school_id="{{ $edittok->id }}" value="{{ $edittok->id }}"<?php if($edittok->status==1) echo "checked";?>>
									<span class="slider round"></span>
								</label>
								<?php } ?>
							</td>
                            
                         </tr>
                       @endforeach
                        </tbody>
                      </table>
					  <!----Pagination--->
					<div class="d-flex justify-content-center">
							{{$edittoken->links()}}
					</div>
					<!----Pagination--->
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
   function update_published(el,school_id){
    //alert("okk");
    if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
               
            }
            //var school_id = $(this).attr('data-school_id');
           // alert(s_id);
            $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{route("changetoken")}}',
            data: {status: status,school_id:school_id},
            success: function(data){
              console.log(data.success)
               if(data==1){
                confirm('Are you sure you want to Update successfully');
              }else{
                confirm('Something Went wrong.');
              }
              location.reload();  
            }
        });
           
        }
</script>