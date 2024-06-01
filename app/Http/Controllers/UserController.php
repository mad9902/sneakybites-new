<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

use App\Models\Order;
use Illuminate\Http\Request;

use App\Models\RestoList;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.all_user', compact('users'));
    }
    public function edit($id)
    {
        $users = User::findOrFail($id);
        return view('admin.edit_user', compact('users'));
    }

    public function create()
    {
        return view('admin.create_user');
    }

    public function store(Request $req)
    {
        $req->validate([
            'role' => 'required|in:admin,resto,user',
        ]);

        $newRole = $req->input('role');

        if ($newRole == 'admin') {
            $is_admin = true;
            $is_resto = false;
        } elseif ($newRole == 'resto') {
            $is_admin = false;
            $is_resto = true;
        } else {
            $is_admin = false;
            $is_resto = false;
        }

        User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'is_admin' => $is_admin,
            'is_resto' => $is_resto,
            'address' => $req->address,
            'phone_number' => $req->phone_number,
        ]);

        return redirect('/users')->with('status', 'User berhasil dibuat');
    }

    public function update(Request $req, $id)
    {
        $users = User::findOrFail($id);


        $req->validate([
            'role' => 'required|in:admin,resto,user',
        ]);

        // Role baru yang dipilih
        $newRole = $req->input('role');

        // Hanya bisa ada satu role per user, jadi perlu mengatur role yang lain menjadi false
        if ($newRole == 'admin') {
            $is_admin = true;
            $is_resto = false;
        } elseif ($newRole == 'resto') {
            $is_admin = false;
            $is_resto = true;
        } else {
            $is_admin = false;
            $is_resto = false;
        }

        $users->update([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'is_admin' => $is_admin,
            'is_resto' => $is_resto,
            'address' => $req->address,
            'phone_number' => $req->phone_number,

        ]);
        return redirect('/users')->with('status', 'User berhasil diubah');
    }


    public function destroy($id)
    {
        $users = User::findOrFail($id);
        $users->delete();

        return redirect('/users')->with('status', 'Restoran berhasil dihapus');
    }
}

