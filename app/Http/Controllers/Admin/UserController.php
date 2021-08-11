<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Jika Request dengan Menggunakan Data Ajax atau Datatables
        if(request()->ajax()) {
             // Fungsi ini menampilkan data user berdasarkan waktu terbaru
            $models = User::orderBy('created_at', 'DESC')->get();
           
             // ini berfungsi untuk menampilkan data user ke dalam datatables melalui ajax jquery
            return datatables()->of($models)
            ->addIndexColumn()
            ->editColumn('is_role', function ($models) {
                if($models->is_role == 1) {
                    $label  = "label-light-success";
                    $status = "Admin";
                } else if ($models->is_role == 2) {
                    $label  = "label-light-success";
                    $status = "User";
                } 
                
                return '<div class="d-flex"><div class="mr-1"><span class="label label-lg font-weight-bold ' . $label . ' label-inline">' . $status . '</span></div></div>';
            })
            ->addColumn('action', function ($models) {
                // Fungsi ini adalah button ubah dan hapus user
                $button = '<div class="d-flex">';
                $button .= '<div class="mr-1">';
                $button .= '<a href="'.route('user.edit', $models->id).'" class="btn btn-sm btn-primary"> <i class="fa fa-pencil-alt"></i> Ubah</a>';
                $button .= '</div>';
                $button .= '<div>';
                $button .= '<form action="' . route('user.destroy', $models->id) . '" method="POST">';
                $button .= '<input type="hidden" name="_method" value="delete" />';
                $button .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                $button .= '<button type="submit" name="edit" id="'.$models->id.'" class="btn btn-danger btn-sm btnDelete"><i class="fa fa-trash-alt"></i>Hapus</button>';
                $button .= '</form>';
                $button .= '</div>';
                $button .= '</div>';
                return $button;
            })
            ->rawColumns(['action','is_role'])    
            ->make(true);
        }
        // untuk memanggil file index user yang ada di dalam folder resources/view/admin/user/index
        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // untuk memanggil file create user yang ada di dalam folder resources/view/admin/user/create
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // fungsi untuk validasi jika name, email dan password user kosong, jadi harus requried saat insert data
        $request->validate([
            'name'   => 'required',
            'email'   => 'required|email|unique:users',
            'password'   => 'required',
            'is_role' => 'required'
        ]);
  
        // alur tambah data menggunakan eloquent, eloquent adalah model dari laravel
        // memanggil user menggunakan new user
        $user = new User;
        // memanggil $_POST name user
        $user->name = $request->name;
        // memanggil $_POST email user
        $user->email = $request->email;
        // memanggil $_POST password user lalu di enkripsi Hash:make ini adalah fungsi dari laravel
        $user->password = Hash::make($request->password);
        // memanggil $_POST is_role user
        $user->is_role = $request->is_role;
        // karena yg di insert atau tambah 3 field saja, maka sistem akan mengsave atau simpan
        $user->save();
  
        // Jika berhasil tambah data user, akan redirect ke halaman user.index,
        // dan menampilkan pesan berhasil User created successfully
        return redirect()->route('user.index')
                        ->with('success','User created successfully');
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
        // Untuk mendapatkan data user sesuai parameter idnya, karena ini akan menampilkan data yang ingin di edit
        $user = User::findOrFail($id);
        // untuk memanggil file edit user yang ada di dalam folder resources/view/admin/user/edit
        // compact artinya fungsi untuk memparsing nilai / data ke file view user.edit
        return view('admin.user.edit', compact('user'));
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
        // fungsi untuk validasi jika name, email dan password user kosong, jadi harus requried saat ubah data
        $request->validate([
            'name'   => 'required',
            'email'   => 'sometimes|unique:users,email,'.$id,
            'password'   => 'sometimes',
            'is_role' => 'required'
        ]);
  
        // cara kerja code ini sama dengan insert data, tapi ini khusus untuk edit data
        // karena ada findOrFail artinya edit data berdasarkan $id 
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_role = $request->is_role;
        
        // ini di cek dulu ketia edit user, jika password tidak kosong , password akan berubah
        // jadi kalo password kosong , artinya password tidak berubah
        if(!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();
        
        // Jika berhasil ubah/edit data user , akan redirect ke halaman user.edit,
        // dan menampilkan pesan berhasil User has been updated
        $request->session()->flash('message', 'Successfully modified the task!');

        return redirect()->route('user.index')->with('success', 'User has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         // ini fungsi untuk hapus data user berdasarkan $id yang di hapus
        $models = User::find($id)->delete();
        // Jika berhasil dihapus data user , akan redirect ke halaman user.index,
        // lalu menampilkan pesan User berhasil di hapus
        return redirect()->route('user.index')
                        ->with('success','User berhasil di hapus');
    }
}
