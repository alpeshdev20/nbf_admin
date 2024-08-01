<!-- Materialupload Id Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('materialupload_id', 'Materialupload Id:') !!}
    {!! Form::text('materialupload_id', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Cover Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Region Name:') !!}
    {!! Form::text('region_name',null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-4">
    {!! Form::label('countries_id', 'Countries:') !!}
    <!-- {!! Form::select('countries_id',$country_data,$countries_id, ['select' => 'select', 'name' => 'countries_id[]','multiple' => 'multiple']) !!} -->

    <select id="countries_id" name="countries_id[]" multiple="multiple" class='form-control text-dark'>
        @foreach($country_data as $data)
            <?php
                $selected = "";
                if(in_array($data->id,$countries_id))
                    $selected = 'selected="selected"';
            ?>
        <option value="{{$data->id}}" <?php echo $selected  ?> >{{$data->name}}</option>
        @endforeach
    </select>
</div>

<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('region.index') }}" class="btn btn-default">Cancel</a>
</div>
<script>
	$(document).ready(function() {
		$('#countries_id').select2({
			placeholder: 'Select a value...',
			multiple: true,
		});
	});
</script>