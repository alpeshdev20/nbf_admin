<!-- Id Field -->


@php $count = 0; @endphp
<div class="col-sm-12">

<table class="table table-striped table-bordered dataTable no-footer">
	<thead>
		<tr role="row">
		<th title="Serial Number" style="width: 60px;">S No.</th>
		<th title="Owner" class="sorting_disabled" >Name</th>
		</tr>
	</thead>
	
	<tbody id="pbooklist">
	
		@foreach($readList->items as $item)
		
			<tr role="row" class="{!! ($count%2==0)?'odd':'even'  !!}">
				<td align="center">{{ $count +1 }}</td>
				<td>{{ $item->material->book_name }}</td>						
			</tr>
			@php $count++; @endphp

		@endforeach
	
	
	
	</tbody>
</table>
</div>