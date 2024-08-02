<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'autocomplete'=>'false']) !!}
	<input type="hidden" name="selected_ids" id="selected_ids" value=""/>
	<input type="hidden" name="prescriber" id="prescriber" value=""/>
</div>

<!-- Material Type Field -->

<?php if(isset(Auth::user()->access->access_role) && Auth::user()->access->access_role == 3) { ?>
<?php $userId = Auth::user()->id; ?>
 <div class="form-group col-sm-6">
    {!! Form::label('teacher_id', 'Teacher:') !!}
    {!! Form::select('teacher_id', [Auth::user()->id => Auth::user()->name], $publisher_id, ['class' => 'form-control']) !!}
</div>

<?php } else { ?>
<div class="form-group col-sm-6">
    {!! Form::label('publisher_id', 'Publisher:') !!}
    {!! Form::select('publisher_id',$publishers, $publisher_id, ['class' => 'form-control']) !!}
</div>
<?php } ?>


<!-- School Name/Prescriber Field -->
<?php if(isset(Auth::user()->access->access_role) && Auth::user()->access->access_role == 3) { ?>
<div class="form-group col-sm-6">
    {!! Form::label('prescriber_id', 'School:') !!}
    {!! Form::select('prescriber_id',$schools, $TeacherDetail->institute_id, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
    <input type="hidden" name="prescriber_id" value="{{$TeacherDetail->institute_id}}" />
</div>

<?php } else { ?>
    <div class="form-group col-sm-6">
    {!! Form::label('prescriber_id', 'School:') !!}
    {!! Form::select('prescriber_id',$schools, null, ['class' => 'form-control']) !!}
</div>
<?php } ?>


<!-- Level/Class Field -->
<div class="form-group col-sm-6">
    {!! Form::label('level', 'Class:') !!}
    <!-- {!! Form::select('level',$level, null, ['class' => 'form-control']) !!} -->
    <select name="level" id="level" class="form-control">
        @foreach ($level as $level_name)
        <?php
            $selected = "";
            if(isset($prlist))
            {
                if($level_name == $prlist->level )
                    $selected = 'selected="selected"';
            }
            
        ?>
            <option value="{{ $level_name }}" <?php echo $selected; ?>  >{{ $level_name }}</option>
        @endforeach 
    </select>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('prescribedReadingLists.index') }}" class="btn btn-default">Cancel</a>
</div>

