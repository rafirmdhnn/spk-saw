@extends('layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Nilai Kriteria</h5>
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item">
            <a href="{{route('kriteria-nilai.index')}}">Daftar Nilai Kriteria</a>
        </li>
        <li class="breadcrumb-item">
            <a href="#" class="text-muted">Tambah Nilai Kriteria</a>
        </li>
    </ul>
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
                    <h3 class="card-label">Tambah Nilai Kriteria</h3>
                </div>
            </div>
            <form action="{{ route('kriteria-nilai.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="card-body">
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
                        <label class="col-lg-3 col-form-label">Atribut Kriteria
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <select type="text" class="form-control select2" name="kriteria_id">
                                <option value="">-- Pilih Kriteria --</option>
                                @foreach ($kriterias as $item)
                                    <option {{old('kriteria_id', $item->id)}} value="{{$item->id}}">{{$item->id}}. {{$item->kriteria_nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Keterangan
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Masukkan Nama Kriteria" value="{{ old('kn_keterangan') }}" name="kn_keterangan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Nilai
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" onkeypress="return isNumber(event)"  placeholder="Masukkan Bobot Kriteria" value="{{ old('kn_nilai') }}" name="kn_nilai">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{route('kriteria-nilai.index')}}" class="btn btn-default float-left">Cancel</a>
                <button type="submit" class="btn btn-primary float-right mb-4">Tambah</button>
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
    <!--end::Page Vendors Styles-->
@endpush
@push('js')

    <!--begin::Page Vendors(used by this page)-->
    <script src="{{asset('assets')}}/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <!--begin::Page Scripts(used by this page)-->
    
    <!--end::Page Vendors-->

    <!--end::Page Scripts-->
    <script>
        $(".datepicker").datepicker({
            format: "dd-mm-yyyy",
            autoclose: true,
        });
    </script>
@endpush