<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class VerifikasiEmail extends Controller
{
    public function index()
    {
        $title = 'Verifikasi Email';
        return view('pages.auth.verifiedMail', [
            'title' => $title,
        ]);
    }

    public function verifiedMail($username)
    {
        $getUser = User::select('id','email')->where('username',$username)->first();
        if ($getUser) {
            
            $user=User::find($getUser->id);
            $code = Hash::make(Str::random(6));
            $user->email_verified = $code;
            $user->save();
            $verificationUrl = URL::to('/email/verifikasi/'.$username.'?code='.$code);
            $pesan="<p>Dear User,</p>";
            $pesan.="<p>Thank you for creating an account with us.<br>Please verify your email address by clicking the link below: <p>";
            $pesan.="<a href='".$verificationUrl."'>".$verificationUrl."</a>";
            $pesan.="<p>Once you've clicked the link, your email address will be verified,<br>and you will be able to access your account and enjoy our services.<p>";

            $dataEmail=[
                'subject'=>'Verifikasi Email',
                'isi'=>$pesan
            ];

            
            $mail = new WelcomeEmail($dataEmail);
            Mail::to($getUser->email)->send($mail);
            return redirect()->back()->with('success','Kode Verifikasi Sudah Dikirim, Silahkan Cek Email Anda');
            
        }
    }
    public function verifikasi(Request $request, $username)
    {
        $getUser = User::select('id','email_verified_at','email_verified')->where('username',$username)->first();
        if ($getUser) {
            if ($getUser->email_verified === $request->code) {
                $date = date('Y-m-d H:i:s', strtotime('now'));
                $user=User::find($getUser->id);
                $user->email_verified_at = $date;
                $user->email_verified = null;
                $user->save();
                return redirect('/user/profil/'.$username)->with('success','Email berhasil diverifikasi, Terimakasih');
            }         
        }
    }
}
