    <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal{{$data->id }}books"> {{ count($data->analytics)}} </a> 

  <!-- Modal -->
  <div class="modal fade" id="myModal{{$data->id}}books" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content payment-modal-bg">
      <div class="modal-header modal-payment">
      <div class="item w-20">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
   </div>
   <div class="item w-80">
          <h4 class="modal-title">{{__('Book Details') }}</h4>
  </div>
        </div>
        
        <div class="modal-body">
          <div>
            <?php $snm=0;$total=0; ?>
            <table class="table table-striped table-dark index-table mt-4">
               <tr>
                   <th>#</th>
                   <th>Book Name</th>
                   <!-- <th>User Name</th> -->
                   <th>Read Time</th>
       
               </tr>
               @if(count($data->analytics)>0)
               @foreach ($data->analytics as $key => $rec)
                   <?php
                   //dd($rec);
                   $total+=$rec->read_time;
                   $user_info = App\Models\ULogin::find($rec->user_id);
                   $book_info = App\Models\app_material::where('id',$rec->book_id)->first();
                   ?>
                   
                   <tr id="status_row">                    
                       <td id="sn"><p>{{ ++$snm }}</p></td>
                       <td id="book_name"><p>{{ $book_info->book_name}}</p></td>
                       <!-- <td id="user_name"><p>{{$user_info->name}}</p></td> -->
                       <td id="read_time"><p> {{floor($rec->read_time/60)}} </p></td>
           
                   </tr>
               @endforeach
               <tr id="status_row">
                <td id="sn"></td>
                <td id="sn"><b>{{__('TOTAL:')}}</b></td>
                <td id="sn"><b>{{floor($total/60)}}</b></td>
                <td id="sn"></td>
              </tr>
               @else
                   <tr id="status_row">
                       <td id="sn">{{__('no records available !!')}}</td>
                   </tr>
               @endif
           </table>
         
 
          

          
        </div>
        <div class="modal-footer1">
          <button type="button" class="btn custom-btn" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
