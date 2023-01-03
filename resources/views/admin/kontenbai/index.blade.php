@extends('layouts.app')
@section('title')
    <a href="{{route('kriteria.index')}}">
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">BAI Indeks</h5>
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
                    <h3 class="card-label">Konten BAI Indeks Level</h3>
                </div>
                <div class="card-toolbar">
                    {{-- @if(Auth::user()->is_role == 1) --}}
                    <!--begin::Button-->
                    {{-- <a href="{{route('kriteria.create')}}" class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                        <span class="fa fa-plus"></span>
                    </span>Tambah</a> --}}
                    <!--end::Button-->
                    {{-- @endif --}}
                </div>
            </div>
            <div class="card-body">
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                @endif

                <div id="success_message"></div>
                
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable" id="lks_datatable">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Level BAI</th>
                        <th>Deskripsi Level BAI</th>
                        <th width="170px">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <!--end: Datatable-->
            </div>
        </div>
        <!--end::Card-->

        {{-- Modal for Edit Data --}}
        <div class="modal fade" id="edit_konten_bai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit_konten_bai">Edit Konten BAI Indeks</h5>
                    </div>

                    <ul id="updateform_errlist"></ul>

                    <div class="modal-body">
                        {{-- <form method="POST" action=""> --}}
                            <div class="form-group">
                              <input type="hidden" id="bai_code">
                            </div>
                            <div class="form-group">
                              <label for="baiLevel">Level Indeks BAI</label>
                              <input class="form-control" id="edit_lv_bai">
                            </div>
                            <div class="form-group">
                              <label for="deskripsiKriteria">Deskripsi Indeks BAI</label>
                                <textarea class="form-control" id="edit_desc_bai" rows="6"></textarea>
                            </div>
                          {{-- </form> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary update_konten_bai">Simpan</button>
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
    <!-- Bootstrap CSS -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous"> --}}
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
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    {{-- <script src="{{ asset('assets/js/jquery-2.0.3.min.js') }}"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>  --}}
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
                        url: '{{ route('bai-konten.index') }}'
                    },
                     columns:[
                        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                        {
                            data: 'level_bai',
                            name: 'level_bai'
                        },
                        {
                            data: 'detail_bai',
                            name: 'detail_bai'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });

                //JQuery to call Edit Modal
                $('body').on('click', '.edit_konten_bai', function (e) {
                    e.preventDefault();
        
                    var bai_code = $(this).val();
                    // console.log(kriteria_id);
                    var url = "{{ route('bai-konten.edit', ':bai_code') }}";
	                url = url.replace(':bai_code', bai_code);

                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function (response) {
                            if(response.status == 404) {
                                $('#success_message').html("");
                                $('#success_message').addClass('alert alert-danger');
                                $('#success_message').text(response.message);
                            }else{
                                $('#edit_desc_bai').text(response.kontenBai.detail_bai);
                                $('#edit_lv_bai').val(response.kontenBai.level_bai);
                                $('#bai_code').val(bai_code);
                            }
                        }
                    });
                });
            });
            //JQuery to update the data
            $(document).on('click', '.update_konten_bai', function(e){
                    e.preventDefault();
                    var bai_code = $('#bai_code').val();
                    $(this).text("Menyimpan");
                    // get each input from modal edit kriteria
                    var data = {
                        'level_bai': $('#edit_lv_bai').val(),
                        'detail_bai': $('#edit_desc_bai').val()
                    }

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    // set the update url
                    var url = "{{ route('bai-konten.update', ':bai_code') }}";
	                url = url.replace(':bai_code', bai_code);

                    
                    $.ajax({
                        type: "PUT",
                        url: url,
                        data: data,
                        dataType: "json",
                        success: function(response){
                            if(response.status == 400){
                                $('#updateform_errlist').html("");
                                $('#updateform_errlist').addClass('alert alert-danger');
                                $.each(response.errors, function (key, err_values) {
                                    $('#updateform_errlist').append('<li>'+err_values+'</li>')
                                })
                                $('.update_konten_bai').text("Simpan");
                            }else{
                                $('#updateform_errlist').html("");
                                // $('#success_message').addClass('alert alert-success');
                                // $('#success_message').text(response.message);
                                
                                Swal.fire({
                                    position:'center',
                                    icon:'success',
                                    title: response.message,
                                    timer: 2500,
                                    showConfirmButton: false
                                    }).then((result) => {
                                        $('.update_konten_bai').text("Simpan");
                                        location.reload();
                                    });

                                
                            }
                        }
                    })
                });
        })
    </script>
    <!--end::Page Scripts-->
@endpush