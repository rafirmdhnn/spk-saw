@extends('layouts.base')
@section('content')
    <div class=" container mt-5">
        <div class="col-md-12">
            <div class="wrapper-content">
                <form action="{{ route('question.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
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
                    {{-- disclaimer --}}
                    <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                        <strong>Reminder</strong> Alat ini hanya tolak ukur awal saja untuk meningkatkan awareness pengguna akan kadar gangguan kecemasan yang anda rasakan, disarankan setelah ini untuk menemui psikolog untuk mendapatkan hasil diagnosa yang lebih mendalam
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{old('nama')}}" placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="text" class="form-control" id="email" name="email"  value="{{old('email')}}" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="umur">Umur</label>
                        <input type="text" class="form-control" id="umur" name="umur"  value="{{old('umur')}}" maxlength="2" placeholder="Umur">
                    </div>
                    <div class="form-group">
                        <label for="kualitas_tidur">Bagaimana kualitas tidur anda akhir-akhir ini?</label>
                        <div class="form-check">
                            <input type="radio" id="tidur_baik" name="kualitas_tidur" value="baik">
                            <label for="tidur_baik">Merasa cukup baik</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" id="tidur_kurang" name="kualitas_tidur" value="kurang">
                            <label for="tidur_kurang">Merasa kurang baik</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pola_makan">Bagaimana asupan makanan anda akhir-akhir ini?</label>
                        <div class="form-check">
                            <input type="radio" id="makan_baik" name="pola_makan" value="baik">
                            <label for="makan_baik">Cukup berimbang gizi dan porsinya</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" id="makan_kurang" name="pola_makan" value="kurang">
                            <label for="makan_kurang">Kurang berimbang dari segi gizi dan porsi</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="rutinitas_olahraga">Bagaimana kegiatan olahraga anda akhir-akhir ini?</label>
                        <div class="form-check">
                            <input type="radio" id="olahraga_baik" name="rutinitas_olahraga" value="baik">
                            <label for="olahraga_baik">Selalu menyempatkan ditiap minggu</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" id="olahraga_kurang" name="rutinitas_olahraga" value="kurang">
                            <label for="olahraga_kurang">Tidak sama sekali dan jarang</label>
                        </div>
                    </div>
                    @php($i= 1)
                    @php($ii= 1)
                    @foreach ($questions as $qs)
                    <input type="hidden" name="questions[]" value="{{$qs->id}}">
                        <div class="form-group">
                        <label for="inputAddress" class="font-weight-bold">{{$i++}}. {{$qs->kriteria_nama}}</label>
                            @foreach ($qs->nilai_gejala as $item)
                                <div class="form-group">
                                    <input type="hidden" name="nilai[]" value="{{$item->nilai_gejala}}">
                                    <input type="radio" required id="customRadio-{{$item->pivot->kriteria_id}}" name="answers[{{$item->pivot->kriteria_id}}]" value="{{old('answers'.$item->pivot->kriteria_id, $item->pivot->kn_gejala_id)}}">
                                    <label class="custom-control-label" for="customRadio-{{$item->pivot->kriteria_id}}">{{$item->keterangan_gejala}}</label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
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
                    <button type="submit" class="btn btn-primary">Selesai</button>
                </form>
            </div>
        </div>
    </div>
@endsection
    