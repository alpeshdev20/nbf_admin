<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $region->id }}</p>
</div>

<div class="form-group">
    {!! Form::label('region_name', 'Region name:') !!}
    <p>{{ $region->region_name}}</p>
</div>

<div class="form-group">
    {!! Form::label('countries_id', 'Region name:') !!}
    <p>{{ $region->countries_id}}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $region->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $region->updated_at }}</p>
</div>

<!-- Summary Field -->


