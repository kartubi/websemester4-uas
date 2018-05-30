<?php

namespace App\Http\Controllers\mahasiswa;

use App\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
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
            $user = Mahasiswa::where('email', $request->email)->first();

            if (! $user) {

                return $this->res('User not found');
            }

            $check = Hash::check($request->password, $user->password);

            if (! $check) {
                return $this->res('Password not matched');
            }

            Auth::guard('mahasiswa')->login($user);

            return $this->res('Login berhasil',true);

        else:
//            if (Auth::check())
//            {
//                return redirect('/mahasiswa');
//            }
            return view('mahasiswa.login',[
                'name' => $name = Route::currentRouteName()
            ]);
        endif;
    }
    public function mhs(){
        $user = Auth::user()->id;
        $smt = DB::select('SELECT semester.id,semester.name 
                            from semester
                            left join mahasiswa on semester.id = mahasiswa.semester_id
                            where semester.id <= (SELECT semester_id from mahasiswa where mahasiswa.id = '.$user.')
                            
                            ORDER BY semester.id asc');

        $info = Mahasiswa::where('id',$user)->first();
        return view('mahasiswa.index',[
            'semester' => $smt,
            'info'      => $info
        ]);
    }
    public function show()
    {
        $cari = Input::get('smt');
        $id_mhs = Auth::user()->id;
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
            ->make(true);
    }
}
