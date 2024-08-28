<!-- Material Type Field -->
<?php if(isset(Auth::user()->access->access_role) && Auth::user()->access->access_role == 3) { ?>
<div class="form-group col-sm-6">
	{!! Form::hidden('material_type', 3) !!}
	{!! Form::label('material_type', 'Material Type:') !!}
	{!! Form::select('material_type', $material, 3, ['class' => 'form-control',  'disabled' => 'disabled']) !!}
</div>
<?php }
else { ?>
<div class="form-group col-sm-6">
    {!! Form::label('material_type', 'Material Type:') !!}
    {!! Form::select('material_type',$material, $material[4], ['class' => 'form-control']) !!}
</div>
<?php } ?>



<!-- Book Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('book_name', 'Title:') !!}
    {!! Form::text('book_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Book Image Field 'image/jpeg', 'image/jpg', 'image/png',-->
<div class="form-group col-sm-6">
    {!! Form::label('book_image', 'Cover Image:') !!}
    {!! Form::file('book_image',  null , ['class' => 'form-control']) !!}
</div>

<!-- Book Pdf Field -->
<div class="form-group col-sm-6">
    {!! Form::label('book_pdf', 'File:') !!}
    {!! Form::file('book_pdf', null, ['class' => 'form-control']) !!}
</div>

<!-- Add Button -->
<?php if(isset(Auth::user()->access->access_role) && Auth::user()->access->access_role != 3) { ?>
<div id="addbtndiv" class="form-group col-sm-12">
	<button id="addbtn" class="btn btn-primary">Add episode</button>
</div>

<div id="dynamicAddRemove" class="form-group col-sm-12">
    @if(isset($episodes))
        @foreach($episodes as $i => $episode)
		@include('dynamic_episode', ['i' => $i, 'episode' => $episode])
        @endforeach
    @endif
</div>

<!-- Author Field -->
<div class="form-group col-sm-6">
    {!! Form::label('author', 'Author:') !!}
    {!! Form::text('author', null, ['class' => 'form-control']) !!}
</div>
<?php } ?>

<!-- Publisher Field -->
<?php if(isset(Auth::user()->access->access_role) && Auth::user()->access->access_role == 3) { 
	$userId = auth()->id();
	?>
<div class="form-group col-sm-6">
	<input type="hidden" name="teacher_id" value="{{$userId}}" />
</div>
<div class="form-group col-sm-12">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control richEdit']) !!}
</div>
<?php }
else { ?>
<div class="form-group col-sm-6">
    {!! Form::label('publisher', 'Publisher:') !!}
    {!! Form::select('publisher_id', $publisher, null, ['class' => 'form-control', $disabled => '']) !!}
</div>
<?php } ?>

<!-- Year Field -->
<?php if(isset(Auth::user()->access->access_role) && Auth::user()->access->access_role != 3) { ?>
<div class="form-group col-sm-6">
    {!! Form::label('year', 'Year:') !!}
    {!! Form::text('year', null, ['class' => 'form-control']) !!}
</div>

<!-- Tags Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tags', 'ISBN/Product Code:') !!}
    {!! Form::text('tags', null, ['class' => 'form-control']) !!}
</div>

<!-- Length Field -->
<div class="form-group col-sm-6">
    {!! Form::label('length', 'Length:') !!}
    {!! Form::text('length', null, ['class' => 'form-control']) !!}
</div>

<!-- Language Field -->
<div class="form-group col-sm-6">
    {!! Form::label('language', 'Language:') !!}
    {!! Form::select('language',$lang, null, ['class' => 'form-control']) !!}
</div>

<!-- Age Field -->
<div class="form-group col-sm-6">
    {!! Form::label('age', 'Age:') !!}
    {!! Form::select('age',$age, null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('mat_category', 'Material Category:') !!}
    {!! Form::select('mat_category',$product, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12 hide" style="padding: 0;">
	<div class="form-group col-sm-6">
		{!! Form::label('allow_region', 'Select Region:') !!}
		<!-- {!! Form::select('allow_region[]',$region_data, $allow_region, ['class' => 'form-control','placeholder'=>'Select a value','multiple' => 'multiple']) !!} -->
		<select id="allow_region" name="allow_region[]" multiple="multiple" class='form-control text-dark'>
			@foreach($region_data as $data)
				<?php
					$selected = "";
					if(in_array($data->id,$allow_region))
						$selected = 'selected="selected"';
				?>
			<option value="{{$data->id}}" <?php echo $selected;?> >{{$data->region_name}}</option>
			@endforeach
		</select>

	</div>
	
</div>
{{--

<!-- Genre Id Field -->
<div class="form-group col-sm-4">
    {!! Form::label('genre_id', 'Genre:') !!}
    {{!! Form::select('genre_id',$genre, null, ['class' => 'form-control genreObject' , 'multiple' => 'multiple'])  !!}}
</div>

<!-- Department Id Field -->
<div class="form-group col-sm-4">
    {!! Form::label('department_id', 'Department:') !!}
    {{!! Form::select('department_id', ['select' => 'select', 'None' => 'None'], null, ['class' => 'form-control deptObject', 'multiple' => 'multiple']) !!}}
</div>

<!-- Subject Id Field -->
<div class="form-group col-sm-4">
    {!! Form::label('subject_id', 'Subject:') !!}
    {{!! Form::select('subject_id0', ['select' => 'select', 'None' => 'None'], null, ['class' => 'form-control subjectObject', 'multiple' => 'multiple']) !!}}
</div>
--}}


<!-- EDITED: Rahul@7:31 AM 3/15/2022-->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
<style>
	.divider {
		display: block;
		border-top: 1px solid #cccccc;
		text-align: center;
		position: relative;
		margin: 20px 10px 0px 10px;
	}
	.divider span {
		display: inline-block;
		font-weight: 700;
		position: relative;
		top: -.75em;
		background: #ffffff;
		padding: 0 5px;
	}
</style>

<!-- Genre group -->
<!-- Genre Id Field -->
<div class="form-group col-sm-4">
	{!! Form::label('genre_id', 'Genre:') !!}
	{!! Form::select('genre_id',$genre, null,  ['class' => 'form-control selectpicker mh genreObject', 
		'data-live-search'=>'true']) !!}
</div>

<!-- Department Id Field -->
<div class="form-group col-sm-4">
	{!! Form::label('department_id', 'Department:') !!}
	{!! Form::select('department_id', ['None' => 'None'], null, ['class' => 'form-control selectpicker mh deptObject', 
		'data-live-search'=>'true']) !!}
</div>

<!-- Subject Id Field -->
<div class="form-group col-sm-4">
	{!! Form::label('subject_id', 'Subject:') !!}
	{!! Form::select('subject_id', ['None' => 'None'], null, ['class' => 'form-control selectpicker mh subjectObject',
		'data-live-search'=>'true']) !!}
</div>
<!-- Genre group -->
<div class="form-group col-xs-12">
	<div class="divider">
		<span>Additional categories (Optional)</span>
	</div>
</div>

@for($i = 0; $i < 3; $i++)
	<!-- Genre group {{$i}} -->
	<!-- Genre Id Field -->
	<div class="form-group col-sm-4">
		{!! Form::label('genre_id'.$i, 'Genre:') !!}
		{!! Form::select('genre_id'.$i,$genre, null,  ['class' => 'form-control selectpicker mh genreObject', 
			'data-live-search'=>'true', 'data-index'=>$i]) !!}
	</div>

	<!-- Department Id Field -->
	<div class="form-group col-sm-4">
		{!! Form::label('department_id'.$i, 'Department:') !!}
		{!! Form::select('department_id'.$i, ['None' => 'None'], null, ['class' => 'form-control selectpicker mh deptObject', 
			'data-live-search'=>'true', 'data-index'=>$i]) !!}
	</div>

	<!-- Subject Id Field -->
	<div class="form-group col-sm-4">
		{!! Form::label('subject_id'.$i, 'Subject:') !!}
		{!! Form::select('subject_id'.$i, ['None' => 'None'], null, ['class' => 'form-control selectpicker mh subjectObject',
			'data-live-search'=>'true', 'data-index'=>$i]) !!}
	</div>
	<!-- Genre group {{$i}} -->

@endfor

<!-- EDITED: Rahul@7:31 AM 3/15/2022 ENDS-->

<!-- Summary Field -->
<div class="form-group col-sm-12 col-lg-12">
	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#home">Summary</a></li>
		<li><a data-toggle="tab" href="#menu1">Table of Content (TOC):</a></li>
		<li><a data-toggle="tab" href="#menu2">Author Details</a></li>
	</ul>

	<div class="tab-content">
		<div id="home" class="tab-pane fade in active">
			{!! Form::textarea('summary', null, ['class' => 'form-control']) !!}
		</div>
		<div id="menu1" class="tab-pane fade">
			{!! Form::textarea('table_of_content', null, ['class' => 'form-control']) !!}
		</div>
		<div id="menu2" class="tab-pane fade">
			{!! Form::textarea('author_detail', null, ['class' => 'form-control']) !!}
		</div>
		
	</div>
    
</div>
<?php } ?>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('appMaterials.index') }}" class="btn btn-default">Cancel</a>
</div>


<script>
	$(function(){
	var fileInput = $('#book_image');
	var file_book = $('#book_pdf');
    $('#add_app_mat_form').submit(function(e){
		// alert(fileInput.get(0).files.length)
		if(fileInput.get(0).files.length == 0){
			alert('Please choose a Cover Image');
            return false;
        }
		//10485760 Bytes , 2097152 Bytes, 20971520 bytes  //44485132
		// var fileSize = fileInput.get(0).files[0].size; // in bytes
		// if(fileSize>2097152){
		// 	alert('Please Select Cover Image size less than 2 MB.');
		// 	return false;
		// }

        if(file_book.get(0).files.length == 0){
			alert('Please choose a File');
            return false;
        }

		// var fileSize = file_book.get(0).files[0].size; // in bytes
		// if(fileSize>2097152){
		// 	alert('Please Select File size less than 2 MB.');
		// 	return false;
		// }
		return true;
    });	
});
</script>
<script>
	$(document).ready(function() {
		$('#allow_region').select2({
			placeholder: 'Select a value...',
			multiple: true,
		});
	

	
 	$('#material_type').on('change',function() {
    var selectedValue = $(this).val();
    
    // Add hide class to target element if selectedValue meets a certain condition
    if (selectedValue === '3') {
      $('#addbtndiv').addClass('hide');
    } else if (selectedValue === '5') {
		$('#addbtndiv').addClass('show');
		$('#addbtn').text('Add chapter');  // Set button text to "Add chapter"
	} else {
		$('#addbtndiv').removeClass('hide');
		$('#addbtn').text('Add episode');
	}
  });


  var i = {{ $episodes ? count($episodes) : 0 }};
  $("#addbtn").on('click', function() {
    event.preventDefault();
    ++i;
    var html = `@include('dynamic_episode', ['i' => '${i}'])`;
    $("#dynamicAddRemove").append(html);
});

	$("#dynamicAddRemove").on('click', '.remove-field', function() {
	$(this).closest('.episode').remove();
	});
});
</script>