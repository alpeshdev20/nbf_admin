@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Create PA Tokens | Allowed: {{$allowed_token}} | Available: {{$available_token}} | Used: {{$used_token}}
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
				<div class="row">
					<div class="col-sm-12">
						<h4>Create PA tokens for: <strong>{{ $list['name'] }}</strong></h4>
					</div>
				</div>
                <div class="row">
                    {!! Form::open(['id'=>'token_form']) !!}
						
                        <!-- Parent Group Field -->
						<div class="form-group col-sm-6">
							{!! Form::label('token_count', 'Enter token count:') !!}
							{!! Form::number('token_count', 0, ['class' => 'form-control','max' => 999999,'type' => 'number']) !!}
						</div>
						
						<!-- Submit Field -->
						<div class="form-group col-sm-12">
							{!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
							<a href="{{ route('prescribedReadingLists.index') }}" class="btn btn-default">Cancel</a>
						</div>

                    {!! Form::close() !!}
                </div>
				<style>
				.token{padding:10px; border:1px solid #efefef;}
				.batch {display: flex;border: 1px solid #efefef;align-items: center;justify-content: space-between;padding: 5px;}
				.batch>span{display:inline-block; margin:0 5px; padding: 5px;}
				</style>
				<div id="batch-cont" class="row" style="margin:0;">

				</div>
				<div id="token-cont" class="row" style="margin:0;">
				</div>
            </div>
        </div>
    </div>
	<script>
		 $(document).ready(function(){
			setTimeout(function() {
				$('.alert-success').remove();
			}, 2000); 
			
			var token = '{{ csrf_token() }}';
			$('#token_form').on('submit', function(e){
				e.preventDefault()
				var token_count = $('#token_count').val()
				if(token_count==0){
					alert('Token count cannnot be 0')
					return
				}
				$('.loading').show()
				$.ajax({
					type: "GET",
					dataType: "json",
					headers: {'X-CSRF-TOKEN': token},
					url: '{{route("createtoken", $list->id)}}',
					data: {count: token_count},
					success: function(data){
						console.log(data.batch_id)
						if(!data.success) {
							alert(data.message);
							$('.loading').hide();
							return false;
						}
						html = '';
						$('#batch-cont').append(
						`<div class="col-sm-6 batch"><span>Batch: ${data.batch_name}</span><span>Created on: ${data.date}</span><a class="btn-sm btn-primary" href="{{ url('getpatokenbatch') }}/${data.batch_id}">Download</a></div>`
						)
						
						data.tokens.splice(0, Math.min(data.tokens.length, 10)).forEach((d,i)=>{
							html+=`<div class="col-sm-3 token">${d}</div>`
						})
						$('#token-cont').html(html)
						$('.loading').hide()
						$('#token_form').get(0).reset()
						//location.reload();  
					},
					error:function(err){
						$('.loading').hide()
						alert(err.responseText)
					}
				});
			})
			
		});
	</script>
@endsection

