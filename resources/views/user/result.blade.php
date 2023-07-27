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
                    @if( $empty_saw == true )
                    Berdasarkan analisa hasil anda, tidak ada gejala ataupun gangguan kecemasan yang anda alami
                    @else
                    Berdasarkan analisa hasil anda, jenis gejala dari gangguan kecemasan yang paling dominan anda rasakan adalah aspek gejala 
                        @foreach ($best_saw as $key => $value)
                            @if (isset($saw_val[$key]['text']))
                                    <b>{{ $key }}</b> {{ $saw_val[$key]['text'] }}.
                            @endif
                        @endforeach
                    @endif 
                    @php
                        $faktor_lain_arr = [
                            'kualitas_tidur' => 'kualitas tidur',
                            'pola_makan' => 'kualitas asupan',
                            'rutinitas_olahraga' => 'berolahraga'
                        ];
                    
                        $selected_factors = [];
                    
                        foreach ($faktor_lain_arr as $factor_key => $factor_text) {
                            if ($faktor_lain[$factor_key] == 'kurang') {
                                $selected_factors[] = $factor_text;
                            }
                        }
                    
                        $message = implode(' & ', $selected_factors);
                    @endphp

                    @if (!empty($message))
                        Kurangnya {{ $message }} sangat memungkinkan untuk memicu gangguan kecemasan yang Anda rasakan karena berdampak pada kondisi tubuh Anda.
                    @endif 
                    Untuk diagnosa lebih mendalam silahkan anda mendatangi dokter/psikolog.
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
                        @foreach ($saw_val as $key => $data)
                            <tr>
                                <td @if ($data['value'] == $max_value['value']) class="text-success font-weight-bold" @endif>{{ $key }}</td>
                                <td @if ($data['value'] == $max_value['value']) class="text-success font-weight-bold" @endif>{{ $data['value'] }}</td>
                            </tr>
                        @endforeach
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