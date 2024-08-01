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
                                <td id="user_type"><p>
                                @if (empty($det['user']['subscriber']))
                                {{__('E')}}
                                @endif
                                @if (!empty($det['user']['subscriber']))
                                {{__('N')}}
                                @endif</p></td>
                                <td id="location"><p>@if (empty($det['location']))
                                {{__('----')}}
                                @else
                                {{$det['location']}}
                                @endif
                                </p></td>
                                <td id="subscription_type"><p>
                                @if (!empty($det['user']['subscriber']))
                                    {{__('NA')}}
                                @endif
                                @if (!empty($det['user']['subscriber']) && $det['user']['subscriber']['subscription']['price'] >= 199)
                                    {{__('P')}}
                                @endif
                                @if (!empty($det['user']['subscriber']) && $det['user']['subscriber']['subscription']['price'] < 199)
                                    {{__('T')}}
                                @endif</p></td>
                                <td id="total_time_spent"><p>{{floor($overall_read_time/60)}}</p></td>
                                <td id="time_spent_per_book"><p>{{floor($total_time_span/60)}}</p></td>
                    
                            </tr>
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
