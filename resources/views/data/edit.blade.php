@extends('layout.layout')

@section('content')
    <div class="d-flex justify-content-center mt-5">
        <form action="{{ route('data.edit.formulir', $data->id) }}" method="POST" enctype="multipart/form-data"
            class="card p-4 shadow-sm rounded" style="width: 50%;">
            @csrf
            @method('PATCH')
                @if (Session::get('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-3">
                <label for="name" class="form-label">Nama :</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama obat"
                    value="{{ $data['name'] }}">
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Jurusan :</label>
                <select class="form-select" id="jurusan" name="jurusan">
                    <option selected disabled hidden>Pilih Jurusan</option>
                    <option value="pplg" {{ old('jurusan') == 'pplg' ? 'selected' : '' }}>PPLG</option>
                    <option value="tjkt" {{ old('jurusan') == 'tjkt' ? 'selected' : '' }}>TJKT</option>
                    <option value="dkv" {{ old('jurusan') == 'dkv' ? 'selected' : '' }}>DKV</option>
                    <option value="mplb" {{ old('jurusan') == 'mplb' ? 'selected' : '' }}>MPLB</option>
                    <option value="pmn" {{ old('jurusan') == 'pmn' ? 'selected' : '' }}>PMN</option>
                    <option value="kln" {{ old('jurusan') == 'kln' ? 'selected' : '' }}>KLN</option>
                    <option value="htl" {{ old('jurusan') == 'htl' ? 'selected' : '' }}>HTL</option>
                </select>
            </div>

            <div class="row">
                <div class="mb-3 row">
                    <label for="nis" class="col-sm-2 col-form-label">NIS : </label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="nis" name="nis"
                            value="{{ old('nis') }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">Email : </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email"
                            value="{{ old('email') }}">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Update Data Siswa</button>
        </form>
    </div>
@endsection
