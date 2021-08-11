@extends('layouts.app')
@section('title')
    <a href="{{route('alternatif.index')}}">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Daftar Nilai Kriteria</h5>
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
                    <h3 class="card-label">Daftar Nilai Kriteria</h3>
                </div>
                <div class="card-toolbar">
                    
                    <!--begin::Button-->
                    <div class="form-group row pull-right">
                        @if(Auth::user()->is_role == 1)
                        <a href="{{route('kriteria-nilai.create')}}" class="btn btn-primary font-weight-bolder">
                        <span class="svg-icon svg-icon-md">
                            <span class="fa fa-plus"></span>
                        </span>Tambah</a>
                        @endif
                    </div>
                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                @endif
                <div class="form-check-inline mb-10">
                    <label class="col-form-label">Pilih Kriteria
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <select name="nilai_kriteria_id" id="nilai_kriteria_id" class="form-control">
                            <option value="">-- Pilih Kriteria --</option>
                            @foreach ($kriterias as $kriteria)
                                <option {{old('kriteria_id', $kriteria->id) == @$_GET['kriteria_id'] ? 'selected' : ''}} value="{{$kriteria->id}}">{{$kriteria->id}} - {{$kriteria->kriteria_nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-danger font-weight-bolder filter-nilaikritera">
                        <span class="svg-icon svg-icon-md">
                            <span class="fa fa-plus"></span>
                        </span>FILTER
                    </button>
                </div>
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable" id="lks_datatable">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Kriteria</th>
                        <th>Keterangan</th>
                        <th>Nilai</th>
                        @if(Auth::user()->is_role == 1)
                        <th width="170px">Aksi</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                        @php($i=1)
                        @foreach ($nilais as $nilai)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>
                                    {{$nilai->kriteria->kriteria_nama}}
                                </td>
                                <td>
                                    {{$nilai->kn_keterangan}}
                                </td>
                                <td>
                                    {{$nilai->kn_nilai}}
                                </td>
                                @if(Auth::user()->is_role == 1)
                                <td>
                                    <div class="d-flex">
                                        <div class="mr-1">
                                            <a href={{route('kriteria-nilai.edit', $nilai->id)}} class="btn btn-sm btn-primary"> <i class="fa fa-pencil-alt"></i> Ubah</a>
                                        </div>
                                    <div>
                                </td>
                                @endif
                            </tr>
                        @endforeach
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
            $('.filter-nilaikritera').click(function(){
                let id = $('#nilai_kriteria_id').val();

                window.location = '{{route('kriteria-nilai.index')}}?kriteria_id='+id;
            });
            
            $('body').on('click', '.btnDelete', function (e) {
                e.preventDefault();
                var form = $(this).parent();
                Swal.fire({
                    title: "Anda Yakin?",
                    text: "Ingin hapus data Alternatif ?",
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
    </script>
    <!--end::Page Scripts-->
@endpush