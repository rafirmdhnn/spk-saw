@extends('layouts.app')

@section('content')
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">	
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-body">
                 <h1>Selamat Datang, {{Auth::user()->name}}</h1>
            </div>
            <div class="row mx-5">
                <div class="col-lg-12 col-sm-6 col-md-3 mb-5">   
                    <div class="card shadow-sm rounded-lg text-black bg-green-2">
                        <div class="card-body">
                            <h5 class="card-title text-wrap">Total Responden</h5>
                            <h1 class="card-text text-left text-wrap font-weight-bold">{{ $count_user }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mx-5">
                <div class="col-lg-6 col-sm-4 col-md-3 mb-5">   
                    <div class="card shadow-sm rounded-lg text-black bg-green-2">
                        <div class="card-body">
                            <h5 class="card-title text-wrap">Gejala Subjective</h5>
                            <h1 class="card-text text-left text-wrap font-weight-bold">{{ $count_subjective }} Responden</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-4 col-md-3 mb-3">   
                    <div class="card shadow-sm rounded-lg text-black bg-green-2">
                        <div class="card-body">
                            <h5 class="card-title text-wrap">Gejala Neurophysiology</h5>
                            <h1 class="card-text text-left text-wrap font-weight-bold">{{ $count_neurophysiology }} Responden</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mx-5 mt-2">
                <div class="col-lg-6 col-sm-4 col-md-3 mb-5">   
                    <div class="card shadow-sm rounded-lg text-black bg-green-2">
                        <div class="card-body">
                            <h5 class="card-title text-wrap">Gejala Autonomic</h5>
                            <h1 class="card-text text-left text-wrap font-weight-bold">{{ $count_autonomic }} Responden</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-4 col-md-3 mb-3">   
                    <div class="card shadow-sm rounded-lg text-black bg-green-2">
                        <div class="card-body">
                            <h5 class="card-title text-wrap">Gejala Panic Related</h5>
                            <h1 class="card-text text-left text-wrap font-weight-bold">{{ $count_panic }} Responden</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!--end::Card-->
         
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->

@endsection
@push('js')
 <!--begin::Page Scripts(used by this page)-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.2/chart.min.js"></script>
<!--end::Page Scripts-->
<script>
    function convertDateDBtoIndo($string){
        $bulanIndo = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September' , 'Oktober', 'November', 'Desember'];
        return $bulanIndo[$string];
    }
</script>   
@endpush
