<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login()
    {
        if (!Auth::check()) {
            return view('pages.auth.login');
        }else{
            redirect()->route(Auth::user()->getRoleNames()[0]);
        }
    }

    public function logOut()
    {
        Auth::logout();
        redirect()->route('login');
    }

    function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email_or_username" => 'required',
            "password" => 'required|min:8',
        ], [
            'email_or_username.required' =>  'Email/Username Tidak Boleh Kosong',
            'password.required' => 'Password Tidak Boleh Kosong',
            'password.min' => 'Minimal Password 8 Karakter'
        ]);

        // Jika validasi gagal, kembalikan pesan kesalahan dalam respons JSON
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all()
            ], 422); // Kode status HTTP 422 untuk Unprocessable Entity
        }

        $login = $request->input('email_or_username');

        $isEmail = filter_var($login, FILTER_VALIDATE_EMAIL);

        if ($isEmail != false) {
            $data = [
                'email'     => $request->input('email_or_username'),
                'password'  => $request->input('password'),
            ];
        } else {
            $data = [
                'username'     => $request->input('email_or_username'),
                'password'  => $request->input('password'),
            ];
        }

        $remember = $request->remember ? true : false;

        Auth::attempt($data, $remember);

        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            $role = Auth::user()->getRoleNames()[0];
            return response()->json([
                'success' => true,
                'message' => 'Selamat Datang',
                'route' => route($role)
            ]);
        } else {

            $userExists = User::where('email', $data['email'] ?? null)
                ->orWhere('username', $data['username'] ?? null)
                ->exists();

            if (!$userExists) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email atau username tidak terdaftar',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Email atau password salah',
                ]);
            }
        }
    }
}
