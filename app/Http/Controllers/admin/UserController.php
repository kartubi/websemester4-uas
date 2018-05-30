<?php

namespace App\Http\Controllers\admin;

use App\Mahasiswa;
use App\Nilai;
use App\Semester;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Validator;
use Route;
use DB;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{

    public function Login(Request $request)
    {
        if ($request->method() == 'POST') :
            $req = $request->all();
            $rules = [
                'email'     => 'required',
                'password'  => 'required'
            ];
            $validator = Validator::make($req, $rules);
            if ($validator->fails())
                return $this->res($validator->errors()->first());
            $user = User::where('email', $request->email)->first();

            if (! $user) {

                return $this->res('User not found');
            }

            $check = Hash::check($request->password, $user->password);

            if (! $check) {
                return $this->res('Password not matched');
            }

            Auth::login($user);

            return $this->res('Login berhasil',true);

        else:
            if (Auth::check())
            {
                return redirect('/admin');
            }
            return view('admin.login',[
                'name' => $name = Route::currentRouteName()
            ]);
        endif;
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/admin/login')
            ->withSuccess('Terimakasih, selamat datang kembali!');
    }
    public function index($id){
        $smt = DB::select('SELECT semester.id,semester.name 
                            from semester
                            left join mahasiswa on semester.id = mahasiswa.semester_id
                            where semester.id <= (SELECT semester_id from mahasiswa where mahasiswa.id = '.$id.')
                            
                            ORDER BY semester.id asc');

        $info = Mahasiswa::where('id',$id)->first();
        return view('admin.index',[
            'semester' => $smt,
            'info'      => $info
        ]);
    }
    public function show()
    {
        $cari = Input::get('smt');
        $id_mhs = Input::get('id_mhs');
        $data = DB::select('select 
                      `pelajaran`.`id`, `pelajaran`.`name`, `pelajaran`.`sks`, 
                      `nilai`.`tugas`, `nilai`.`formatif`, `nilai`.`uts`, `nilai`.`uas`,
                       (tugas+formatif+uts+uas)/4 as total_nilai, 
                       case 
                       when (tugas+formatif+uts+uas)/4 >= 90 
                       then \'A\' when (tugas+formatif+uts+uas)/4 >= 80 
                       then \'B\' when (tugas+formatif+uts+uas)/4 >= 70 
                       then \'C\' when (tugas+formatif+uts+uas)/4 >= 60 
                       then \'D\' when (tugas+formatif+uts+uas)/4 >= 50 
                       then \'E\' 
                       end 
                       as kumulatif 
                       from `nilai` 
                       right join `pelajaran` on `nilai`.`pelajaran_id` = `pelajaran`.`id` and `nilai`.`semester_id` = '.$cari.' 
                       left join `mahasiswa` on `mahasiswa`.`id` = `nilai`.`mahasiswa_id` and `mahasiswa`.`id` = '.$id_mhs.'');
        return DataTables::of($data)
            ->addColumn('action',function($data){
                return
                    '<a onClick="editNilai('."'$data->id'".')" class="btn btn-primary btn-xs"><i class="material-icons" style="color:#DD2C00;">edit</i>&nbsp</a>';
            })
            ->make(true);
    }
    //
}
