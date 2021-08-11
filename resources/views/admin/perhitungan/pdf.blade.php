<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan - Hasil Analisa Perhitungan SAW</title>
   <style>
       .text-center{
           text-align: center;
       }
       @page { margin: 140px 0px 0px 0px; }

       /* @page {
            margin: 0px;
        } */
        body {
            margin: 0px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: x-small;
        }
        table.pembelian {
            border: 1px solid #000;
            border-collapse: collapse;
        }

        table.invoice {
            padding-top:20px;
        }

        .attendance-cell{
            padding: 8px;
        }

        table.pembelian th.attendance-cell, td.attendance-cell {
            border: 1px solid #000;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        table.pengirim > tr > th {
            border: 1px solid black;
        }

        .invoice table {
            margin: 15px;
        }
        .invoice h3 {
            margin-left: 15px;
        }

        .information {
            position: fixed; 
            bottom: 40px; 
            display: block;
            background-color: #e21a25;
            color: #FFF;
        }

        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 10px;
        }
        .header {
            position: fixed;
            top:-150px;
        }
        .body {
            margin-bottom:30px;
        }
   </style>
</head>
<body>
    <div class="header">
        <table width="100%">
            <tr>
                <td align="left" style="width:50%;position: relative;padding-right:120px;">
                    <div style="margin-left:40px">
                        <img style="padding-top: 15px;" src="{{public_path('assets/logo.png')}}" alt="Logo" width="80" class="logo"/>    
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="information" >
        <table width="100%">
            <tr>
                <td align="left" style="width: 50%;">
                    &copy; {{ date('Y') }}  - All rights reserved.
                </td>
                <td align="right" style="width: 50%;">
                    Sistem Pendukung Keputusan Pemilihan Smartphone
                </td>
            </tr>
        </table>
    </div>
    <div class="body" style="padding-left:60px;padding-right:60px;padding-top:0px;">
            <h4 style="text-align:center;">Hasil Analisa</h4>
            <div style="border: 1px solid #000;padding-bottom:5px;"></div>
                <table border="1" style="width: 100%;border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th>Kode Alternatif</th>
                            <th>Nama Alternatif</th>
                            @foreach ($kriterias as $kriteria)
                                <th>{{$kriteria->kriteria_nama}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alternatif_nilais as $alternatif_nilai)
                        <tr>
                            <td>
                                <?=$alternatif_nilai->kode_alternatif?>
                            </td>
                            <td>
                                <?=$alternatif_nilai->nama_alternatif?>
                            </td>
                            <?php 
                                $queries = App\Models\AlternatifNilai::
                                leftJoin('kriteria_nilais', 'kriteria_nilais.id','=','alternatif_nilais.nilai_kriteria_id')
                                ->where('alternatif_id', $alternatif_nilai->kode_alternatif)
                                ->orderBy('kriteria_nilais.kriteria_id','ASC')
                                ->get();
                            ?>
                                @foreach ($queries as $dt)
                                    <td>
                                        {{$dt->kn_keterangan}}
                                    </td>
                                @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <table border="1" style="width: 100%;border-collapse: collapse;padding-top:10px;padding-bottom:10px;">
                    <thead>
                        <tr>
                        <th>Kode Alternatif</th>
                        <th>Nama Alternatif</th>
                        @foreach ($kriterias as $kriteria)
                            <th>{{$kriteria->kriteria_nama}}</th>
                        @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alternatif_nilais as $alternatif_nilai)
                        <tr>
                            <td>
                                <?=$alternatif_nilai->kode_alternatif?>
                            </td>
                            <td>
                                <?=$alternatif_nilai->nama_alternatif?>
                            </td>
                            <?php 
                                $queries = App\Models\AlternatifNilai::
                                leftJoin('kriteria_nilais', 'kriteria_nilais.id','=','alternatif_nilais.nilai_kriteria_id')
                                ->where('alternatif_id', $alternatif_nilai->kode_alternatif)
                                ->orderBy('kriteria_nilais.kriteria_id','ASC')
                                ->get();
                            ?>
                                @foreach ($queries as $dt)
                                    <td>
                                        {{$dt->kn_nilai}}
                                    </td>
                                @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <h4 style="text-align:center;padding-top:5px;">Normalisasi</h4>
            <div style="border: 1px solid #000;padding-bottom:5px;"></div>
            <table border="1" style="width: 100%;border-collapse: collapse;">
                <thead>
                    <tr>
                        <th>Kode Alternatif</th>
                        <th>Nama Alternatif</th>
                        <?php $bobot = [] ?>
                        @foreach ($kriterias as $kriteria)
                            <?php $bobot[$kriteria->id] = $kriteria->kriteria_bobot ?>
                            <th>{{$kriteria->kriteria_nama}}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($alternatif))
                        <?php $rangking = []; ?>
                        @foreach($alternatif as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>{{$data->alternatif_nama}}</td>
                                <?php $total = 0;?>
                                @foreach($data->crip as $crip)
                                    @if($crip->kriteria->kriteria_atribut == 'cost') 
                                        <?php $normalisasi = ($kode_krit[$crip->kriteria->id]/$crip->kn_nilai); ?>
                                    @elseif($crip->kriteria->kriteria_atribut == 'benefit')
                                        <?php $normalisasi = ($crip->kn_nilai/$kode_krit[$crip->kriteria->id]); ?>
                                    @endif
                                        <?php 
                                        $total = $total+($bobot[$crip->kriteria->id]*$normalisasi);
                                        // $total = $total+($crip->kriteria->id*$normalisasi);
                                        ?>
                                        <td>{{round($normalisasi, 2)}}</td> 
                                @endforeach
                                <?php $rangking[] = [
                                    'kode'  => $data->id,
                                    'photo'  => $data->alternatif_image,
                                    'nama'  => $data->alternatif_nama,
                                    'harga'  => $data->alternatif_harga,
                                    'ukuran_layar'  => $data->alternatif_ukuran_layar,
                                    'ram'  => $data->alternatif_ram,
                                    'baterai'  => $data->alternatif_baterai,
                                    'memory'  => $data->alternatif_storage,
                                    'kamera'  => $data->alternatif_kamera,
                                    'total' => $total
                                ]; ?>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="{{(count($kriteria)+1)}}" class="text-center">Data tidak ditemukan</td>
                        </tr>
                    @endif
                </tbody>
            </table>   
            <h4 style="text-align:center;padding-top:5px;">Perhitungan</h4>
        <div style="border: 1px solid #000;padding-bottom:5px;"></div>
            <table border="1" style="width: 100%;border-collapse: collapse;">
                <thead>
                    <tr>
                        <th>Kode Alternatif</th>
                        <th>Foto Alternatif</th>
                        <th>Nama Alternatif</th>
                        <th>Total</th>
                        <th>Ranking</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $rangking = collect($rangking)->sortBy('total')->reverse()->toArray();
                $a = 1;
                ?>
                    @foreach($rangking as $t)
                        <tr>
                            <td>{{$t['kode']}}</td>
                            <td>
                                <a class='example-image-link' data-lightbox='example-1' data-fancybox-group='gallery'  href="{{$t['photo']}}" ><img src="{{$t['photo']}}" height="50"></a>
                            </td>
                            <td>
                                <h4>{{$t['nama']}}</h4> <br/>
                                <b>Harga : </b> {{$t['harga']}}<br/>
                                <b>Ukuran Layar : </b> {{$t['ukuran_layar']}}<br/>
                                <b>RAM :</b> {{$t['ram']}}<br/>
                                <b>DAYA BATERAI :</b> {{$t['baterai']}}<br/>
                                <b>KAPASISTAS MEMORY INTERNAL :</b> {{$t['memory']}}<br/>
                                <b>KAMERA :</b> {{$t['kamera']}}
                            </td>
                            <td>{{round($t['total'], 2)}}</td>
                            <td>{{$a++}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table> 
            </div>
            
    </div>
</div>
</body>
</html>