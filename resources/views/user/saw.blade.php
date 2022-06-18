@extends('layouts.base')
@section('content')
<div class=" container text-left mt-5">
    <div class="col-md-12">
        <div class="wrapper-body">
            <p class="text-dark">Berdasarkan analisa hasil anda, jenis gejala dari gangguan kecemasan yang
              paling dominan anda rasakan adalah aspek gejala:</p>
                @foreach ($saw['detail_saw'] as $ds)
                    <h1 class="mt-5 mb-5 text-center">{{ $ds }}</h1>
                    @switch($ds)
                        @case($ds == "Autonomic")
                            <p class="text-dark mt-5 text-center"> Lorem ipsum dolor sir amat</p>
                            @break
                        @case($ds == "Subjective")
                            <p class="text-dark mt-5 text-center"> Lorem ipsum dolor sir amat2</p>
                            @break
                        @case($ds == "Panic Related")
                            <p class="text-dark mt-5 text-center"> Lorem ipsum dolor sir amat3</p>
                            @break
                        @case($ds == "Neuropology")
                            <p class="text-dark mt-5 text-center"> Lorem ipsum dolor sir amat4</p>
                            @break
                        @default
                    @endswitch
                    
                @endforeach
        </div>
        <div class="row d-flex justify-content-center mt-5">
            <a class="btn btn-primary btn-custom" href="{{ route('index') }}">Kembali</a>
        </div>
    </div>
</div>        
@endsection