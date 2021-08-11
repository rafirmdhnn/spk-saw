@extends('layouts.app')
@section('title')
    <a href="{{route('kriteria.index')}}">
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Daftar Kriteria</h5>
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
                    <h3 class="card-label">Daftar Kriteria</h3>
                </div>
                <div class="card-toolbar">
                    @if(Auth::user()->is_role == 1)
                    <!--begin::Button-->
                    {{-- <a href="{{route('kriteria.create')}}" class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                        <span class="fa fa-plus"></span>
                    </span>Tambah</a> --}}
                    <!--end::Button-->
                    @endif
                </div>
            </div>
            <div class="card-body">
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                @endif
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable" id="lks_datatable">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Alternatif</th>
                        <th>Nama Kriteria</th>
                        <th>Atribute</th>
                        <th>Bobot</th>
                        {{-- <th width="170px">Aksi</th> --}}
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <!--end: Datatable-->
            </div>
        </div>
        <!--end::Card-->
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
    <script>
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
                        url: '{{ route('kriteria.index') }}'
                    },
                     columns:[
                        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                        {
                            data: 'alternatif.alternatif_nama',
                            name: 'alternatif.alternatif_nama'
                        },
                        {
                            data: 'kriteria_nama',
                            name: 'kriteria_nama'
                        },
                        {
                            data: 'kriteria_atribut',
                            name: 'kriteria_atribut'
                        },
                        {
                            data: 'kriteria_bobot',
                            name: 'kriteria_bobot'
                        },
                        // {
                        //     data: 'action',
                        //     name: 'action',
                        //     orderable: false,
                        //     searchable: false
                        // }
                    ]
                });

                $('body').on('click', '.btnDelete', function (e) {
                    e.preventDefault();
                    var form = $(this).parent();
                    Swal.fire({
                        title: "Anda Yakin?",
                        text: "Ingin hapus data Kriteria ?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Hapus",
                        cancelButtonText: "Batal",
                        reverseButtons: true,
                        confirmButtonColor: '#d33',
                    }).then(function (result) {
                        if (result.isConfirmed) {
                            form.submit();
                        } else if (result.dismiss === "cancel") {

                        }
                    });
                });
            });
        })

        //Card Control
        // This card is lazy initialized using data-card="true" attribute. You can access to the card object as shown below and override its behavior
        var card = new KTCard('filter_card');

        
    </script>
    <!--end::Page Scripts-->
@endpush