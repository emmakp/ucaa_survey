<span id="fed">
{{-- @if(count($errors)> 0)
	@foreach($errors->all() as $error)
		<div class="alert alert-danger">
			{{$error}}
		</div>
	@endforeach
@endif --}}

@if(session('success'))
	<div class="alert alert-success">
		{{session('success')}}
	</div>
@endif

@if(session('error'))
	<div class="alert alert-danger">
		{{session('error')}}
	</div>
@endif

@if(isset($custom_errors) && count($custom_errors)> 0)
	@foreach($custom_errors as $error)
		<div class="alert alert-danger">
			{{$error}}
		</div>
	@endforeach
@endif

</span>