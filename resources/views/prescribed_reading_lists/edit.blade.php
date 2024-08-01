@extends('layouts.app')

@section('content')
	@include('layouts.datatables_css')
    <section class="content-header">
        <h1>
            Material Upload
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($prlist, ['route' => ['prescribedReadingLists.update', $prlist->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('prescribed_reading_lists.fields')

                   {!! Form::close() !!}
               </div>
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
			<!-- PA-Token list -->
			<?php if(sizeof($created_tokens)){ ?>
					<div class="tokenlist">
						<table class="table table-striped table-bordered dataTable no-footer" id="token_list">
							<thead>
								<tr role="row">
									<th class="col-sm-2" title="Id">Id</th>
									<th class="col-sm-8" title="Owner">Token</th>
								</tr>
							</thead>
							<tbody id="tokenlist">
								@foreach ($created_tokens as $token)
								<tr role="row">
									<td>{{$token->id}}</td>
									<td>{{$token->token}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<?php } ?>
			<!-- End PA-Token list -->
           </div>
       </div>
   </div>
   @include('prescribed_reading_lists.add_item_action')

	@section('scripts')
    	@include('layouts.datatables_js')
	@endsection
@endsection