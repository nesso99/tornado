@if(Session::has('success'))
    <div class="alert alert-success">
        <h4><i class="icon fa fa-check"></i> Thành công!</h4>
        {{ Session::get('success') }}.
    </div>
@endif