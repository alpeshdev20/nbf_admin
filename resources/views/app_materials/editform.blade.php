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
    {!! Form::select('material_type',$material, null, ['class' => 'form-control']) !!}
</div>
<?php } ?>

<!-- Book Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('book_name', 'Title:') !!}
    {!! Form::text('book_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Book Image Field 'image/jpeg', 'image/jpg', 'image/png',-->
<div class="form-group col-sm-6">
	<div class="col-sm-6"> 
		{!! Form::label('book_image', 'Cover Image:') !!}
		{!! Form::file('book_image',  null , ['class' => 'form-control']) !!}
	</div>
	<div class=" col-sm-6">
	<!-- <label for="" id="cover_id">1 File was Selected</label> -->
	{!! Form::label('book_image', 'Current Image:') !!}
	{{$book_image_val}}
	</div>
</div>

<!-- Book Pdf Field -->
<div class="form-group col-sm-6">
	<div class="col-sm-6"> 
		{!! Form::label('book_pdf', 'File:') !!}
		{!! Form::file('book_pdf', null, ['class' => 'form-control']) !!}
	</div>
	<div class=" col-sm-6">
	<!-- <label for="" id="pdf_id">1 File was Selected</label> -->
	{!! Form::label('book_pdf', 'Current File:') !!}
	{{$book_pdf_val}}
	</div>
    
	<!-- <input type="file" name="book_pdf" class="form-control"  id="book_pdf" value="{{$book_pdf_val}}"> -->
</div>


<div id="addbtndiv" class="form-group col-sm-12 {{$appMaterial->material_type == 2 || $appMaterial->material_type == 4 ? '' : 'hide' }}">
	<button id="addbtn" class="btn btn-primary">Add episode</button>
</div>

<?php if(isset(Auth::user()->access->access_role) && Auth::user()->access->access_role == 1) { ?>
	<div id="dynamicAddRemove" class="form-group col-sm-12">
@if(isset($episodes))
        @foreach($episodes as $i => $epi)
		@include('dynamic_episode', ['i' => $i, 'episode' => $epi])
        @endforeach
    @elseif(isset($episode))
        @foreach($episode as $i => $epi)
		@include('dynamic_episode', ['i' => $i+1, 'episode' => $epi])
        @endforeach
    @endif
	
</div>
<?php } ?>


<!-- Author Field -->
<?php if(isset(Auth::user()->access->access_role) && Auth::user()->access->access_role != 3) { ?>
	
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


<?php if(isset(Auth::user()->access->access_role) && Auth::user()->access->access_role != 3) { ?>
<!-- Year Field -->
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
	{!! Form::select('department_id', $department_selected  , null, ['class' => 'form-control selectpicker mh deptObject', 
		'data-live-search'=>'true']) !!}
</div>

<!-- Subject Id Field -->
<div class="form-group col-sm-4">
	{!! Form::label('subject_id', 'Subject:') !!}
	{!! Form::select('subject_id', $subject_selected, null, ['class' => 'form-control selectpicker mh subjectObject',
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
	<?php
			$chk_genid = isset($genre_ids[$i])?$genre_ids[$i]:"";
			// echo $chk_genid;
		$chk_depid = isset($department_ids[$i])?$department_ids[$i]:null;
		$chk_subid = isset($subject_ids[$i])?$subject_ids[$i]:null;

	?>
	
    <div class="form-group col-sm-4">
        {!! Form::label('genre_id'.$i, 'Genre:') !!}    
        <select name="genre_id<?php echo $i ?>"  class="form-control  selectpicker mh genreObject" data-live-search="true", data-index="<?php echo $i; ?>">
            <option value="" >None</option>
            @foreach($genre_data as $data)
                <?php
					$selected = "";					
					if($data->id == $chk_genid)
						$selected = 'selected="selected"';
				?>
                <option value="{{$data['id']}}" <?php   echo $selected;  ?>>{{$data->genre_name}}</option>
            @endforeach
        </select>
    </div>

	<!-- Department Id Field -->
	<div class="form-group col-sm-4">
		{!! Form::label('department_id'.$i, 'Department:') !!}
		<!-- {!! Form::select('department_id'.$i, ['select' => 'select', 'None' => 'None'], null, ['class' => 'form-control selectpicker mh deptObject', 
			'data-live-search'=>'true', 'data-index'=>$i]) !!} -->
        <select name="department_id<?php echo $i ?>"   class="form-control selectpicker mh deptObject" data-live-search="true", data-index="<?php echo $i; ?>">
            <option value="" >None</option>
            @if($chk_genid != "" && $chk_genid != null)
                @foreach($departments[$chk_genid] as $department_data)
                    <?php
                        $selected = "";					
                        if($department_data->id == $chk_depid)
                            $selected = 'selected="selected"';
                    ?>
                    <option value="{{$department_data->id}}" <?php echo $selected; ?> >{{$department_data->department_name}}</option>
                @endforeach
            @endif
        </select>
	</div>

	<!-- Subject Id Field -->
	<div class="form-group col-sm-4">
		{!! Form::label('subject_id'.$i, 'Subject:') !!}
		<!-- {!! Form::select('subject_id'.$i, ['select' => 'select', 'None' => 'None'], null, ['class' => 'form-control selectpicker mh subjectObject',
			'data-live-search'=>'true', 'data-index'=>$i]) !!} -->
        <select name="subject_id<?php echo $i ?>"  class="form-control  selectpicker mh subjectObject" data-live-search="true", data-index="<?php echo $i; ?>">
            <option value="" >None</option>
            @if($chk_depid != "" && $chk_depid != null)
                @foreach($subjects[$chk_depid] as $subject_data)
                    <?php
                        $selected = "";					
                        if($subject_data->id == $chk_subid)
                            $selected = 'selected="selected"';
                    ?>
                    <option value="{{$subject_data->id}}" <?php echo $selected; ?> >{{$subject_data->subject_name}}</option>
                @endforeach
            @endif
        </select>
            
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
	
	//
	document.getElementById('book_image').addEventListener('change', function(e) {
		if (e.target.files[0]) {
			$('#cover_id').text('');
		}
	});
	document.getElementById('book_pdf').addEventListener('change', function(e) {
		if (e.target.files[0]) {
			$('#pdf_id').text('');
		}
	});
	//
	
    $('#edit_app_mat_form').submit(function(e){		
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

		// $('#genre_id0').selectpicker('refresh');

	
	});

    

</script>
<script>
	$(document).ready(function() {
	
 	$('#material_type').on('change',function() {
    var selectedValue = $(this).val();
    
    if (selectedValue === '3') {
      $('#addbtndiv').addClass('hide');
    } else if (selectedValue === '5') {
		$('#addbtndiv').addClass('hide');
	} else {
		$('#addbtndiv').removeClass('hide');
	}
  	});

	@if(isset($episodes) || isset($episode))
        var i = {{ ($episodes ? count($episodes) : ($episode ? count($episode) : 0)) }};
    @else
        var i = 0;
    @endif


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
