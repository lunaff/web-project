<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        // Validate the input
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:user,email',  // You can add email uniqueness validation
            'password' => 'required|min:6',  // Ensure password has minimum length
            'level' => 'required',
            'guru_nip' => 'nullable',
            'siswa_nis' => 'nullable',
        ]);
    
        $level = $request->input('level');        
        if ($level != 'osis') {
            $request->merge(['siswa_nis' => null]); // Set siswa_nis to null if level is not 'osis'
        }
        if (!in_array($level, ['bk', 'kesiswaan'])) {
            $request->merge(['guru_nip' => null]); // Set guru_nip to null if level is not 'bk' or 'kesiswaan'
        }
    
        // Prepare the data for insertion
        $array = $request->only([
            'name',
            'email',
            'password',
            'level',
            'guru_nip',
            'siswa_nis'
        ]);
    
        $array['password'] = bcrypt($array['password']);
        User::create($array);
    
        // Redirect with success message
        return redirect()->route('user.index')->with('success_message', 'Berhasil menambah User baru');
    }

    public function edit(string $id)
    {
        $user = User::find($id);
        $guru = Guru::all();
        $siswa = Siswa::all();

        if (!$user) return redirect()->route('user.index')
            ->with('error_message', 'User dengan id = ' . $id . ' tidak ditemukan');
        return view('user.edit', compact('user', 'guru', 'siswa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:user,email,' . $id,  // Ensure email is unique except for this user
            'password' => 'nullable|min:6|confirmed', // Password is optional but if filled, must meet the criteria
            'level' => 'required',
            'guru_nip' => 'nullable',
            'siswa_nis' => 'nullable',
        ]);
    
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('user.index')->with('error_message', 'User not found');
        }
    
        // Adjust 'guru_nip' and 'siswa_nis' based on 'level'
        $level = $request->input('level');
        if ($level != 'osis') {
            $request->merge(['siswa_nis' => null]); // Set siswa_nis to null if level is not 'osis'
        }
        if (!in_array($level, ['bk', 'kesiswaan'])) {
            $request->merge(['guru_nip' => null]); // Set guru_nip to null if level is not 'bk' or 'kesiswaan'
        }
    
        // Update the user's information
        $user->name = $request->name;
        $user->email = $request->email;
        $user->level = $request->level;
        $user->guru_nip = $request->guru_nip;
        $user->siswa_nis = $request->siswa_nis;
    
        // Update password only if it's filled
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Save the updated user
        $user->save();
    
        // Redirect with a success message
        return redirect()->route('user.index')->with('success_message', 'Berhasil mengubah User');
    }    

    public function destroy($id)
    {
        // Find the user by ID
        $user = User::find($id);
    
        // Check if the user exists
        if (!$user) {
            return redirect()->route('user.index')
                ->with('error_message', 'User with ID ' . $id . ' not found.');
        }
    
        // Delete the user
        $user->delete();
    
        // Redirect to the user index page with a success message
        return redirect()->route('user.index')
            ->with('success_message', 'User deleted successfully.');
    }
    
}
