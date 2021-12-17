@extends('layouts.base')
@section('content')
    <div class=" container text-left mt-5">
        <div class="col-md-12">
            <div class="wrapper-body">
                @php
                    $total = 0;
                    foreach ($score as $s) {
                        $total += $s->kriteriaNilai->kn_nilai;
                    }
                @endphp
                <p class="font-weight-bold">Hasil Score : {{$total}}</p>
                @if($total >= 0 && $total <= 21)
                    <p class="text-dark">
                        Tingkat Kecemasan Rendah (Low Anxiety)
                    </p>  
                    <p class="text-dark">Anda jarang merasa cemas atau khawatir. Akan tetapi bisa jadi Anda belum menyadari gejala atau menutup diri dari gejala yang Anda rasakan. Terlalu rendah tingkat kecemasan juga dapat menunjukkan bahwa Anda kurang peduli atas diri sendiri, orang lain, atau lingkungan Anda.</p>
                @elseif($total >= 22 && $total <= 35) 
                    <p class="text-dark">
                        Tingkat Kecemasan Sedang (Moderate Anxiety)
                    </p>  
                    <p class="text-dark">Tampaknya Anda mengalami kecemasan secara teratur. Perhatikan pola kapan dan mengapa Anda mengalami gejalanya. Misalnya, jika itu terjadi sebelum berbicara di depan umum atau pekerjaan Anda membutuhkan banyak presentasi, Anda mungkin akan menemukan cara untuk menenangkan diri Anda sendiri sebelum berbicara atau biarkan orang lain melakukan beberapa presentasi. Anda mungkin memiliki beberapa masalah konflik yang perlu diselesaikan. Anda mungkin bisa berkonsultasi dengan spesialis jika gejala terus berlanjut.</p>
                @elseif($total >= 36 && $total <= 63) 
                    <p class="text-dark">
                        Tingkat Kecemasan Berat (Severe Anxiety). 
                    </p>  
                    <p class="text-dark">Anda sering dan mudah sekali cemas. Perhatikan pola atau waktu ketika Anda cenderung merasakan gejalanya. Kecemasan yang terus-menerus dan tinggi bukanlah tanda kelemahan pribadi atau kegagalan. Namun, itu adalah sesuatu yang perlu ditangani secara proaktif atau mungkin ada dampak signifikan terhadap Anda secara mental dan fisik. Anda mungkin bisa berkonsultasi dengan spesialis jika gejala terus berlanjut.</p>
                @endif
                <div class="row d-flex justify-content-center">
                    <a class="btn btn-primary btn-custom" href="{{route('detail', $user_id)}}" target="_blank">Lihat Detail</a>
                </div>
                <div class="row d-flex justify-content-center mt-3">
                    <a class="btn btn-primary btn-custom" href="{{ route('index') }}">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
    