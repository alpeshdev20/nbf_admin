@extends('layouts.app')

@section('content')
	@include('layouts.datatables_css')
    <section class="content-header">
        <h1>
            Add new reading list
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'prescribedReadingLists.store', 'files' => false]) !!}

                        @include('prescribed_reading_lists.fields')

                    {!! Form::close() !!}
                </div>
				
				<!-- book list section -->
				
			<style>
				.booklist {
					width: 100%;
					max-height: 550px;
					overflow: hidden auto;
				}
				.dataTable tbody{
					min-height:500px;
				}
			</style>				
			<div class="booklist">
				<table class="table table-striped table-bordered dataTable no-footer" id="data_list">
					<thead>
						<tr role="row">
						<th title="Id" style="width: 30px;"></th>
						<th title="Owner">Name</th>
						<th title="Action" width="120px" class="sorting_disabled" rowspan="1" colspan="1" aria-label="Action" style="width: 100px;">Year</th>
						</tr>
					</thead>
					
					<tbody id="pbooklist">
						<!--
						<tr role="row" class="odd">
							<td align="center"><input type="checkbox" class="selectItem" value="23"></td>
							<td>Full Marks Private Limited</td>
							<td>1</td>
						</tr>
						<tr role="row" class="even">
							<td><input type="checkbox" class="selectItem" value="23"></td>
							<td>Full Marks Private Limited</td>
							<td>1</td>
						</tr>
						-->
					</tbody>
					
					
				</table>
			</div>
				
				
				
            </div>
			
						
			
        </div>
		
    </div>
	@include('prescribed_reading_lists.add_item_action')

	@section('scripts')
    	@include('layouts.datatables_js')
	@endsection
	
@endsection
