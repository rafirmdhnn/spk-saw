@extends('layouts.app')
@section('title')
<a href="{{route('perhitungan.index')}}">
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Perhitungan SAW</h5>
</a>
@endsection
@section('content')
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">	
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header flex-wrap pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Hasil Analisa</h3>
                </div>
                <div class="card-toolbar">
                  
                        <div class="form-group row pull-right">
                            <a target="_blank" href="{{route('perhitungan.pdf')}}" class="btn btn-danger font-weight-bolder">
                                <span class="svg-icon svg-icon-md">
                                    <span class="fa fa-plus"></span>
                                </span>EXPORT PDF</a>
                        </div>
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable" id="lks_datatable">
                    <thead>
                        <th>Nama Lengkap</th>
                        <th>Umur</th>
                        @foreach ($kriterias as $kriteria)
                            <th>{{$kriteria->kriteria_nama}}</th>
                        @endforeach
                    </thead>
                    <tbody>
                        @foreach ($alternatif_nilais as $alternatif_nilai)
                        <tr>
                            <td>
                                <?=$alternatif_nilai->nama?>
                            </td>
                            <td>
                                <?=$alternatif_nilai->umur?>
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
                <!--end: Datatable-->
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable" id="lks_datatable">
                    <thead>
                        <th>Nama Lengkap</th>
                        <th>Umur</th>
                        @foreach ($kriterias as $kriteria)
                            <th>{{$kriteria->kriteria_nama}}</th>
                        @endforeach
                    </thead>
                    <tbody>
                        @foreach ($alternatif_nilais as $alternatif_nilai)
                        <tr>
                            <td>
                                <?=$alternatif_nilai->nama?>
                            </td>
                            <td>
                                <?=$alternatif_nilai->umur?>
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
                <!--end: Datatable-->
            </div>
        </div>
        <!--end::Card-->
         <!--begin::Card-->
         <div class="card card-custom mt-5">
            <div class="card-header flex-wrap pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Normalisasi</h3>
                </div>
                <div class="card-toolbar">
                </div>
            </div>
            <div class="card-body">
                <table class="table table-separate table-head-custom table-checkable">
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
            </div>
        </div>
        <!--end::Card-->
           <!--begin::Card-->
           <div class="card card-custom mt-5">
            <div class="card-header flex-wrap pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Perhitungan</h3>
                </div>
                <div class="card-toolbar">
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable" id="lks_datatable">
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
                                    <a class='example-image-link' data-lightbox='example-1' data-fancybox-group='gallery'  href="{{$t['photo']}}" ><img src="{{$t['photo']}}" height="150"></a>
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
                <!--end: Datatable-->
            </div>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->
@endsection

@push('css')
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{asset('assets')}}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->
    <link href="{{asset('assets/js/lightbox/css/lightbox.min.css')}}" rel="stylesheet" type="text/css" />
   

    <style>
        #filter_card .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1rem;
        }

        .select2 {
            width: 100% !important; /* overrides computed width, 100px in your demo */
        }
    </style>
@endpush
@push('js')
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{asset('assets')}}/plugins/custom/datatables/datatables.bundle.js"></script>
   
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
   
    <script type="text/javascript" src="{{asset('assets/js/lightbox/js/lightbox.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.filter-nilaikritera').click(function(){
                let id = $('#nilai_kriteria_id').val();

                window.location = '{{route('kriteria-nilai.index')}}?kriteria_id='+id;
            });
            
            $('body').on('click', '.btnDelete', function (e) {
                e.preventDefault();
                var form = $(this).parent();
                Swal.fire({
                    title: "Anda Yakin?",
                    text: "Ingin hapus data Alternatif ?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Hapus",
                    cancelButtonText: "Batal",
                    reverseButtons: true,
                    confirmButtonColor: '#d33',
                }).then(function (result) {
                    if (result.isConfirmed) {
                        form.submit();
                    } else if (result.dismiss === "cancel") {

                    }
                });
            });
        });
    </script>
    <!--end::Page Scripts-->
@endpush