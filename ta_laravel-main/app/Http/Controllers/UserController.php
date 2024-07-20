<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    
    public function index()
    {
        //
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($username)
    {
        $data = User::join('profiles', 'users.id', '=', 'profiles.user_id')->where('username','=',$username)->first();
        $title = 'Profile';
        return view('pages.user.profil',[
            'title'=>$title,
            'datas'=>$data
        ]);
    } 

    
    public function edit($section, $username)
    {
        if ($section=='profil') {
            $data = User::join('profiles', 'users.id', '=', 'profiles.user_id')->where('username','=',$username)->first();
            $title = 'Edit Profile';
            return view('pages.user.editAccount',[
                'title'=>$title,
                'section'=>$section,
                'datas'=>$data
            ]);
        }else{
            $data = User::where('username','=',$username)->first();
            $title = 'Edit Profile';
            return view('pages.user.editAccount',[
                'title'=>$title,
                'section'=>$section,
                'datas'=>$data
            ]);
        }
    }

    public function update(Request $request, $section, $username)
    {
        if ($section=='profil') {
            
            $updateProfil = $this->updateProfil($request, $username);
            if ($updateProfil==true) {
                return redirect('/user/profil/'.$username)->with('success','Ubah Data Berhasil');
            }
        }else{
            
            return $this->updateUser($request, $username);

        }
        
        
    }

    protected function updateUser($request, $username)
    {
        // Validasi data
        $userId=User::select('id')->where('username','=',$username)->first(); //cari id dengan username
        $user = User::find($userId->id);

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email,'.$userId->id,
            'username' => 'required|unique:users,username,'.$userId->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        
        if ($request->password!=null) {
            $errors = new MessageBag([                
                'password' => 'The password must be at least 8 characters.',
                'confirmPassword' => 'The password field is required.',
            ]);

            $newPass=$request->password;
            $authPass=$request->confirmPassword;
            if ($newPass<8) {                
                return redirect()->back()->withErrors($errors)->withInput();
            }else{
                if($newPass!=$authPass){
                    return redirect()->back()->with('error','Password Tidak Sesuai');                                    
                }else{
                    $user->password = Hash::make($newPass);
                    $user->save();
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return redirect('/user/signin');            
                }
            }
        }

        // Temukan pengguna berdasarkan ID
        $user = User::find($userId->id);
        if ($user) {
            $user->email = $request->input('email');
            $user->username = $request->input('username');
            $user->email_verified_at = null;
            $user->save();
            
            
            return redirect('/user/profil/'.$request->input('username'))->with('success','Ubah Data Berhasil');
        } else {
            return "Pengguna tidak ditemukan.";
        }


        
    }

    protected function updateProfil($request, $username)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'phone' => 'required|min:9',
            'address' => 'required',
            'city' => 'required',
            'region' => 'required',
            'postal_code' => 'required',
            'birthday' => 'required',
            'image' => 'max:2048|dimensions:ratio=1/1',
        ]);       
        
        $user=User::select('id')->where('username','=',$username)->first(); //cari id dengan username
        $profile=Profile::find($user->id); //ambil data profile berdasarkan id

        if ($request->has('image')) {
            FILE::delete($profile->image);
            $path = 'assets/users/fotoProfil';
            $file = $request->file('image');
            $fileName = $username . '.' . $file->getClientOriginalExtension();
            $request->image->move(public_path($path), $fileName);

            $profile->image=$path.'/'.$fileName;
            $profile->save();
        }
        
        $profile->name = $validateData['name'];
        $profile->phone = $validateData['phone'];
        $profile->address = $validateData['address'];
        $profile->city = $validateData['city'];
        $profile->region = $validateData['region'];
        $profile->postal_code = $validateData['postal_code'];
        $profile->birthday = $validateData['birthday'];
        $update = $profile->save();

        return $update;
    }

   
    public function destroy(Request $request, $username)
    {
        $user=User::select('id','password')->where('username','=',$username)->first(); //cari id dengan username
        $password = $request->input('password');
        
        if (Hash::check($password, $user->password)) {
            $profile=Profile::find($user->id); //ambil data profile berdasarkan id
            $profile->delete(); //hapus data profile
            $user=User::find($user->id);
            $user->delete(); //hapus data user
            FILE::delete($profile->image);
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/user/signin');
        } else {
            return back()->with('error','Password Tidak Cocok');
        }
    }
}
