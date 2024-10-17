<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $users = User::where('name', 'LIKE', '%' . $request->search_data . '%')->orderBy('name', 'ASC')->simplePaginate(15);
        return view('user.akun', compact('users')); // compact () untuk mengirim data ke view (isinya sama dengan $)
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => "required",
            'email' => "required",
            'role' => "required",
            'password' => "required",
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // untuk mengenskripsi data
            'role' => $request->role

        ]);
        return redirect()->route('akun.data')->with('success', 'Berhasil menambahkan data user');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $users = User::where('id', $id)->first();
        return view('user.edit', compact ('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required', // required -> harus diisi
            'email' => 'required',
            'password' => 'nullable',
            'role' => 'required',
        ]);

        // Ambil user berdasarkan ID
        $users = User::findOrFail($id);

        // Update fields
        $users->name = $request->name;
        $users->email = $request->email;
        $users->role = $request->role;

        return redirect()->route('akun.data')->with('success', 'Berhasil mengupdate data user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $deleteData = User::where('id', $id)->delete();

        if ($deleteData) {
            return redirect ()->back()->with('success', 'Berhasil menghapus data akun');
        } else {
            return redirect ()->back()->with('error', 'Gagal menghapus data akun');
        }
    }
}
