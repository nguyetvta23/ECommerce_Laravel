@extends('admin.index')
@section('content')
@if(Session::has('alert_success'))
    <div class="alert alert-success" style="margin-top: 10px;">
        {!! Session::get('alert_success') !!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<div class="modal modal-danger fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="" method="post">
                @csrf
                @method('DELETE')
                <input id="id" name="id")>
                <h5 class="text-center">Are you sure you want to delete this contact?</h5>
                <input id="firstName" name="firstName"><input id="lastName" name="lastName">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-sm btn-danger">Yes, Delete Contact</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <h3 class="card-title">Danh sách phản hồi</h3>
            <table id="example" class="table table-striped table-bordered" style="width:100%" data-form="contactForm">
                <thead>
                    <tr>
                        <th>E-Mail</th>
                        <th>Sô điệnt thoại</th>
                        <th>Tiêu đề</th>
                        <th>Nội dung</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listContacts as $v)
                    <tr>
                        <td>{{$v->m_email}}</td>
                        <td>{{$v->m_phone}}</td>
                        <td>{{$v->m_title}}</td>
                        <td>{{ Str::limit($v->m_content, 20, '...') }}</td>
                        <td>
                            <a href="{{route('contact-edit-admin', ['id' => $v->id])}}" class="btn btn-info btn-sm" data-toggle="tooltip" title='Xem chi tiết' style="float:left;">
                                <i class="fas fa-pencil-alt"></i> Xem chi tiết
                            </a>
                            <form method="POST" action="{{route('contact-delete-admin', ['id' => $v->id])}}">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-danger btn-sm show_confirm" data-toggle="tooltip" title='Xóa' style="margin-left:10px;">
                                    <i class="fas fa-trash"></i> Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>E-Mail</th>
                        <th>Sô điệnt thoại</th>
                        <th>Tiêu đề</th>
                        <th>Nội dung</th>
                        <th>Hành động</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />
@endpush
@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
<script type="text/javascript">

     $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
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

</script>
@endpush
