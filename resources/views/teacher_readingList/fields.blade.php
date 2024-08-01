
<input type="hidden" name="{{$readingList->publisher_id ? 'publisher_id' : 'teacher_id' }}" 
value="{{$readingList->publisher_id ? $readingList->publisher_id : $readingList->teacher_id}}" />
<input type="hidden" name="reading_list_id" value="{{$readingList->id}}" />
<div class="form-group col-sm-6">
    {!! Form::label('token_count', 'Enter token count:') !!}
    {!! Form::number('token_count', 0, ['class' => 'form-control','max' => 999999,'type' => 'number']) !!}
</div>
						
<!-- Submit Field -->
<div class="form-group col-sm-12">
	{!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
	<a href="{{ route('prescribedReadingLists.index') }}" class="btn btn-default">Cancel</a>
</div>