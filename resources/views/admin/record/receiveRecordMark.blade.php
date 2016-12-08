@extends('layout')
@section('content')
    <div class="row">
        {{-- Notification for user --}}
        <div class="col-md-12">
         @if(Session::has('flash-message'))
            <div class="alert alert-{!!Session::get('flash-level')!!}">
                    {!!Session::get('flash-message')!!}
            </div>
        @endif
        </div>

        <!-- left column -->
        <div class="col-md-12">

            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách sinh viên chưa nộp hồ sơ bảo vệ</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <!-- {{ Form::open(['route' => 'postStudentCanAdd', 'method' => 'POST']) }} -->
                <div class="box-body">

                                    <table class="table table-striped">
                    <thead>
                        <th>Mã sinh viên</th>
                        <th>Tên sinh viên</th>
                        <th>Lớp</th>
                        <th>Chương trình đào tạo</th>
                        <th></th>
                        <th></th>
                    </thead>

                     @foreach ($student_list as $student)
                    <tr>
                        <td>{{$student->id}}</td>
                        <td>{{$student->name}}</td>
                        <td>{{$student->class}}</td>
                        <td>{{$student->training_program}}</td>
                        <td><a href="{{route('export_RecordValidList')}}"><button type="submit" class="btn btn-primary" >Đã nộp</button></a></td>
                    </tr>
                    @endforeach

                </table>
                                    
                </div>
                <!-- /.box-body -->
              <div class="box-footer ">
                <button type="submit" class="btn btn-primary">Gửi lại email nhắc nhở</button>
                </div>
            </div>
            <!-- /.box -->
        </div>
@endsection

@section('scripts')
    <script >
        $('div.alert').delay(3000).slideUp();
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            // ajax
            $.ajax({
                type: 'POST',
                url: '{{ route('postUnitByFaculty') }}',
                data: {
                    id: $("#faculty").val()
                },
                success:function(data){
                    for(i = 0; i < data.length; i++) {
                        $("#unit").append("<option value ='" + data[i].id + "' >" + data[i].name + "</option>");
                    }
                    $("#unit option").each(function () {
                        if($(this).val() == "{{old('unit')}}") {
                            $(this).attr('selected', 'selected');
                        }
                    });
                }
            });
            $("#faculty").change(function () {
                //delete all old option
                $("#unit option").each(function () {
                    if($(this).val() != "") {
                        $(this).remove();
                    }
                });
                // ajax
                $.ajax({
                    type: 'POST',
                    url: '{{ route('postUnitByFaculty') }}',
                    data: {
                        id: $(this).val()
                    },
                    success:function(data){
                        for(i = 0; i < data.length; i++) {
                            $("#unit").append("<option value ='" + data[i].id + "' >" + data[i].name + "</option>");
                        }
                    }
                });
            });
        });
    </script>
@endsection
@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            // ajax
            $.ajax({
                type: 'POST',
                url: '{{ route('postUnitByFaculty') }}',
                data: {
                    id: $("#faculty").val()
                },
                success:function(data){
                    for(i = 0; i < data.length; i++) {
                        $("#unit").append("<option value ='" + data[i].id + "' >" + data[i].name + "</option>");
                    }
                    $("#unit option").each(function () {
                        if($(this).val() == "{{old('unit')}}") {
                            $(this).attr('selected', 'selected');
                        }
                    });
                }
            });
            $("#faculty").change(function () {
                //delete all old option
                $("#unit option").each(function () {
                    if($(this).val() != "") {
                        $(this).remove();
                    }
                });
                // ajax
                $.ajax({
                    type: 'POST',
                    url: '{{ route('postUnitByFaculty') }}',
                    data: {
                        id: $(this).val()
                    },
                    success:function(data){
                        for(i = 0; i < data.length; i++) {
                            $("#unit").append("<option value ='" + data[i].id + "' >" + data[i].name + "</option>");
                        }
                    }
                });
            });
        });
    </script>
@endsection