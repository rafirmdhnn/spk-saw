@extends('layouts.app')
@section('title')
<a href="{{route('perhitungan.detail', 'user_id')}}">
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Detail Hasil Perhitungan SAW</h5>
</a>
@endsection
@section('content')
<div class="d-flex flex-column-fluid">	
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card Details User-->
        <div class="card mb-3">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Nama</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                      {{ $desc_hasil['Nama'] }}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Email</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  {{ $desc_hasil['Email'] }}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Hasil BAI</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  {{ $desc_hasil['Hasil Bai'] }} -- <span class="badge badge-primary">{{ $desc_hasil['Level Bai'] }}</span>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Hasil SAW</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    {{ $desc_hasil['Max SAW'] }} --  
                        <span class="badge badge-primary">{{ $desc_hasil['Detail SAW'] }}</span>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Tanggal Test</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  {{ $desc_hasil['Tanggal'] }}
                </div>
              </div>
              {{-- <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">File PDF</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <a href="perhitungan/pdf/{{ $user->id }}"><span class="badge badge-primary">download pdf</span></a>
                </div>
              </div> --}}
            </div>
        </div>
        <!--end::Card Detail User-->

        <!--begin::Card Alternatif Keseluruhan-->
        <div class="card mb-3">
          <div class="card-body">
            <h1 class="title_alternatif">Alternatif Keseluruhan</h1>
            <table class="table table-bordered table-striped" id="myTable">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Alternatif</th>
                  <th scope="col">Nilai Kriteria</th>
                  <th scope="col">Keterangan Kriteria</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($arr_alternatif as $index => $aa)
                  <tr>
                      <th scope="row">{{ $index + 1 }}</th>
                      <td>{{ $aa['Alternatif'] }}</td>
                      <td>{{ $aa['Nilai Gejala'] }}</td>
                      <td>{{ $aa['Keterangan Gejala'] }}</td>
                    </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <!--End::Card Alternatif Keseluruhan-->

        <!--begin::Card Matrix Sebelum Normalisasi-->
        <div class="card mb-3">
          <div class="card-body">
            <h3>Matrix sebelum normalisasi</h3>
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
                        @foreach ($arr_prn_a1 as $mx1)
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
                        @foreach ($arr_prn_a2 as $mx2)
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
                        @foreach ($arr_prn_a3 as $mx3)
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
                        @foreach ($arr_prn_a4 as $mx4)
                            <td class="text-center">{{ $mx4 }}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
          </div>
        </div>
        <!--End::Card Matrix Sebelum Normalisasi-->
        
        <!--Begin::Card Matrix Setelah Normalisasi-->
        <div class="card mb-3">
          <div class="card-body">
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
                        @foreach ($arr_psn_a1 as $mx_n1)
                        <td class="text-center">{{ $mx_n1 }}</td>
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
                        @foreach ($arr_psn_a2 as $mx_n2)
                        <td class="text-center">{{ $mx_n2 }}</td>
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
                        @foreach ($arr_psn_a3 as $mx_n3)
                            <td class="text-center">{{ $mx_n3 }}</td>
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
                        @foreach ($arr_psn_a4 as $mx_n4)
                            <td class="text-center">{{ $mx_n4 }}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
          </div>
        </div>
        <!--End::Card Matrix Setelah Normalisasi-->
        
        <!--Begin::Begin Matrix Hasil Perhitungan SAW-->
        <div class="card mb-3">
          <div class="card-body">
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
                        <td>{{ $saw_val['Subjective'] }}</td>
                    </tr>
                    <tr>
                        <th>Aspek Neurophysiology</th>
                        <td>{{ $saw_val['Neurophysiology'] }}</td>
                    </tr>
                    <tr>
                      <th>Aspek Autonomic</th>
                        <td>{{ $saw_val['Autonomic'] }}</td>
                    </tr>
                    <tr>
                        <th>Aspek Panic Related</th>
                        <td>{{ $saw_val['Panic Related'] }}</td>
                    </tr>
                  </tbody>
              </table>
          </div>
        </div>
    </div>
      <!--End::Card Matrix Hasil perhitungan SAW-->
    <!--end::Container-->
</div>
        
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
    <!--end::Page Scripts-->
    <script>
        $(document).ready( function () {
          $('#myTable').DataTable();
        } );

        //Card Control
        // This card is lazy initialized using data-card="true" attribute. You can access to the card object as shown below and override its behavior
        var card = new KTCard('filter_card');

        
    </script>
@endpush