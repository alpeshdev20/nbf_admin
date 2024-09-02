@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="warning-msg" style="text-align: center;">
        <i class="fa fa-warning" style="background: rgb(228, 103, 103); color: black; padding: 5px;font-size:30px;margin-bottom:20px">
          Book statistics are under development, will be showing correct data soon
        </i>
      </div>
      
    <div class="row">
        {!! Form::open(["route" => "/home",'method'=>'GET', "id" => "dashboardForm"]) !!}
        <!-- Start Date Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('from_date', 'From Date:') !!}
            {{ Form::input('date','from_date', isset($input['from_date'])?$input['from_date']:\Carbon\Carbon::now()->format('Y-m-d'), array('class' => 'form-control', 'placeholder' => 'Start Date')) }}
        
        </div>

        <!-- End Date Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('to_date', 'To Date:') !!}
            {{ Form::input('date','to_date', isset($input['to_date'])?$input['to_date']:\Carbon\Carbon::now()->addYear(1)->format('Y-m-d'), array('class' => 'form-control', 'placeholder' => 'End Date')) }}
        
        </div>

        <!-- Submit Field -->
        <div class="form-group col-sm-12">
            {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
            
        </div>
        {!! Form::close() !!}
        @if(isset(Auth::user()->access->access_role) && Auth::user()->access->access_role == 1)
        <div class="content form-group">
            <?php $sn=0;$total=0; $totalOverall=0;?>
            {!! Form::label('user_analytics', 'User Analytics:') !!}
            <table id="example1" class="table table-striped table-dark index-table mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>New/Existing User (N/E)</th>
                    <th>Location</th>
                    <th>Trial/Paid (T/P)</th>
                    <th>Total Time spent on NBF (Min)</th>
                    <th>Time spent on Your Asset (Min)</th>
                    <th>Books Viewed (Count)</th>
        
                </tr>
            </thead>
            <tbody>
                @if($data_count>0)
                @foreach ($user_statistic_det as $key => $data)
                @if (count($data->analytics) == 0)
                @continue
                @endif
                    <?php
                    // dd($books);
                    // dd($data);
                    $u_type=empty($data->subscriber)?'E':'N';
                    
                    // $s_type=empty($data->subscriber->subscription)?'Not Subscribed':($data->subscriber->subscription->price==1)?'Free':'Paid';
                    $total_time_span=0;
                    foreach($data->analytics as $rec){
                        $total_time_span+=$rec->read_time;
                    }
                    $total=$total+$total_time_span;
                    if(isset($input['from_date']) &&
                    isset($input['to_date'])){
                    $overall_read_time = App\Models\app_book_analytic::where('user_id',$data->id)->whereDate('created_at','>', $input['from_date'])->whereDate('created_at','<', $input['to_date'])->sum('read_time');

                    }
                    else{
                    $overall_read_time = App\Models\app_book_analytic::where('user_id',$data->id)->sum('read_time');

                    }
                    $totalOverall+=$overall_read_time;
                    $book_count=count($data->analytics);
                    ?>
                    <tr id="status_row">                    
                        <td id="sn"><p>{{ ++$sn }}</p></td>
                        <td id="user_type"><p>
                        @if (empty($data->subscriber))
                        {{__('E')}}
                        @endif
                        @if (!empty($data->subscriber))
                        {{__('N')}}
                        @endif</p></td>
                        <td id="location"><p>@if ($data->analytics[0]->location)
                                {{$data->analytics[0]->location}}
                                @else
                                {{__('----')}}
                                @endif</p></td>
                        <td id="subscription_type"><p>@if (empty($data->subscriber))
                        {{__('NA')}}
                        @endif
                        @if (!empty($data->subscriber) && !empty($data->subscriber->subscription->price) && $data->subscriber->subscription->price >= 199)
                        {{__('P')}}
                        @endif
                        @if (!empty($data->subscriber) && !empty($data->subscriber->subscription->price) && $data->subscriber->subscription->price < 199)
                        {{__('T')}}
                        @endif</p></td>
                        
                        <?php
                            $overall_read_time_s = $overall_read_time / 1000; // Convert milliseconds to seconds
                            $minutes = floor($overall_read_time_s / 60); // Get minutes
                            $seconds = floor($overall_read_time_s % 60); // Get remaining seconds
                            ?>
                      <td id="total_time_spent">
                        <p>{{ $minutes }} minutes and {{ $seconds }} seconds</p>
                      </td>

                        <?php
                            $total_time_span_s = $total_time_span / 1000; // Convert milliseconds to seconds
                            $minutes = floor($total_time_span_s / 60); // Get minutes
                            $seconds = floor($total_time_span_s % 60); // Get remaining seconds
                        ?>
                       <td id="time_spent_per_book">
                         <p><?php echo "{$minutes} minutes and {$seconds} seconds"; ?></p>
                       </td>                      
                        <td id="booksviewd"><p>@include('Box.booksinfo'){{ $book_count }}</p></td>
            
                    </tr>
                @endforeach
                    <tr id="status_row">
                            <td id="sn"></td>
                            <td id="sn"></td>
                    <td id="sn"><b>{{__('TOTAL:')}}</b></td>
                    <td id="sn"></td>
                    <?php
                        $totalOverall_s = $totalOverall / 1000; // Convert milliseconds to seconds
                        $minutes = floor($totalOverall_s / 60); // Get minutes
                        $seconds = floor($totalOverall_s % 60); // Get remaining seconds
                    ?>
                    <td id="sn">
                         <b><?php echo "{$minutes} minutes and {$seconds} seconds"; ?></b>
                    </td>
                    
                    <?php
                        $total_s = $total / 1000; // Convert milliseconds to seconds
                        $minutes = floor($total_s / 60); // Calculate minutes
                        $seconds = floor($total_s % 60); // Calculate remaining seconds
                    ?>
                    <td id="sn">
                        <b><?php echo "{$minutes} minutes and {$seconds} seconds"; ?></b>
                    </td>
                    <td id="sn"></td>
                    </tr>
                @else
                    <tr id="status_row">
                        <td id="sn">{{__('no records available !!')}}</td>
                    </tr>
                @endif
                </tbody>
                  <tfoot>
                  
                  </tfoot>
            </table>  
        </div>
        @else
        <?php $sn=0;$total=0; $totalOverall=0;?>
        {!! Form::label('Book_list', 'Book Statistics:') !!}
        <table id="example1" class="table table-striped table-dark index-table mt-4">
        <thead>
            <tr>
                <th>#</th>
                <th>Book name</th>
                <th>Total Read Time (Min)</th>
                <th>Users (Count)</th>

            </tr>
            </thead>
            <tbody>
            @if($data_count>0)
            @foreach ($user_statistic_det as $key => $data)
            <?php 
            $total_read=0;
            foreach($data as $key => $rec){
                $total_read+=$rec['read_time'];
            }
            $totalOverall+=$total_read;
            $bookname=$data[0]['book']['book_name'];
            $usercount=count($data);
            // dd($user_statistic_det)
            ?>
            
            <tr id="status_row">                    
                <td id="sn"><p>{{ ++$sn }}</p></td>
                <td id="book_name"><p>{{ $bookname }}</p></td>
                <?php
                    $total_read_s = $total_read / 1000; // Convert milliseconds to seconds
                    $minutes = floor($total_read_s / 60); // Calculate minutes
                    $seconds = floor($total_read_s % 60); // Calculate remaining seconds
                ?>
                <td id="total_read_time">
                    <p><?php echo "{$minutes} minutes and {$seconds} seconds"; ?></p>
                </td>
                <td id="user_count"><p>@include('Box.usersinfo'){{ $usercount }}</p></td>

            </tr>
            @endforeach
            <tr id="status_row">
            <td id="sn"></td>
            <td id="sn"><b>{{__('TOTAL:')}}</b></td>
                @php
                    $totalOverall_s = $totalOverall / 1000; // Convert milliseconds to seconds
                    $minutes = floor($totalOverall_s / 60); // Calculate minutes
                    $seconds = floor($totalOverall_s % 60); // Calculate remaining seconds
                @endphp
            <td id="sn">
                <b>{{ $minutes }} minutes and {{ $seconds }} seconds</b>
            </td>
            <td id="sn"></td>
            </tr>
            @else
            <tr id="status_row">
                <td id="book_name">{{__('no records available !!')}}</td>
            </tr>
            @endif
            </tbody>
                  <tfoot>
                  
                  </tfoot>
        </table>
        @endif

        <!-- <div class="form-group">
            {!! Form::label('user_analytics', 'User Analytics Datatable:') !!}
            <table class="table table-bordered yajra-datatable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>New/Existing User (N/E)</th>
                    <th>Location</th>
                    <th>Trial/Paid (T/P)</th>
                    <th>Total Time spent on NBF (Min)</th>
                    <th>Time spent on Your Asset (Min)</th>
                    <th>Books Viewed (Count)</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div> -->
    </div>
</div>
@section('scripts')
    @include('layouts.datatables_js')
@endsection

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
    
  });
</script>
@endsection

