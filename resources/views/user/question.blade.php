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
    