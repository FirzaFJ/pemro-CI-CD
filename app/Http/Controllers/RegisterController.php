<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('registrasi.index', [
            'title' => 'Registrasi'
        ]);
    }

    public function register(Request $request)
    {
        // return $request;
        $validateData= $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:255'
        ]);

        User::create($validateData);
        return redirect('/')->with('success', 'Registrasi Berhasil, Silahkan Login!');
    }
}
