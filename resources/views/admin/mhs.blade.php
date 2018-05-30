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
                <h2>NILAI {{strtoupper($info->name)}}</h2>
            </div>
        </div>
    </div>

    <!-- Dropdown Trigger -->
    <a class='dropdown-trigger btn' id="smt_trigger" href='#' data-target='dropdown1'>SEMESTER</a>
    <!-- Dropdown Structure -->
    <ul id='dropdown1' class='dropdown-content'>
        @foreach($semester as $smt)
            <li style="white-space: nowrap"><a id="{{$smt->id}}">{{strtoupper($smt->name)}}</a></li>
        @endforeach
    </ul>


    @if($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{$message}}</p>
        </div>
    @endif

    <table class="bordered" id="table_nilai">
        <thead>
        <tr>
            <th>No</th>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>Tugas</th>
            <th>Formatif</th>
            <th>UTS</th>
            <th>UAS</th>
            <th>Total Nilai</th>
            <th>Kumulatif</th>
            <th>Aksi</th>
        </tr>
        </thead>
    </table>
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Modal Header</h4>
            <div class="row">
            <form id="nilai">
                {!! csrf_field()  !!}

                    <div class="input-field col s6">
                        <input name="tugas"  id="tugas" type="text" class="validate">
                        <label for="tugas">Tugas</label>
                    </div>
                    <div class="input-field col s6">
                        <input name="formatif" id="formatif" type="text" class="validate">
                        <label for="formatif">Formatif</label>
                    </div>
                    <div class="input-field col s6">
                        <input name="UTS" id="UTS" type="text" class="validate">
                        <label for="UTS">UTS</label>
                    </div>
                    <div class="input-field col s6">
                        <input name="UAS" id="UAS" type="text" class="validate">
                        <label for="UAS">UAS</label>
                    </div>
            </form>
            </div>
        </div>
        <div class="modal-footer">
            <a id="kirim" class="modal-close waves-effect waves-green btn-flat">Save</a>
        </div>
    </div>
@endsection
@push('script')
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script>
        var modal = $('.modal').modal();

        var smt;
        var id_mhs;
        var id_pelajaran;
        $('.dropdown-trigger').dropdown();
        $('#dropdown1 li a').click(function () {
            $('#smt_trigger').text($(this).text());

            // alert(id_mhs);
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
            smt = this.id;
            id_mhs = "{{$info->id}}";
            $('#table_nilai').DataTable({

                processing  : true,
                serverSide  : false,
                destroy: true,
                paging: false,
                ajax: '{{url("/admin/data/get")}}'+'?smt='+smt+'&id_mhs='+id_mhs,
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
                    { data: 'sks', name:'sks'},
                    { data: 'tugas', name: 'tugas'},
                    { data: 'formatif', name: 'formatif'},
                    { data: 'uts', name: 'uts'},
                    { data: 'uas', name: 'uas'},
                    { data: 'total_nilai', name: 'total_nilai'},
                    { data: 'kumulatif', name: 'kumulatif'},
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
        })
        function editNilai(id) {

            id_pelajaran = id;
            $.ajax({
                url:"{{url('admin/data/edit_nilai')}}"+'/'+id+'/'+id_mhs+'/'+smt,
                type:"GET",
                success:function (res) {
                    console.log(res)
                }
            });
        }
        $('#kirim').click(function () {
            var form_data = $('#nilai').serialize();
            var tugas = $('#tuhas').val();
            var formatif = $('#formatif').val;
            var UTS = $('#UTS').val();
            var UAS = $('#UAS').val();
            $.ajax({
                url:"{{url('admin/data/kirim_nilai')}}"+'?id='+id_pelajaran+'&mhs='+id_mhs+'&smt='+smt,
                type:"POST",
                data:form_data,
                success:function (res) {
                    console.log(res)
                    $('#table_nilai').DataTable().ajax.reload();
                    $('#nilai')[0].reset();
                }
            })
        })
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endpush