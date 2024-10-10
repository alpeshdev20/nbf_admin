<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal{{$data[0]['id'] }}users"> {{ count($data)}} </a> 

<!-- Modal -->
<div class="modal fade" id="myModal{{$data[0]['id'] }}users" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content payment-modal-bg">
    <div class="modal-header modal-payment">
    <div class="item w-20">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
 </div>
 <div class="item w-80">
        <h4 class="modal-title">{{__('User Details') }}</h4>
</div>
      </div>
      
      <div class="modal-body">        

        <!--list of users information starts-->
            <div class="form-group">
                    <?php $sn=0;$total=0; $totalOverall=0;?>
                    {!! Form::label('user_analytics', 'User Analytics:') !!}
                    <table class="table table-striped table-dark index-table mt-4">
                        <tr>
                            <th>#</th>
                            <th>New/Existing User (N/E)</th>
                            <th>Location</th>
                            <th>Trial/Paid (T/P)</th>
                            <th>Total Time spent on NBF (Min)</th>
                            <th>Time spent on Your Asset (Min)</th>
                
                        </tr>
                        @if($data_count>0)
                        @foreach ($data as $key => $det)
                        
                            <?php
                            // dd($det);
                            // dd($data);
                            $u_type=empty($det['user']['subscriber'])?'E':'N';
                            
                            // $s_type=empty($data->subscriber->subscription)?'Not Subscribed':($data->subscriber->subscription->price==1)?'Free':'Paid';
                            $total_time_span=0;
                            // foreach($data as $rec){
                                $total_time_span+=$det['read_time'];
                            // }
                            $total=$total+$total_time_span;
                            if(isset($input['from_date']) &&
                            isset($input['to_date'])){
                            $overall_read_time = App\Models\app_book_analytic::where('user_id',$det['user_id'])->whereDate('created_at','>', $input['from_date'])->whereDate('created_at','<', $input['to_date'])->sum('read_time');

                            }
                            else{
                            $overall_read_time = App\Models\app_book_analytic::where('user_id',$det['user_id'])->sum('read_time');

                            }
                            $totalOverall+=$overall_read_time;
                            // $book_count=count($data);
                            ?>
                            <tr id="status_row">                    
                                <td id="sn"><p>{{ ++$sn }}</p></td>
                                <td id="user_type">
                                    <p>
                                        @if (empty($data->subscriber))
                                            <!-- Link for Existing User -->
                                        <a href="#" data-id="{{ $det->id }}" class="btn user-modal-trigger-1" data-toggle="modal" data-target="#userModal{{ $det->id }}">
                                                {{ __('E') }}
                                            </a>
                                        @else
                                            <!-- Link for New User -->
                                            <a href="#" data-id="{{ $det->id }}" class="btn user-modal-trigger-1"data-toggle="modal" data-target="#userModal{{ $det->id }}">
                                                {{ __('N') }}
                                            </a>
                                        @endif
                                    </p>
                                </td>
                                <td id="location"><p>@if (empty($det['location']))
                                {{__('----')}}
                                @else
                                {{$det['location']}}
                                @endif
                                </p></td>
                                <td id="subscription_type">
                                    <p>
                                        @if (empty($data->subscriber))
                                            {{ __('NA') }}
                                        @elseif (!empty($data->subscriber->plan_name) && $data->subscriber->plan_name === 'FREE')
                                            {{ __('Trial') }}
                                        @elseif ((!empty($data->subscriber->plan_name) && $data->subscriber->plan_name != 'FREE'))
                                                {{ __('Paid') }}
                                        @else
                                            {{ __('NA') }} <!-- Optional: For cases where subscription price is not available -->
                                        @endif
                                    </p>
                                   </td>
                                <td id="total_time_spent"><p>{{floor($overall_read_time/60)}}</p></td>
                                <td id="time_spent_per_book"><p>{{floor($total_time_span/60)}}</p></td>
                    
                            </tr>
                            @endphp 
                            <div class="modal fade" id="userModal{{ $rec->id }}" tabindex="-1" role="dialog" aria-labelledby="userModalLabel{{ $rec->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="userModalLabel{{ $rec->id }}">User Details</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>User Name: {{ $rec->name }}</p>
                                            <p>User Email: {{ $rec->email }}</p>
                                            <p>User Mobile: {{ $rec->mobile }}</p>
                                            <p>Plan Name: {{ $rec->subscriber->plan_name ?? 'Not Available' }}</p>
                                            <p>User Gender: {{ $rec->gender }}</p>
                                            <p>User Personal Address: {{ $rec->personal_address }}</p>
                                            <p>User Institute Address: {{ $rec->institute_address }}</p>
                                            
                                             <!-- Add more user-specific details here -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                            <tr id="status_row">
                                    <td id="sn"></td>
                                    <td id="sn"></td>
                            <td id="sn"><b>{{__('TOTAL:')}}</b></td>
                            <td id="sn"></td>
                            <td id="sn"><b>{{floor($totalOverall/60)}}</b></td>
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
        <!--list of users information end-->
      <div class="modal-footer1">
        <button type="button" class="btn custom-btn" data-dismiss="modal">Close</button>
      </div>
    </div>
    
  </div>
</div>
<script type="text/javascript">
    $(document).ready( function () {
      $("#example1").DataTable({
          //  dom: '<"html5buttons">BlTfgitp',
           
           buttons: [
          
              { extend: 'copy',"charset": "utf-8", text: "{{__('copy')}}" },
              { extend: 'excel',"charset": "utf-8", text: "{{__('excel')}}" },
              { extend: 'csv',"charset": "utf-8", text: "{{__('csv')}}" },
              @if(app()->getLocale() =='ar')
              {extend: 'pdf',"charset": "utf-8", text: "{{__('pdf')}}",exportOptions: {columns: ':visible'},                    
              customize: function (doc) {        
              doc.defaultStyle.font = 'Arab';}},
              @else
              { extend: 'pdf',"charset": "utf-8", text: "{{__('pdf')}}" },
              @endif
              { extend: 'print',"charset": "utf-8", text: "{{__('print')}}" }
          
      ],
    
       "pagingType": "full_numbers",
          "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
          ],
          responsive: true,
          "order": [], //Initial no order.
           "aaSorting": [],
      });
  
      var table = $('.yajra-datatable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('home.dashTableRecord') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'subscriber', name: 'utype',render: function ( data, type, row, meta ) {
              return (!data) ? "E" :"N";
              }},
              {render: function ( data, type, row, meta ) {
              return "---";
              }},
              {data: 'subscriber', name: 'stype',render: function ( data, type, row, meta ) {
                  var stype;
                  if(!data){
                      stype="NA" 
                  }
                  else if(data!='' && data.subscription.price >= 199){
                      stype="P" 
                  }
                  else{
                      stype="T"
                  }
              return stype;
              }},
              {data: 'subscriber', name: 'utype',render: function ( data, type, row, meta ) {
              return (!data) ? "E" :"N";
              }},
              {data: 'subscriber', name: 'utype',render: function ( data, type, row, meta ) {
              return (!data) ? "E" :"N";
              }},
              {data: 'subscriber', name: 'utype',render: function ( data, type, row, meta ) {
              return (!data) ? "E" :"N";
              }},
              {
                  data: 'action', 
                  name: 'action', 
                  orderable: true, 
                  searchable: true
              },
          ]
      });
  
      //show user
      $('.user-modal-trigger').on('click', function() {
          var userId = $(this).data('id');
                  
          // Show the modal
          $('#userModal' + userId).modal('show');
      });
  
  
      
    });
  </script>