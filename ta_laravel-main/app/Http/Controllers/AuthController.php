<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Signin';
        return view('pages.auth.signin', [
            'title' => $title,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Signup';
        return view('pages.auth.signup', [
            'title' => $title,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|unique:users|email:dns',
            'password' => 'required|min:8',
            'name' => 'required',
            'phone' => 'required|min:9',
            'address' => 'required',
            'city' => 'required',
            'region' => 'required',
            'postal_code' => 'required',
            'birthday' => 'required',
            'image' => 'required|max:2048|dimensions:ratio=1/1',
        ]);

        if ($request->type!='') {
            $users['type']=$request->type;
        }else{
            $users['type']='user';
        }
        //cek phone
        $phone=$validateData['phone'];

        if (substr($phone,0,1)==0) {
            $newPhone = "62" . substr($phone, 1); //jika depan 0 maka ganti 62            
        }else{
            if (substr($phone,0,1)==6 && substr($phone,1,1)==2) { //cek kalau depannya 6 apakah next stringnya 2
                $newPhone = $phone;
            }else{
                $newPhone = "62" . $phone; //jika depan bukan 0 maka tambah 62
            }
        }

        //upload file
        $file = $request->file('image');
        $path = 'assets/users/fotoProfil';
        $fileName = $validateData['username'] . '.' . $file->getClientOriginalExtension();
        $upload = $file->move(public_path($path), $fileName);

        //split data untuk table user
        $users = [];
        $users['username'] = $validateData['username'];
        $users['email'] = $validateData['email'];
        $users['password'] = Hash::make($validateData['password']);

        //split data untuk table profil
        $profil = [];
        $profil['name'] = $validateData['name'];
        $profil['phone'] = $newPhone;
        $profil['address'] = $validateData['address'];
        $profil['city'] = $validateData['city'];
        $profil['region'] = $validateData['region'];
        $profil['postal_code'] = $validateData['postal_code'];
        $profil['birthday'] = $validateData['birthday'];
        $profil['image'] = $path.'/'.$fileName;

        if ($upload) {
            $user=User::create($users);
            if ($user) {
                $profil['user_id'] = $user->id;
                Profile::create($profil);
                return redirect('/user/signin')->with('success','Registrasi Berhasil Silahkan Login');
            }           
        }
        
    }

    /**
     * Auth account when login
     *
     */
    // public function authenticate(Request $request)
    // {
    //     $validate= $request->validate([
    //         'username'=>'required|min:5|max:255',
    //         'password'=>'required|min:5|max:255'
    //     ]);

    //     if (Auth::attempt($validate)) {
    //         $request->session()->regenerate();
    //         $token = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 50);
    //         Session::put('token', $token);
            
    //         $isAdmin=auth()->user()->admin;
    //         Session::put('admin', $isAdmin);
    //         if($isAdmin==1){
    //             return redirect()->intended('/manage');
    //         }else{
    //             return redirect()->intended('/home');
    //         }
    //     }

    //     return back()->with('loginError','Login Gagal. Periksa Kembali Username dan Password');
    // }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        return back()->with('loginError','Login Gagal!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/user/signin');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
