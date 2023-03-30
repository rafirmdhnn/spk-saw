@extends('layouts.base')
@section('content')
    <div class=" container text-left mt-5">
        <div class="col-md-12">
            <div class="wrapper-body">
                <p class="font-weight-bold">Hasil BAI Score : {{$hasil_bai->total_score}}</p>
                <p class="text-dark font-weight-bold">
                    {{ $hasil_bai->level_bai }} 
                </p>  
                <p class="text-dark text-justify">
                    {{ $hasil_bai->detail_bai }}
                </p>
                <p class="mt-4 text-dark text-justify">
                    Berdasarkan analisa hasil anda, jenis gejala dari gangguan kecemasan yang paling dominan anda rasakan adalah aspek gejala 
                    <b>{{ $detail_saw }}</b>. Untuk diagnosa lebih mendalam silahkan anda mendatangi dokter/psikolog.
                </p>
                <h5 class="mt-4">Berikut hasil perhitungan aspek gejala menggunakan metode Simple Additive Weighting (SAW)</h5>
                {{-- Begin: Table for SAW Result --}}
                <table class="table table-bordered table-striped my-3">
                    <thead>
                        <tr>
                          <th scope="col">Aspek Gejala</th>
                            <th scope="col">Nilai</th>
                        </tr>
                      </thead>
                    <tbody>
                        <tr>
                            @if (( $saw_val['Subjective'] > $saw_val['Panic Related']) && ( $saw_val['Subjective'] > $saw_val['Autonomic']) && ( $saw_val['Subjective'] >  $saw_val['Neurophysiology']))
                                <td class="text-success font-weight-bold">Aspek Subjective</td>
                                <td class="text-success font-weight-bold"> {{ $saw_val['Subjective'] }}</td>
                            @else
                                <td>Aspek Subjective</td>
                                <td> {{ $saw_val['Subjective'] }}</td>
                            @endif
                        </tr>
                        <tr>
                            @if (( $saw_val['Neurophysiology'] >  $saw_val['Panic Related']) && ( $saw_val['Neurophysiology'] > $saw_val['Subjective']) && ( $saw_val['Neurophysiology'] >  $saw_val['Autonomic']))
                            <td class="text-success font-weight-bold">Aspek Neurophysiology</td>
                            <td class="text-success font-weight-bold"> {{ $saw_val['Neurophysiology'] }}</td>
                            @else
                                <td>Aspek Neurophysiology</td>
                                <td> {{ $saw_val['Neurophysiology'] }}</td>
                            @endif
                        </tr>
                        <tr>
                            @if (( $saw_val['Autonomic'] >  $saw_val['Panic Related']) && ( $saw_val['Autonomic'] > $saw_val['Subjective']) && ( $saw_val['Autonomic'] >  $saw_val['Neurophysiology']))
                                <td class="text-success font-weight-bold">Aspek Autonomic</td>
                                <td class="text-success font-weight-bold"> {{ $saw_val['Autonomic'] }}</td>
                            @else
                                <td>Aspek Autonomic</td>
                                <td> {{ $saw_val['Autonomic'] }}</td>
                            @endif
                        </tr>
                        <tr>
                            @if (( $saw_val['Panic Related'] >  $saw_val['Autonomic']) && ( $saw_val['Panic Related'] >  $saw_val['Subjective']) && ( $saw_val['Panic Related'] >  $saw_val['Neurophysiology']))
                                <td class="text-success font-weight-bold">Aspek Panic Related</td>
                                <td class="text-success font-weight-bold"> {{ $saw_val['Panic Related'] }}</td>
                            @else
                                <td>Aspek Panic Related</td>
                                <td> {{ $saw_val['Panic Related'] }}</td>
                            @endif
                        </tr>
                      </tbody>
                </table>
                {{-- End: Table SAW Result --}}
                <div class="row d-flex justify-content-center mt-5">
                    <a class="btn btn-primary btn-custom" href="{{ route('index') }}">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
    