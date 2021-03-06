@extends('layouts.app')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Ubah Kriteria</h5>

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
                    <h3 class="card-label">Ubah Kriteria</h3>
                </div>
            </div>
            <form action="{{ route('kriteria.update', $kriteria->id) }}" method="POST" enctype="multipart/form-data">
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
                    @if(Auth::user()->is_role == 1)
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Nama Kriteria
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" placeholder="Masukkan Nama Kriteria" value="{{ old('kriteria_nama', $kriteria->kriteria_nama) }}" name="kriteria_nama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Atribut Kriteria
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <select type="text" class="form-control" placeholder="Masukkan Atribut Kriteria" name="kriteria_atribut">
                                <option value="">-- Pilih Atribute --</option>
                                <option {{old('kriteria_atribut', $kriteria->kriteria_atribut) == 'benefit' ? 'selected' : ''}} value="benefit">Benefit</option>
                                <option {{old('kriteria_atribut', $kriteria->kriteria_atribut) == 'cost' ? 'selected' : ''}} value="cost">Cost</option>
                            </select>
                        </div>
                    </div>
                    @endif
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Bobot Kriteria
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" onkeypress="return isNumber(event)"  placeholder="Masukkan Bobot Kriteria" value="{{ old('kriteria_bobot', $kriteria->kriteria_bobot) }}" name="kriteria_bobot">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{route('kriteria.index')}}" class="btn btn-default float-left">Cancel</a>
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