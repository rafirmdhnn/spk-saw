@extends('layouts.base')
@section('content')
<div class=" container text-left mt-5">
    <div class="col-md-12">
        <div class="wrapper-body">
            <p class="text-dark">Berdasarkan analisa hasil anda, jenis gejala dari gangguan kecemasan yang
              paling dominan anda rasakan adalah aspek gejala:</p>
                @foreach ($saw['detail_saw'] as $ds)
                    <h1 class="mt-5 mb-5 text-center">{{ $ds }}</h1>
                @endforeach
        </div>
        <div class="row d-flex justify-content-center mt-5">
            <a class="btn btn-primary btn-custom" href="{{ route('index') }}">Kembali</a>
        </div>
    </div>
</div>        
@endsection