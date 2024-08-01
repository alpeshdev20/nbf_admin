
<div class="episode" style="margin-top: 5px;">
    <div class="row" style="border: 1px solid black; margin: 0; padding-top: 10px">
    @if(isset($episode['id']))
    <input type="hidden" class="form-control" name="episodes[{{$i}}][episode_id]" value="{{ $episode['id'] ?? ''}}" />
    @endif
    @if(isset($episodes))
    <input type="hidden" class="form-control" name="episodes[{{$i}}][episode_id]" value="{{ old('episodes.'.$i.'.episode_id', $episode['episode_id'] ?? '') }}" />
    @endif
        <div class="form-group col-sm-6">
            <label for="sequence">Sequence</label>
            <input type="number" class="form-control" name="episodes[{{ $i }}][sequence]" placeholder="Enter sequence" value="{{ old('episodes.'.$i.'.sequence', $episode['sequence'] ?? '') }}" />
        </div>
        <div class="form-group col-sm-6">
            <label for="title">Title</label>
            <input type="text" name="episodes[{{ $i }}][title]" value="{{ old('episodes.'.$i.'.title', $episode['title'] ?? '') }}" placeholder="Enter title" class="form-control" />
        </div>
        <div class="form-group col-sm-6">
            <label for="summary">Summary</label>
            <input type="text" name="episodes[{{ $i }}][summary]" value="{{ old('episodes.'.$i.'.summary', $episode['summary'] ?? '') }}" placeholder="Enter summary" class="form-control" />
        </div>
        <div class="form-group col-sm-6">
            <label for="episode_length">Length</label>
            <input type="text" class="form-control" name="episodes[{{ $i }}][length]" value="{{ old('episodes.'.$i.'.length', $episode['length'] ?? '') }}" placeholder="Enter length" />
        </div>
        <div class="form-group col-sm-6">
            <div class="form-group col-sm-6">
                <label for="image">Cover image</label>
                <input type="file" name="episodes[{{ $i }}][image_file]" />
            </div>
            @if(isset($episode['image_file']))
            <div class="form-group col-sm-6">
                <label for="image">Current image: </label>
                <input type="hidden" name="episodes[{{$i}}][current_image]" value="{{$episode['image_file']}}" />
                {{$episode['image_file']}}
            </div>
            @endif
            @if(isset($episodes))
            <div class="form-group col-sm-6">
                <label for="image">Current image: </label>
                {{ old('episodes.'.$i.'.current_image', $episode['current_image'] ?? '') }}
            </div>
            @endif
        </div>
        <div class="form-group col-sm-6">
            <div class="form-group col-sm-6">
                <label for="file">File</label>
                <input type="file" name="episodes[{{ $i }}][file]" />
            </div>
            @if(isset($episode['file']))
            <div class="form-group col-sm-6">
                <label for="file">Current file: </label>
                <input type="hidden" name="episodes[{{$i}}][current_file]" value="{{$episode['file']}}" />
                {{$episode['file']}}
            </div>
            @endif
            @if(isset($episodes))
            <div class="form-group col-sm-6">
                <label for="file">Current file: </label>
                {{ old('episodes.'.$i.'.current_file', $episode['current_file'] ?? '') }}
            </div>
            @endif
        </div>
        <div class="form-group col-sm-6">
            <button type="button" class="btn btn-default remove-field" style="margin-top:25px;">Remove</button>
        </div>
    </div>
</div>
