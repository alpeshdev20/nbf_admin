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
    </style>
@section('content')
    <section class="content-header">
        <h1>
            List Of data
        </h1>
    </section>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($message = Session::get('delete'))
        <div class="alert alert-danger">
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-md-12">
                    <button style="margin-left:900px;" class="btn btn-primary">
                                <a href="{{url('show')}}" class="btn btn-primary btn btn-sm" style="float: right">Add</a>
                    </button><hr>
                </div>
                <div class="row" style="padding-left:20px;">
                    <table class="table" id="member_table">
                        <thead>
                          <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">School</th>
                            <th scope="col">token</th>
                            <th scope="col">Status</th>
                            <th scope="col">Control</th>
							<th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                           @foreach($school as $sch)
                           <?php  $t = DB::table('registration_tokens')->where('school_id',$sch->id)->get(); 
                                  $tot = count($t); 
                                  
                           ?>
                          <tr>
                            <th scope="row">{{ $sch->id}}</th>
                            <td>{{ $sch->name}}</td>
                            <td>{{ $tot }}</td>
                            
                            <td>
                              <?php
                              $t = DB::table('registration_tokens')->where('school_id',$sch->id)->first();
                              //dd($t);
                              if($t!==null && $t->active==1)
                            {
                                echo '<span class="btn btn-success btn-sm" style="padding-left:9px;margin-left: 8px;">Active</span>';
                            }else {
                                echo '<span class="btn btn-danger btn-sm">Deactive</span>';
                            }?>
                            </td> 
                            <td>
                              <label class="switch">
                                <input type="checkbox" onchange="update_published(this,{{ $sch->id }})" data-school_id="{{ $sch->id }}" value="{{ $sch->id }}" <?php if($t!==null && $t->active==1) echo "checked";?>>
                                <span class="slider round"></span>
                              </label>
                            </td>
                             <td><a href="edit/status/{{$sch->id}}" title="Edit">Tokens</a></td>
                         </tr>
                       @endforeach
                        </tbody>
                      </table>
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
            url: '{{route("changeStatus")}}',
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