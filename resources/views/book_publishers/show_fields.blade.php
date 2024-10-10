<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $bookPublisher->id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $bookPublisher->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $bookPublisher->updated_at }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $bookPublisher->user_id }}</p>
</div>

<!-- Publisher Field -->
<div class="form-group">
    {!! Form::label('publisher', 'Publisher:') !!}
    <p>{{ $bookPublisher->publisher }}</p>
</div>

<?php $sn=0;$totalOverall=0; ?>
<div class="form-group">
    {!! Form::model($bookPublisher, ['route' => ['bookPublishers.show', $bookPublisher->id], 'method' => 'GET']) !!}

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
    {!! Form::label('Book_list', 'Book Statistics:') !!}
    <div class="box box-primary">
    <div class="box-body">
    @section('css')
    @include('layouts.datatables_css')
    @endsection
    <table id="bookstats" class="table table-striped table-bordered">
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
            
            <td id="total_read_time"><p>{{ floor($total_read/60)}}</p></td>
            <td id="user_count"><p>@include('Box.usersinfo') {{ $usercount }}</p></td>

        </tr>
        @endforeach
        <tr id="status_row">
        <td id="sn"></td>
        <td id="sn"><b>{{__('TOTAL:')}}</b></td>
        <td id="sn"><b>{{floor($totalOverall/60)}}</b></td>
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
   </div>
</div>
</div>
<!-- Active Field -->
<div class="form-group">
    {!! Form::label('active', 'Active:') !!}
    <p>{{ $bookPublisher->active }}</p>
</div>
@section('scripts')
    <script src="{{ asset('material/assets/js/plugins/jquery.dataTables.min.js') }}"></script>
@endsection


<script type="text/javascript">
  $(function () {
    $("#bookstats").DataTable({
         dom: '<"html5buttons">BlTfgitp',
         
         buttons: [
        
            { extend: 'copy',"charset": "utf-8", text: "{{__('copy')}}" },
            { extend: 'excel',"charset": "utf-8", text: "{{__('excel')}}" },
            { extend: 'csv',"charset": "utf-8", text: "{{__('csv')}}" },
            { extend: 'pdf',
                customize: function ( doc ) {
                    doc.content.splice( 1, 0, {
                        margin: [ 0, 0, 0, 12 ],
                        alignment: 'center',
                        image: 'data:image/png;base64,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'
                    } );
                }
                ,
                "charset": "utf-8",
                 text: "{{__('pdf')}}" },
            
        
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
    });

</script>
