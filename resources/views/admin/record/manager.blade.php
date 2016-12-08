@extends('layout')
@section('content')
	@if(Session::has('flash-message'))
		<div class="alert alert-{!!Session::get('flash-level')!!}">
			{!!Session::get('flash-message')!!}
		</div>
	@endif
    <div class="row">
        <div class="col-md-12">
            <a href="{{route('turnOnRecordRegister')}}"><button type="" class="btn btn-primary">Mở nộp và chỉnh sửa hồ sơ bảo vệ</button></a>
 			<a href="{{route('sendMailStudentHasTopic')}}"><button type="" class="btn btn-primary">Gửi mail nhắc nhở sinh viên nộp hồ sơ bảo vệ</button></a>
        	<a href="{{route('turnOffRegister')}}"><button type="hidden" class="btn btn-primary">Kết thúc hạn nộp </button></a> 
        </div>
    </div>
@endsection
@section('scripts')
	<script>
		$('div.alert').delay(3000).slideUp();
	</script>
@endsection

