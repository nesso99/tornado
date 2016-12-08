@extends('layout')
@section('content')
    @if(Session::has('flash-message'))
        <div class="alert alert-{!!Session::get('flash-level')!!}">
            {!!Session::get('flash-message')!!}
        </div>
    @endif
  
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                   <div class="box-header with-border">
                    <h3 class="box-title">Danh sách đề tài của sinh viên</h3>
                </div>
            </div>
            <div class="box-body">
                <table class="table">
                    <thead>
                      <tr>
                      <th>STT</th>
                        <th>Tên sinh viên</th>
                        <th>Tên giảng viên hướng dẫn</th>
                        <th>Đề tài</th>
                        <th>Sửa đề tài</th>
                        <th>Hủy đăng ký</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $id=0;?>
                        @foreach($student_array as $student)
                        
                          <tr>
                          <td><?php echo $id; ?></td>
                            <td>{{ $student->name}}</td>
                            <td>{{$instructor_array[$id]->name}}</td>
                            <td>{{$topic_array[$id]->name}}</td>
                            {{$topic_array[$id]->id}}
                            {!!  $id_topic = $topic_array[$id]->id  !!}
                            <td> <a href="editRegister/{!!$id_topic!!}"><button type="" class="btn btn-primary">Sửa</button></a> </td>
                             <td><a href="deleteRegister/{!!$id_topic!!}"><button type="" class="btn btn-danger">Hủy</button></a> </td>
                          </tr>
                      <?php $id++; ?>
                        
                        @endforeach
                    </tbody>
                  </table>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('div.alert').delay(3000).slideUp();
    </script>
@endsection

