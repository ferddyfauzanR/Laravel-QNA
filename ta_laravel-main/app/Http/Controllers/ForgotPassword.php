<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPassword extends Controller
{
    public function index()
    {
        $title = 'Forgot Password';
        return view('pages.auth.forgotpassword', [
            'title' => $title,
        ]);
    }

    public function reset(Request $request)
    {
        $getUser = User::select('id','email','username')->where('username',$request->username)->where('email',$request->email)->first();
        if ($getUser) {
            
            $user=User::find($getUser->id);
            $pass = Str::random(8);
            $user->password = Hash::make($pass);
            $user->save();
            $pesan='<p>Dear User,</p>';
            $pesan.='<p>Your password has been reset successfully. <p>';
            $pesan.='<p>Here are your new password: <strong>'.$pass.'</strong><p>';
            $pesan.='<p>Please use the new password to sign in to your account.<br>After signing in, remember to update your password for security purposes<p>';

            $dataEmail=[
                'subject'=>'Reset Password',
                'isi'=>$pesan
            ];

            $subject = 'Reset Password';
            
            $mail = new WelcomeEmail($dataEmail);
            Mail::to($getUser->email)->send($mail);
            return redirect('/user/signin')->with('Resetsuccess','Reset Password Berhasil, Silahkan Cek Email Anda');
            
        }else{
            return back()->with('error','Username atau Email Tidak Ditemukan');
        }
    }
}
