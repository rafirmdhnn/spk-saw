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
