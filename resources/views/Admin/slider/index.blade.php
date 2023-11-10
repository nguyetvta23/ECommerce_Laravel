@extends('Admin.index')
@section('content')
<link href="{{asset('admin/assets/libs/tablesaw/tablesaw.css')}}" rel="stylesheet" type="text/css">
<style>
        .phongnen{
            width: 150px;
            height: 200px;
            border: 1px solid rgb(247, 247, 247);
            border-radius: 15px;
            box-shadow: rgba(247, 247, 247, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
        }
        .phongnen img{
            padding: 5px 5px 5px 5px;
            width: 148.5px;
            height: 198px;
            border-radius: 15px;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }
        .phongheader{
            border: 1px solid #000;
        }
        .list-group li{
            font-weight: bold;
        }
        .list-group li:nth-child(2n-1){
            background-color: rgb(243, 241, 241);
        }
        .suaxoa a{
            margin-left: 5px;
        }
        .overchapter{
            height: 300px;
            overflow-y: auto;
        }
        .textdes{
            overflow-y: auto;
            height: 200px;
            background-color: rgb(237 237 237);
            padding: 7px;
            border-radius: 5px;
            text-align: justify;
            box-shadow: rgba(67, 71, 85, 0.27) 0px 0px 0.25em, rgba(90, 125, 188, 0.05) 0px 0.25em 1em;
        }
        .textdes::-webkit-scrollbar {
            width: 6px;
            background-color: #F5F5F5;
        }
        .textdes::-webkit-scrollbar-thumb {
            background-color: #cccccc;
            border-radius: 5px;
        }
        .butthemne{
            margin-top: 3px;
            position: relative;
            padding-left: 24px;
        }
        .iconthem{
            font-size: 24px;
            position: absolute;
            left: 0;
            top: 0.6px;
        }
    </style>
@if(Session::has('alert_success'))
    <div class="alert alert-success" style="margin-top: 10px;">
        {!! Session::get('alert_success') !!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<div class="row">
    <div class="col-12">
    <section class="content-info">
    <div class="card-box">
        <div class="row">
            <div class="col-md-4">
                <h4 class="mt-0 header-title"><b>Danh mục slider</b></h4>
            </div>
        </div>
    <div class=" tablesaw-bar  tablesaw-all-cols-visible  tablesaw-mode-columntoggle">
    <table class="tablesaw table mb-0 tablesaw-columntoggle" data-tablesaw-mode="columntoggle" data-tablesaw-mode-switch="" data-tablesaw-minimap="" id="tablesaw-7261" style="">
        <thead>
        <tr>
            <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="persist" class=" tablesaw-swipe-cellpersist" style="width: 30px;">#</th>
            <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-sortable-default-col="" data-tablesaw-priority="0" class="tablesaw-priority-0 tablesaw-toggle-cellvisible">Images</th>
            <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-sortable-default-col="" data-tablesaw-priority="1" class="tablesaw-priority-1">Phụ đề ngắn</th>
            <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="2" class="tablesaw-priority-2 tablesaw-toggle-cellvisible">Tiêu đề</th>
            <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="3" class=" tablesaw-priority-3">Mô tả</th>
            <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="4" class=" tablesaw-priority-4">đường dẫn link</th>
            <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="5" class=" tablesaw-priority-5">Trạng thái</th>
        </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach($datas as $key => $dt)
                <tr>
                    <td class=" tablesaw-swipe-cellpersist" style="width: 30px;">{{$i++}}</td>
                    <td class="tablesaw-priority-0 tablesaw-toggle-cellvisible">
                        <img src="{{asset('uploads')}}/{{$dt->m_images}}" width="100px" height="100px" />
                    </td>
                    <td class="tablesaw-priority-1 tablesaw-toggle-cellvisible">{{$dt->m_subtitle}}</td>
                    <td class="tablesaw-priority-2 tablesaw-toggle-cellvisible">{{$dt->m_title}}</td>
                    <td class="tablesaw-priority-3 tablesaw-toggle-cellvisible">{!!$dt->m_description!!}</td>
                    <td class="tablesaw-priority-3 tablesaw-toggle-cellvisible">{{$dt->m_link}}</td>
                    <td class=" tablesaw-priority-5">
                    @if($dt->m_status == 1)
                        <h4 class="badge badge-primary" style="padding:5px 10px;font-size:15px">Hiện</h4>
                    @else
                        <h4 class="badge badge-danger" style="padding:5px 10px;font-size:15px">Ẩn</h4>
                    @endif
                    </td>
                    <td class=" tablesaw-priority-6" style="width: 306px;">
                        <a href="{{route('slider.edit', $dt->id)}}" class="btn btn-primary waves-effect width-md waves-light">Sửa</a>
                        <a href="{{route('slider.destroy', $dt->id)}}" class="btn btn-danger waves-effect width-md waves-light btndelete">Xóa</a>
                    </td>
                </tr>
            @endforeach
            {{ $datas -> links()}}
        </tbody>
    </table>
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
@push('scripts')

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
<script>
    jQuery(document).ready(function($) {
        $('.btndelete').click(function(ev) {
            ev.preventDefault();
            var _href = $(this).attr('href');
            $('form#form-delete').attr('action',_href);
            alertify.confirm('bạn muốn xóa sản phẩm này chứ ?', function(result){
                if(result){
                    $('form#form-delete').submit();
                }
            })
        });
    });
</script>
@endpush