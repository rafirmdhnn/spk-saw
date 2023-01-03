@extends('layouts.app')
@section('title')
<a href="{{route('bobot-preferensi.index')}}">
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Daftar Bobot Preferensi</h5>
</a>
@endsection
@section('content')
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">	
    <!--begin::Container-->
    <div class="container">
       
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header flex-wrap pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Daftar Bobot Preferensi</h3>
                </div>
                {{-- <div class="card-toolbar">
                    <!--begin::Button-->
                    <a href="{{route('alternatif.create')}}" class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                        <span class="fa fa-plus"></span>
                    </span>Tambah</a>
                    <!--end::Button-->
                </div> --}}
            </div>
            <div class="card-body">
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                @endif
                <div style="overflow-x: scroll">
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable" id="lks_datatable">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode Alternatif</th>
                        <th>Bobot Preferensi</th>
                        <th width="170px">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <!--end: Datatable-->
                </div>
            </div>
        </div>
        <!--end::Card-->

        {{-- Modal for Edit Data --}}
        <div class="modal fade" id="edit_bobotPreferensi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit_bobotPref_title">Edit Bobot Preferensi</h5>
                    </div>

                    <ul class="mx-5 mt-2 mb-0" id="updateform_errlist"></ul>

                    <div class="modal-body">
                        {{-- <form method="POST" action=""> --}}
                            <div class="form-group">
                                <input type="hidden" id="bobot_id">
                            </div>
                            <div class="form-group">
                                <label for="alternatif">Alternatif</label>
                                <input class="form-control" id="edit_alternatif" disabled>
                            </div>
                            <div class="form-group">
                                <label for="bobotPref">Nilai Bobot Preferensi</label>
                                <input class="form-control" id="edit_bobot_pref">
                            </div>
                            {{-- </form> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary update_bobot_pref">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- end::Modal --}}
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->
@endsection

@push('css')
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{asset('assets')}}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->
    <link href="{{asset('assets/js/lightbox/css/lightbox.min.css')}}" rel="stylesheet" type="text/css" />
   

    <style>
        #filter_card .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1rem;
        }

        .select2 {
            width: 100% !important; /* overrides computed width, 100px in your demo */
        }
    </style>
@endpush
@push('js')
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{asset('assets')}}/plugins/custom/datatables/datatables.bundle.js"></script>
   
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
   
    <script type="text/javascript" src="{{asset('assets/js/lightbox/js/lightbox.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var value;
            var tbl;
            var tblDetail;
            $(document).ready(function () {
                tbl = $('#lks_datatable').DataTable({
                    responsive: true,
                    "ordering": true,
                    deferRender: true,
                    serverSide: true,
                    processing: true,
                    orderMulti: true,
                    stateSave: true,
                    ajax: {
                        url: '{{ route('bobot-preferensi.index') }}'
                    },
                     columns:[
                        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                        {
                            data: 'alternatif.alternatif_kode',
                            name: 'alternatif.alternatif_kode'
                        },
                        {
                            data: 'bobot',
                            name: 'bobot'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });
            });
            //JQuery to call Edit Modal
            $(document).on('click', '.edit_bobot', function (e) {
                e.preventDefault();
    
                var bobotPref_id = $(this).val();

                var url = "{{ route('bobot-preferensi.edit', ':bobotPref_id') }}";
                url = url.replace(':bobotPref_id', bobotPref_id);

                $.ajax({
                    type: "GET",
                    url: url,
                    success: function (response) {
                        // console.log(response);
                        if(response.status == 404) {
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-danger');
                            $('#success_message').text(response.message);
                        }else{
                            $('#edit_alternatif').val(response.bobotPreferensi.alternatif.alternatif_kode);
                            $('#edit_bobot_pref').val(response.bobotPreferensi.bobot);
                            $('#bobot_id').val(bobotPref_id);
                        }
                    }
                });
            });
            //JQuery to update the data
            $(document).on('click', '.update_bobot_pref', function(e){
                e.preventDefault();
                var bobot_id = $('#bobot_id').val();
                $(this).text("Menyimpan");
                // get each input from modal edit kriteria
                var data = {
                    'bobot_pref': $('#edit_bobot_pref').val()
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                
                // set the update url
                var url = "{{ route('bobot-preferensi.update', ':bobot_id') }}";
                url = url.replace(':bobot_id', bobot_id);

                
                $.ajax({
                    type: "PUT",
                    url: url,
                    data: data,
                    dataType: "json",
                    success: function(response){
                        console.log(response);
                        if(response.status == 400){
                            $('#updateform_errlist').html("");
                            $('#updateform_errlist').addClass('alert alert-danger');
                            $.each(response.errors, function (key, err_values) {
                                $('#updateform_errlist').append('<li>'+err_values+'</li>')
                            })
                            $('.update_bobot_pref').text("Simpan");
                        }else{
                            $('#updateform_errlist').html("");
                            $('#updateform_errlist').hide();
                            
                            Swal.fire({
                                position:'center',
                                icon:'success',
                                title: response.message,
                                timer: 2500,
                                showConfirmButton: false
                                }).then((result) => {
                                    $('.update_bobot_pref').text("Simpan");
                                    location.reload();
                                });
                        }
                    }
                })
            });
        });
    </script>
    <!--end::Page Scripts-->
@endpush