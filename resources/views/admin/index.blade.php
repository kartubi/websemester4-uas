@extends('admin.master')
@push('css')
<style>
    .dropdown-content{
        width: auto!important;
    }
</style>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
@endpush
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>DAFTAR MAHASISWA</h2>
            </div>
        </div>
    </div>

    <!-- Dropdown Trigger -->

    <table class="bordered" id="mahasiswa">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Nim</th>
                <th>Email</th>
                <th>Smester</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>

@endsection
@push('script')
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script>
            $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings)
            {
                return {
                    "iStart": oSettings._iDisplayStart,
                    "iEnd": oSettings.fnDisplayEnd(),
                    "iLength": oSettings._iDisplayLength,
                    "iTotal": oSettings.fnRecordsTotal(),
                    "iFilteredTotal": oSettings.fnRecordsDisplay(),
                    "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                    "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                };
            };
            $('#mahasiswa').DataTable({

                processing  : true,
                serverSide  : false,
                destroy: true,
                paging: false,
                ajax: '{{url("/admin/data/get_mhs")}}',
                "columnDefs": [
                    { className: "dt[-head|-body]-center" }
                ],
                columns: [
                    {
                        "searchable": false, "targets": 0,
                        "data": null,
                        "width": "50px",
                        "sClass": "text-center",
                        "orderable": false
                    },
                    { data: 'name',name:"name"},
                    { data: 'nim', name:'nim'},
                    { data: 'email', name: 'email'},
                    { data: 'semester_id', name: 'semester_id'},
                    { data: 'action',  name:'action'},
                ],
                "order": [[1, 'asc']],
                "rowCallback": function (row, data, iDisplayIndex) {
                    var info = this.fnPagingInfo();
                    var page = info.iPage;
                    var length = info.iLength;
                    var index = page * length + (iDisplayIndex + 1);
                    $('td:eq(0)', row).html(index);
                }
            });
            console.log(this.id)
    </script>
    @endpush