@extends('layouts.app')
@section('title')
<a href="{{route('alternatif-nilai.index')}}">
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Daftar Nilai Alternatif</h5>
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
                    <h3 class="card-label">Daftar Nilai Alternatif</h3>
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
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable" id="lks_datatable">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Umur</th>
                        @foreach ($kriterias as $kriteria)
                        <th>
                            {{$kriteria->kriteria_nama}}
                        </th>
                        @endforeach
                        {{-- @if(Auth::user()->is_role == 1)
                        <th width="170px">Aksi</th>
                        @endif --}}
                    </tr>
                    </thead>
                    <tbody>
                        @php($i=1)
                        @foreach ($rows as $value)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>
                                <?=$value->nama?>
                            </td>
                            <td>
                                <?=$value->umur?>
                            </td>
                            <?php 
                                $queries = App\Models\AlternatifNilai::
                                leftJoin('kriteria_nilais', 'kriteria_nilais.id','=','alternatif_nilais.nilai_kriteria_id')
                                ->where('user_id', $value->id)
                                ->orderBy('kriteria_nilais.kriteria_id','ASC')
                                ->get();
                            ?>
                                @foreach ($queries as $dt)
                                    <td>
                                        {{$dt->kn_keterangan}}
                                    </td>
                                @endforeach
                            {{-- @if(Auth::user()->is_role == 1)
                            <td>
                               <div class="d-flex">
                                    <div class="mr-1">
                                        <a href={{route('alternatif-nilai.edit', $value->kode_alternatif)}} class="btn btn-sm btn-primary"> <i class="fa fa-pencil-alt"></i> Ubah</a>
                                    </div>
                                <div>
                            </td>
                            @endif --}}
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