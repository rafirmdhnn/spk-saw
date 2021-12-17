@extends('layouts.base')
@section('content')
    <div class="container mt-5 text-center">
        <h1 class="title_alternatif">Alternatif Keseluruhan</h1>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Alternatif</th>
                <th scope="col">Nilai Kriteria</th>
                <th scope="col">Keterangan Kriteria</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($an as $index => $a)
                <tr>
                    <th scope="row">{{ $index + 1 }}</th>
                    <td>{{ $a->kriteria->alternatif_id }}</td>
                    <td>{{ $a->kriteriaNilai->kn_nilai }}</td>
                    <td>{{ $a->kriteriaNilai->kn_keterangan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @php
            #array nilai kriteria setiap alternatif sebelum normalisasi
            $matrix1 = [];
            $matrix2 = [];
            $matrix3 = [];
            $matrix4 = [];
            #array nilai kriteria setiap alternatif setelah normalisasi
            // $matrix_n1 = [];
            // $matrix_n2 = [];
            // $matrix_n3 = [];
            // $matrix_n4 = [];
            #array nilai perhitungan saw
            $saw_a1 = [];
            $saw_a2 = [];
            $saw_a3 = [];
            $saw_a4 = [];
            foreach ($an as $index => $a) {
                switch ($a) {
                    case ($a->kriteria->alternatif_id == 1):
                        $matrix1[] = $a->kriteriaNilai->kn_nilai;
                        $max_a1 = max($matrix1);
                        $tot_a1 = array_sum($matrix1);
                        $bobot_a1 = $a->kriteria->kriteria_bobot;
                        break;
                    case ($a->kriteria->alternatif_id == 2):
                        $matrix2[] = $a->kriteriaNilai->kn_nilai;
                        $max_a2 = max($matrix2);
                        $tot_a2 = array_sum($matrix2);
                        $bobot_a2 = $a->kriteria->kriteria_bobot;
                        break;
                    case ($a->kriteria->alternatif_id == 3):
                        $matrix3[] = $a->kriteriaNilai->kn_nilai;
                        $max_a3 = max($matrix3);
                        $tot_a3 = array_sum($matrix3);
                        $bobot_a3 = $a->kriteria->kriteria_bobot;
                        break;
                    case ($a->kriteria->alternatif_id == 4):
                        $matrix4[] = $a->kriteriaNilai->kn_nilai;
                        $max_a4 = max($matrix4);
                        $tot_a4 = array_sum($matrix4);
                        $bobot_a4 = $a->kriteria->kriteria_bobot;
                        break;
                    default:
                        # code...
                        break;
                }
            }
        @endphp
        <h3 class="mt-5">Matrix sebelum normalisasi</h3>
        <hr>
        <table class="table table-bordered table-striped my-5">
            <thead>
              <tr>
                <th rowspan="2">A1</th>
                <th colspan="6" class="text-center">Kriteria</th>
              </tr>
              <tr>
                <th>C1</th>
                <th>C2</th>
                <th>C3</th>
                <th>C4</th>
                <th>C5</th>
                <th>C6</th>
             </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="col">Nilai Rating</th>
                    @foreach ($matrix1 as $mx1)
                        <td class="text-center">{{ $mx1 }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered table-striped my-5">
            <thead>
              <tr>
                <th rowspan="2">A2</th>
                <th colspan="7" class="text-center">Kriteria</th>
              </tr>
              <tr>
                <th>C7</th>
                <th>C8</th>
                <th>C9</th>
                <th>C10</th>
                <th>C11</th>
                <th>C12</th>
                <th>C13</th>
             </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="col">Nilai Rating</th>
                    @foreach ($matrix2 as $mx2)
                        <td class="text-center">{{ $mx2 }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered table-striped my-5">
            <thead>
              <tr>
                <th rowspan="2">A3</th>
                <th colspan="4" class="text-center">Kriteria</th>
              </tr>
              <tr>
                <th>C14</th>
                <th>C15</th>
                <th>C16</th>
                <th>C17</th>
             </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="col">Nilai Rating</th>
                    @foreach ($matrix3 as $mx3)
                        <td class="text-center">{{ $mx3 }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered table-striped my-5">
            <thead>
              <tr>
                <th rowspan="2">A4</th>
                <th colspan="4" class="text-center">Kriteria</th>
              </tr>
              <tr>
                <th>C18</th>
                <th>C19</th>
                <th>C20</th>
                <th>C21</th>
             </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="col">Nilai Rating</th>
                    @foreach ($matrix4 as $mx4)
                        <td class="text-center">{{ $mx4 }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
        <h3 class="mt-5">Matrix setelah normalisasi</h3>
        <hr>
        <table class="table table-bordered table-striped my-5">
            <thead>
              <tr>
                <th rowspan="2">A1</th>
                <th colspan="6" class="text-center">Kriteria</th>
              </tr>
              <tr>
                <th>C1</th>
                <th>C2</th>
                <th>C3</th>
                <th>C4</th>
                <th>C5</th>
                <th>C6</th>
             </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="col">Nilai Rating</th>
                    @foreach ($matrix1 as $mx1)
                        @php
                            $matrix_n1 = number_format($mx1/$max_a1, 2, '.', ',');
                            $saw_a1[] = number_format($matrix_n1*$bobot_a1, 2, '.', ',');
                        @endphp
                        <td class="text-center">{{ $matrix_n1 }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered table-striped my-5">
            <thead>
              <tr>
                <th rowspan="2">A2</th>
                <th colspan="7" class="text-center">Kriteria</th>
              </tr>
              <tr>
                <th>C7</th>
                <th>C8</th>
                <th>C9</th>
                <th>C10</th>
                <th>C11</th>
                <th>C12</th>
                <th>C13</th>
             </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="col">Nilai Rating</th>
                    @foreach ($matrix2 as $mx2)
                        @php
                            $matrix_n2 = number_format($mx2/$max_a2, 2, '.', ',');
                            $saw_a2[] = number_format($matrix_n2*$bobot_a2, 2, '.', ',');
                        @endphp
                        <td class="text-center">{{ $matrix_n2 }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered table-striped my-5">
            <thead>
              <tr>
                <th rowspan="2">A3</th>
                <th colspan="4" class="text-center">Kriteria</th>
              </tr>
              <tr>
                <th>C14</th>
                <th>C15</th>
                <th>C16</th>
                <th>C17</th>
             </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="col">Nilai Rating</th>
                    @foreach ($matrix3 as $mx3)
                        @php
                            $matrix_n3 = number_format($mx3/$max_a3, 2, '.', ',');
                            $saw_a3[] = number_format($matrix_n3*$bobot_a3, 2, '.', ',');
                        @endphp
                        <td class="text-center">{{ $matrix_n3 }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered table-striped my-5">
            <thead>
              <tr>
                <th rowspan="2">A4</th>
                <th colspan="4" class="text-center">Kriteria</th>
              </tr>
              <tr>
                <th>C18</th>
                <th>C19</th>
                <th>C20</th>
                <th>C21</th>
             </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="col">Nilai Rating</th>
                    @foreach ($matrix4 as $mx4)
                        @php
                            $matrix_n4 = number_format($mx4/$max_a4, 2, '.', ',');
                            $saw_a4[] = number_format($matrix_n4*$bobot_a4, 2, '.', ',');
                        @endphp
                        <td class="text-center">{{ $matrix_n4 }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
        <h3 class="mt-5">Hasil perhitungan SAW</h3>
        <hr>
        <table class="table table-bordered table-striped my-5">
            <thead>
                <tr>
                    <th scope="col">Alternatif</th>
                    <th scope="col">Nilai SAW</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Aspek Subjective</th>
                    <td>{{ number_format(array_sum($saw_a1), 2, '.', ',') }}</td>
                </tr>
                <tr>
                    <th>Aspek Neurophysiology</th>
                    <td>{{ number_format(array_sum($saw_a2), 2, '.', ',') }}</td>
                </tr>
                <tr>
                    <th>Aspek Autonomic</th>
                    <td>{{ number_format(array_sum($saw_a3), 2, '.', ',') }}</td>
                </tr>
                <tr>
                    <th>Aspek Panic Related</th>
                    <td>{{ number_format(array_sum($saw_a4), 2, '.', ',') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection