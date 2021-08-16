<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use App\Libraries\Helpers;
use App\Models\AlternatifNilai;
use DB;
use Auth;
use Goutte\Client;
// use Symfony\Component\DomCrawler\Crawler;

class AlternatifController extends Controller
{
    protected $user_id;
    protected $user_role;
    private $results = array();

    public function __construct()
    {
        $this->middleware(function (Request $request, $next) {
            if (!\Auth::check()) {
                return redirect('/login');
            }

            // you can access user id here
            $this->user_id = Auth::User()->id;
            $this->user_role = Auth::User()->is_role; 
     
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            // Jika Request dengan Menggunakan Data Ajax atau Datatables
            if(request()->ajax()) {
                // Fungsi ini menampilkan data alternatif berdasarkan waktu terbaru
                $models = Alternatif::orderBy('created_at', 'ASC')->get();
            
                // ini berfungsi untuk menampilkan data alternatif ke dalam datatables melalui ajax jquery
                return datatables()->of($models)
                ->addIndexColumn()
                ->addColumn('action', function ($models) {
                    // Fungsi ini adalah button ubah dan hapus alternatif
                    $button = '<div class="d-flex">';
                    $button .= '<div class="mr-1">';
                    $button .= '<a href="'.route('alternatif.edit', $models->id).'" class="btn btn-sm btn-primary"> <i class="fa fa-pencil-alt"></i> Ubah</a>';
                    $button .= '</div>';
                    $button .= '<div>';
                    $button .= '<form action="' . route('alternatif.destroy', $models->id) . '" method="POST">';
                    $button .= '<input type="hidden" name="_method" value="delete" />';
                    $button .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                    $button .= '<button type="submit" name="edit" id="'.$models->id.'" class="btn btn-danger btn-sm btnDelete"><i class="fa fa-trash-alt"></i>Hapus</button>';
                    $button .= '</form>';
                    $button .= '</div>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action'])    
                ->make(true);
            }

            // untuk memanggil file index alternatif yang ada di dalam folder resources/view/admin/alternatif/index

            return view('admin.alternatif.index');
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // untuk memanggil file create alternatif yang ada di dalam folder resources/view/admin/alternatif/create
        return view('admin.alternatif.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // fungsi untuk validasi jika nama dan keterangan alternatif kosong, jadi harus requried saat insert data
        $request->validate([
            'link_scrapping'   => 'required'
        ]);

        // use Goutte\Client;
        $client = new Client();
        // $url = 'https://www.worldometers.info/coronavirus/';
        // $url = 'https://sentraponsel.com/index.php?route=product/product&path=20_61&product_id=352';
        $url = $request->link_scrapping;
        $page = $client->request('GET', $url);
        
        // memberikan verifay true dan timeout 300
        $guzzleclient = new \GuzzleHttp\Client([
            'timeout' => 300,
            'verify' => true
        ]);

        // scrapping tag html untuk mendapatkan foto handphone dari web sentralponsel
        $image_produk = $page->filter('.thumbnail img')->eq(0)->attr('src');
        // scrapping tag html untuk mendapatkan nama handphone dari web sentralponsel
        $name_produk = $page->filter('.col-sm-4 > h1')->text();

        $price = $page->filter('ul.list-unstyled > li >h2')->text();
        
        $page->filter('#tab-specification > table > tbody > tr')->each(function ($item)  {
            // print $item->filter('td')->html();
            $this->results[$item->filter('td')->html()]  = $item->filter('td:nth-child(2)')->html();
        });
       
        $data = $this->results;

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // exit();

        // check data ukuran  jika tidak ada akan redirect ke alternatif index
        if(!isset($data['Ukuran'])) {
            return redirect()->route('alternatif.index')
                        ->with('failed','Kriteria Ukuran tidak di Temukan');
            exit();
        }

         // check data Storage  jika tidak ada akan redirect ke alternatif index
        if(!isset($data['Storage'])) {
            return redirect()->route('alternatif.index')
                        ->with('failed','Kriteria Storage tidak di Temukan');
            exit();
        }

        // check data battery  jika tidak ada akan redirect ke alternatif index
        if(!isset($data['Battery'])) {
            return redirect()->route('alternatif.index')
                        ->with('failed','Kriteria Battery tidak di Temukan');
            exit();
        }

        // check data kamera depan  jika tidak ada akan redirect ke alternatif index
        if(!isset($data['Kamera Depan'])) {
            return redirect()->route('alternatif.index')
                        ->with('failed','Kriteria Kamera Depan tidak di Temukan');
            exit();
        }

        // check data RAM  jika tidak ada akan redirect ke alternatif index
        if(!isset($data['RAM'])) {
            return redirect()->route('alternatif.index')
                        ->with('failed','Kriteria RAM tidak di Temukan');
            exit();
        }

        // menjadikan nilai harga hp web 3000.000 menjadi 30000000 
        $unrupiah = Helpers::unrupiah($price);
        // memcehan harga hp 
        $unrupiah_replace = explode('Rp', $unrupiah);
        
        // cek jika harga hp lebih dari 4jt makan nilai price 3
        if(intval($unrupiah_replace[1]) > 4000000) {
            $nilai_price = 3;
            // cek jikan harga hp lebih dari sama dengan 3jt dan kurang sama dengan 4jt makan nilai price 2
        } else if (intval($unrupiah_replace[1]) >= 3000000  && intval($unrupiah_replace[1]) <= 4000000) {
            $nilai_price = 2;
            // cek jikan harga hp lebih kurang dari 3jt nilai price 4
        }  else if (intval($unrupiah_replace[1]) < 3000000) {
            $nilai_price = 4;
        } 
        
        // alur tambah data menggunakan eloquent, eloquent adalah model dari laravel
        // memanggil alternatif menggunakan new alternatif
        $model = new Alternatif;
        // memanggil $_POST nama alternatif
        $model->alternatif_nama = $name_produk;
        $model->alternatif_image = $image_produk;
        // memanggil $_POST nama keterangan
        $model->alternatif_harga = $price;
        $model->alternatif_ukuran_layar = $data['Ukuran'];
        $model->alternatif_baterai = $data['Battery'];
        $model->alternatif_storage = $data['Storage'];
        $model->alternatif_kamera = $data['Kamera Depan'];
        $model->alternatif_ram = $data['RAM'];
        
        // karena yg di insert atau tambah 2 field saja, maka sistem akan mengsave atau simpan
        $model->save();

        
        // insert data alternatif_id, kriteria_id dan nilai_kriteria_id ke tabel AlternatifNilai
        $insert_price = new AlternatifNilai;
        $insert_price->alternatif_id = $model->id;
        $insert_price->kriteria_id = 1;
        $insert_price->nilai_kriteria_id  = $nilai_price;
        $insert_price->save();

         // memecah spek kamera 
        // ----------------- Kamera -----------------//
        $kamera_implode = explode('MP', $data['Kamera Depan']);
        
        // cek jika spek kamera depan lebih dari 13 maka nilai  23
        if(intval($kamera_implode[0]) > 13) {
            $nilai_kamera = 23;
             // cek jika spek kamera depan lebih dari sama dengan 8 dan kurang sama dengan 13 makan nilai  24
        } else if (intval($kamera_implode[0]) >= 8 && intval($kamera_implode[0]) <= 13) {
            $nilai_kamera = 24;
             // cek jika spek kamera depan lebih kurang dari 8 nilai price 25
        }  else if (intval($kamera_implode[0]) < 8) {
            $nilai_kamera = 25;
        }  

        // insert data alternatif_id, kriteria_id dan nilai_kriteria_id ke tabel AlternatifNilai
        $insert_kamera = new AlternatifNilai;
        $insert_kamera->alternatif_id = $model->id;
        $insert_kamera->kriteria_id = 2;
        $insert_kamera->nilai_kriteria_id  = $nilai_kamera;
        $insert_kamera->save();

        // memecah spek Stroage 
        // ----------------- Storage -----------------//
        $storage_implode = explode('GB', $data['Storage']);
        
         // cek jika spek storage lebih dari 64 makan nilai 15
        if(intval($storage_implode[0]) > 64) {
            $nilai_storage = 15;
             // cek jika spek kamera depan lebih dari sama dengan 32 dan kurang sama dengan 64 makan nilai  16
        } else if (intval($storage_implode[0]) >= 32 && intval($storage_implode[0]) <= 64) {
            $nilai_storage = 16;
            // cek jika spek kamera depan lebih kurang dari 17 nilai price 32
        } else if (intval($storage_implode[0]) < 32) {
            $nilai_storage = 17;
        }  

        // insert data alternatif_id, kriteria_id dan nilai_kriteria_id ke tabel AlternatifNilai
        $insert_storage = new AlternatifNilai;
        $insert_storage->alternatif_id = $model->id;
        $insert_storage->kriteria_id = 3;
        $insert_storage->nilai_kriteria_id  = $nilai_storage;
        $insert_storage->save();


        // memecah spek RAM 
        // ----------------- RAM -----------------//
        $ram_implode = explode('GB', $data['RAM']);
        
         // cek jika spek RAM lebih dari 4 makan nilai 11
        if(intval($ram_implode[0]) > 4) {
            $nilai_ram = 11;
             // cek jika spek RAM depan lebih dari sama dengan 3 dan kurang sama dengan 4 makan nilai  12
        } else if (intval($ram_implode[0]) >= 3 && intval($ram_implode[0]) <= 4) {
            $nilai_ram = 12;
             // cek jika spek RAM depan lebih kurang dari 3 nilai price 13
        } else if (intval($ram_implode[0]) < 3) {
            $nilai_ram = 13;
        }

         // insert data alternatif_id, kriteria_id dan nilai_kriteria_id ke tabel AlternatifNilai
        $insert_ram = new AlternatifNilai;
        $insert_ram->alternatif_id = $model->id;
        $insert_ram->kriteria_id = 7;
        $insert_ram->nilai_kriteria_id  = $nilai_ram;
        $insert_ram->save();


        // ----------------- Ukuran Layar -----------------//
         // memecah spek Ukuran Layar 
        $ukuran_implode = explode(' ', $data['Ukuran']);
          // menjadikan nilai Ukuran Layar hp di web 6.5 menjadi 65
        $unrupiah_ukuran = Helpers::unukuran($ukuran_implode[0]);

         // cek jika spek Ukuran Layar lebih dari 65 makan nilai 27
        if(intval($unrupiah_ukuran) > 65) {
            $nilai_ukuran = 27;
             // cek jika spek Ukuran Layar depan lebih dari sama dengan 3 dan kurang sama dengan 4 makan nilai  28
        } else if (intval($unrupiah_ukuran) >= 6 && intval($unrupiah_ukuran) <= 65) {
            $nilai_ukuran = 28;
            // cek jika spek RAM depan lebih kurang dari 6 nilai price 29
        } else if (intval($unrupiah_ukuran) < 6) {
            $nilai_ukuran = 29;
        }  else {
            // jika tidak ada spek nilai 29
            $nilai_ukuran = 29;
        }

        // insert data alternatif_id, kriteria_id dan nilai_kriteria_id ke tabel AlternatifNilai
        $insert_ram = new AlternatifNilai;
        $insert_ram->alternatif_id = $model->id;
        $insert_ram->kriteria_id = 8;
        $insert_ram->nilai_kriteria_id  = $nilai_ukuran;
        $insert_ram->save();

        // ----------------- Baterry -----------------//
        // preg match all , cari kata kunci battery
        $re = '/(\d[,|.]\d+)/m';
        $str = $data['Battery'];
        preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);

        // Print the entire match result
        // echo "<pre>";
        // print_r($matches);
        // echo "</pre>";
         // menjadikan nilai Ukuran Layar hp di web 4.000 menjadi 4000
        $unrupiah_baterry = Helpers::unukuran($matches[0][0]);

        // cek jika spek Baterry lebih dari 4000 makan nilai 19
        if(intval($unrupiah_baterry) > 4000) {
            $nilai_baterry = 19;
             // cek jika spek Ukuran Layar depan lebih dari sama dengan 3000 dan kurang sama dengan 4000 makan nilai 20
        } else if (intval($unrupiah_baterry) >= 3000 && intval($unrupiah_baterry) <= 4000) {
            $nilai_baterry = 20;
             // cek jika spek RAM depan lebih kurang dari 3000 nilai price 21
        }  else if (intval($unrupiah_baterry) < 3000) {
            $nilai_baterry = 21;
        }  
        
         // insert data alternatif_id, kriteria_id dan nilai_kriteria_id ke tabel AlternatifNilai
        $insert_baterry = new AlternatifNilai;
        $insert_baterry->alternatif_id = $model->id;
        $insert_baterry->kriteria_id = 4;
        $insert_baterry->nilai_kriteria_id  = $nilai_baterry;
        $insert_baterry->save();

        // jika berhasil redirect ke yang ada di dalam folder resources/view/admin/alternatif/index
        return redirect()->route('alternatif.index')
                        ->with('success','Alternatif created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($this->user_role == 1) {
            // Untuk mendapatkan data alternatif sesuai parameter idnya, karena ini akan menampilkan data yang ingin di edit
            $alternatif = Alternatif::findOrFail($id);

            // untuk memanggil file edit alternatif yang ada di dalam folder resources/view/admin/alternatif/edit
            // compact artinya fungsi untuk memparsing nilai / data ke file view alternatif.edit
            return view('admin.alternatif.edit', compact('alternatif'));
        } else {
            echo "Anda tidak memiliki akses";
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         // fungsi untuk validasi jika nama dan keterangan alternatif kosong, jadi harus requried saat ubah data
        $request->validate([
            'alternatif_nama'   => 'required',
            'alternatif_harga' => 'required',
            'alternatif_kamera' => 'required',
            'alternatif_storage' => 'required',
            'alternatif_baterai' => 'required',
            'alternatif_ram' => 'required',
            'alternatif_ukuran_layar' => 'required'
        ]);
            
        // cata kerja code ini sama dengan insert data, tapi ini khusus untuk edit data
        // karena ada findOrFail artinya edit data berdasarkan $id 
        $model = Alternatif::findOrFail($id);
        $model->alternatif_nama = $request->alternatif_nama;
        $model->alternatif_harga = $request->alternatif_harga;
        $model->alternatif_kamera = $request->alternatif_kamera;
        $model->alternatif_storage = $request->alternatif_storage;
        $model->alternatif_baterai = $request->alternatif_baterai;
        $model->alternatif_ram = $request->alternatif_ram;
        $model->alternatif_ukuran_layar = $request->alternatif_ukuran_layar;
        $model->save();
        
        $unrupiah = Helpers::unrupiah($request->alternatif_harga);
        $unrupiah_replace = explode('Rp', $unrupiah);
       
        if(intval($unrupiah_replace[1]) > 4000000) {
            $nilai_price = 3;
        } else if (intval($unrupiah_replace[1]) >= 3000000  && intval($unrupiah_replace[1]) <= 4000000) {
            $nilai_price = 2;
        }  else if (intval($unrupiah_replace[1]) < 3000000) {
            $nilai_price = 4;
        } 

        $data_price = array('nilai_kriteria_id' => $nilai_price);
        $update_price = \DB::table('alternatif_nilais')->where('alternatif_id', $model->id)
        ->where('kriteria_id', 1)->update($data_price);

        // ----------------- Kamera -----------------//
        $kamera_implode = explode('MP', $request->alternatif_kamera);
        
        if(intval($kamera_implode[0]) > 13) {
            $nilai_kamera = 23;
        } else if (intval($kamera_implode[0]) >= 8 && intval($kamera_implode[0]) <= 13) {
            $nilai_kamera = 24;
        }  else if (intval($kamera_implode[0]) < 8) {
            $nilai_kamera = 25;
        }  

        $data_kamera = array('nilai_kriteria_id' => $nilai_kamera);
        $update_kamera = \DB::table('alternatif_nilais')->where('alternatif_id', $model->id)
        ->where('kriteria_id', 2)->update($data_kamera);


        // // ----------------- Storage -----------------//
        $storage_implode = explode('GB', $request->alternatif_storage);
        
        if(intval($storage_implode[0]) > 64) {
            $nilai_storage = 15;
        } else if (intval($storage_implode[0]) >= 32 && intval($storage_implode[0]) <= 64) {
            $nilai_storage = 16;
        } else if (intval($storage_implode[0]) < 32) {
            $nilai_storage = 17;
        }  

        $data_storage = array('nilai_kriteria_id' => $nilai_storage);
        $update_storage = \DB::table('alternatif_nilais')->where('alternatif_id', $model->id)
        ->where('kriteria_id', 3)->update($data_storage);

        // // ----------------- RAM -----------------//
        $ram_implode = explode('GB', $request->alternatif_ram);
        
        if(intval($ram_implode[0]) > 4) {
            $nilai_ram = 11;
        } else if (intval($ram_implode[0]) >= 3 && intval($ram_implode[0]) <= 4) {
            $nilai_ram = 12;
        } else if (intval($ram_implode[0]) < 3) {
            $nilai_ram = 13;
        }

        $data_ram = array('nilai_kriteria_id' => $nilai_ram);
        $update_ram = \DB::table('alternatif_nilais')->where('alternatif_id', $model->id)
        ->where('kriteria_id', 7)->update($data_ram);

        // // ----------------- Ukuran Layar -----------------//
        $ukuran_implode = explode(' ', $request->alternatif_ukuran_layar);
        $unrupiah_ukuran = Helpers::unukuran($ukuran_implode[0]);

        if(intval($unrupiah_ukuran) > 65) {
            $nilai_ukuran = 27;
        } else if (intval($unrupiah_ukuran) >= 6 && intval($unrupiah_ukuran) <= 65) {
            $nilai_ukuran = 28;
        } else if (intval($unrupiah_ukuran) < 6) {
            $nilai_ukuran = 29;
        }  

        $data_ukuran = array('nilai_kriteria_id' => $nilai_ukuran);
        $update_ukuran = \DB::table('alternatif_nilais')->where('alternatif_id', $model->id)
        ->where('kriteria_id', 8)->update($data_ukuran);

        // // ----------------- Baterry -----------------//
        $re = '/(\d[,|.]\d+)/m';
        $str = $request->alternatif_baterai;
        preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);

        // // Print the entire match result
        // // echo "<pre>";
        // // print_r($matches);
        // // echo "</pre>";
            
        $unrupiah_baterry = Helpers::unukuran($matches[0][0]);

        if(intval($unrupiah_baterry) > 4000) {
            $nilai_baterry = 19;
        } else if (intval($unrupiah_baterry) >= 3000 && intval($unrupiah_baterry) <= 4000) {
            $nilai_baterry = 20;
        }  else if (intval($unrupiah_baterry) < 3000) {
            $nilai_baterry = 21;
        }  

        $data_baterry = array('nilai_kriteria_id' => $nilai_baterry);
        $update_baterry = \DB::table('alternatif_nilais')->where('alternatif_id', $model->id)
        ->where('kriteria_id', 4)->update($data_baterry);

        // Jika berhasil ubah/edit data alternatif , akan redirect ke halaman alternatif.edit,
        // dan menampilkan pesan berhasil Alternatif has been updated
         $request->session()->flash('message', 'Successfully modified the task!');
        // return redirect()->route('alternatif.index')->with('success', 'Alternatif has been updated');
        return redirect()->route('alternatif.index')->with('success', 'Alternatif has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        if($this->user_role == 1) {
            // ini fungsi untuk hapus data alternatif berdasarkan $id yang di hapus
            $models = Alternatif::find($id);

            $an_nilai_delete = AlternatifNilai::where('alternatif_id', $models->id)->delete();
            
            $models_delete =  $models->delete();

            // Jika berhasil dihapus data alternatif , akan redirect ke halaman alternatif.index,
            // lalu menampilkan pesan Alternatif berhasil di hapus
            return redirect()->route('alternatif.index')
                            ->with('success','Alternatif berhasil di hapus');
        } else {
            echo "Anda tidak memiliki akses";
        }
    }
}
