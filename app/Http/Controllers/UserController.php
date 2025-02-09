<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function show()
    {
        // Fetch all users from the `user` table
        $users = User::all()->map(function ($user) {
            // Ganti semua field yang null menjadi '-'
            foreach ($user->getAttributes() as $key => $value) {
                $user->{$key} = $value ?? '-';
            }
            return $user;
        });  
        // Return data as JSON for the Grid.js table
        return response()->json($users);
    }
    
    public function index()
    {
        return view('user.index'); // Pastikan view ada di resources/views/dashboard/dashboard.blade.php
    }

    public function create()
    {
        $guru = Guru::all();
        $siswa = Siswa::all();
        return view('user.create', compact('guru', 'siswa')); // Pastikan view ada di resources/views/dashboard/dashboard.blade.php
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'level' => 'required',
            'guru_nip' => 'nullable',
            'siswa_nis' => 'nullable',
        ]);

        $array = $request->only([
            'name',
            'email',
            'password',
            'level',
            'guru_nip',
            'siswa_nis'
        ]);

        User::create($array);
        return redirect()->route('user.index')->with('success_message', 'Berhasil menambahUser baru');
    }

}
