<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $externalApp->name }}</p>
</div>

<!-- Url Field -->
<div class="form-group">
    {!! Form::label('url', 'Url:') !!}
    <p>{{ $externalApp->url }}</p>
</div>

<!-- Public Key -->
<div class="form-group">
    {!! Form::label('public_key', 'Public Key:') !!}
    <p>{{ $externalApp->public_key }}</p>
</div>

<!-- Private Key -->
<div class="form-group">
    {!! Form::label('public_key', 'Private Key:') !!}
    <p>{{ $externalApp->private_key }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $externalApp->status }}</p>
</div>

