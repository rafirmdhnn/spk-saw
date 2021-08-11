@extends('layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Ubah Alternatif</h5>
    
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
                    <h3 class="card-label">Ubah Alternatif</h3>
                </div>
            </div>
            <form action="{{ route('alternatif.update', $alternatif->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <div class="card-body">
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Error!</strong> Ada beberapa masalah dengan masukan Anda.<br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="mb-15">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Nama Alternatif
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Masukkan Nama Alternatif" value="{{ old('alternatif_nama', $alternatif->alternatif_nama) }}" name="alternatif_nama">
                        </div>
                    </div>
                </div>
                <div class="mb-15">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Harga
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Masukkan Harga" value="{{ old('alternatif_harga', $alternatif->alternatif_harga) }}" name="alternatif_harga">
                        </div>
                    </div>
                </div>
                <div class="mb-15">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Kamera
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Masukkan Kamera" value="{{ old('alternatif_kamera', $alternatif->alternatif_kamera) }}" name="alternatif_kamera">
                        </div>
                    </div>
                </div>
                <div class="mb-15">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Kapasistas Memory Internal
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Masukkan Kapasistas Memory Internal" value="{{ old('alternatif_storage', $alternatif->alternatif_storage) }}" name="alternatif_storage">
                        </div>
                    </div>
                </div>
                <div class="mb-15">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Daya Baterai
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Masukkan Daya Baterai" value="{{ old('alternatif_baterai', $alternatif->alternatif_baterai) }}" name="alternatif_baterai">
                        </div>
                    </div>
                </div>
                <div class="mb-15">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">RAM
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Masukkan RAM" value="{{ old('alternatif_ram', $alternatif->alternatif_ram) }}" name="alternatif_ram">
                        </div>
                    </div>
                </div>
                <div class="mb-15">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Ukuran Layar
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Masukkan Ukuran Layar" value="{{ old('alternatif_ukuran_layar', $alternatif->alternatif_ukuran_layar) }}" name="alternatif_ukuran_layar">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{route('alternatif.index')}}" class="btn btn-default float-left">Cancel</a>
                <button type="submit" class="btn btn-primary float-right mb-4">Ubah</button>
            </div>
            </form>
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
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link href="{{asset('assets/js/lightbox/css/lightbox.min.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->
@endpush
@push('js')

    <!--begin::Page Vendors(used by this page)-->
    <script src="{{asset('assets')}}/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <!--begin::Page Scripts(used by this page)-->
    
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script type="text/javascript" src="{{asset('assets/js/lightbox/js/lightbox.min.js')}}"></script>
    <script>
        var currentDate = new Date();  
        $(".datepicker").datepicker({
            format: "dd-mm-yyyy",
            autoclose: true,
            
        });

        
    </script>
    <!--end::Page Scripts-->
    <!--end::Page Scripts-->
@endpush