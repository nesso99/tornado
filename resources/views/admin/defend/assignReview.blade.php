@extends('layout')
@section('content')
	@if(Session::has('flash-message'))
		<div class="alert alert-{!!Session::get('flash-level')!!}">
			{!!Session::get('flash-message')!!}
		</div>
	@endif
    <div class="row">
        <div class="col-md-12">
            <a href="{{route('assignReview_export')}}"><button type="" class="btn btn-primary">Tạo lịch phân công bảo vệ</button></a>
        </div>
    </div>
@endsection
@section('scripts')
	<script>
		$('div.alert').delay(3000).slideUp();
	</script>
@endsection
