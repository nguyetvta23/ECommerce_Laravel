@extends('admin.index')
@section('content')
<link href="{{asset('admin/assets/libs/tablesaw/tablesaw.css')}}" rel="stylesheet" type="text/css">
<div class="row">
    <div class="col-12">
    <section class="content-info">
        <div class="card-box">
            <iframe src="{{url('/file/dialog.php')}}" width="100%" height="500px" style="over-flow-y:auto" frameborder="0"></iframe>
        </div>
    </section>
    </div>
</div>
<!-- form-delete -->
<form method="POST" action="" id="form-delete">
    @method('DELETE')
    @csrf
</form> 
@endsection
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />
@endpush
@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

<script src="{{asset('admin/assets/libs/tablesaw/tablesaw.js')}}"></script>
<script src="{{asset('admin/assets/js/pages/tablesaw.init.js')}}"></script>
<!-- <script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script> -->
<!-- <script type="text/javascript">

     $('.btndelete').click(function(event) {
          var form =  $(this).closest("form#form-delete");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Bạn muốn xóa chứ?`,
              text: "Bạn không thể quay lại bước này.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });

</script> -->
<!-- javascript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
@endpush