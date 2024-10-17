<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;
use App\Http\Controllers\DataController;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $orderData = $request->short_stock ? 'nis' : 'name';
        $data = Data::where('name', 'LIKE', '%' .$request->search_data . '%')->orderBy($orderData, 'ASC')->simplePaginate(5)->appends($request->all());
        return view ('data.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Data $data)
    {
        //
        return view('data.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Data $data)
    {
        //
        $request->validate([
            'name' => 'required|max:100', // required untuk memastikan inputannya terisi
            'nis' => 'required|min:8',
            'jurusan' => 'required|string', // memastikan nilai inputannya berbentuk angka
            'email' => 'required|string',
        ], [
            'name.required' => 'Nama Siswa/i harus diisi!',
            'nis.required' => 'NIS Siswa/i harus diisi!',
            'jurusan.required' => 'Jurusan harus diisi!',
            'email.required' => 'Email harus diisi!',
        ]);

        // method-method dalam models pada laravel -> ORM atau elequent
        // untuk memanggil sql
        Data::create (attributes:[
            'name' => $request->name, // name pada request adalah dari nama postnya
            'nis' => $request->nis,
            'jurusan' => $request->jurusan,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Berhasil Menambahkan Data Siswa');
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
        $data = Data::find($id);
        return view('data.edit', compact ('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate ([
            'name' => 'required|max:100', // required untuk memastikan inputannya terisi
            'nis' => 'required|min:8',
            'jurusan' => 'required',
            'email' => 'required',
        ]);

        Data::where('id', $id)->update([
            'name' => $request->name, // name pada request adalah dari nama postnya
            'nis' => $request->nis,
            'jurusan' => $request->jurusan,
            'email' => $request->email,
         ]);

         return redirect()->route('data.edit.formulir', ['id'])->with('success', 'Berhasil mengupdate data siswa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteData = data::where('id', $id)->delete();

        if ($deleteData) {
            return redirect ()->back()->with('success', 'Berhasil menghapus data akun');
        } else {
            return redirect ()->back()->with('error', 'Gagal menghapus data akun');
        }
    }
}
