@extends('layout.layout')

@section('content')
<form action="{{ route('data.tambah_data.formulir') }}" method="POST" class="card-p-5">
    @csrf
    @if(Session::get('success'))
        <div class="alert alert-success">
            {{Session ('success')}}
        </div>
    @endif
    @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all () as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
                </div>
    @endif
    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label">Nama : </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" placeholder="Masukkan Nama Lengkap">

        </div>
    </div>
    <div class="mb-3 row">
        <label for="type" class="col-sm-2 col-form-label">Jurusan :</label>
        <div class="col-sm-10">
            <select class="form-select" id="jurusan" name="jurusan"> <option selected disabled hidden> Pilih</option>
                <option value="pplg" {{ old('jurusan') == 'pplg' ? 'selected' : ''}}>PPLG</option>
                <option value="tjkt" {{ old('jurusan') == 'tjkt' ? 'selected' : ''}}>TJKT</option>
                <option value="dkv" {{ old('jurusan') == 'dkv' ? 'selected' : ''}}>DKV</option>
                <option value="mplb" {{ old('jurusan') == 'mplb' ? 'selected' : ''}}>MPLB</option>
                <option value="pmn" {{ old('jurusan') == 'pmn' ? 'selected' : ''}}>PMN</option>
                <option value="kln" {{ old('jurusan') == 'kln' ? 'selected' : ''}}>KLN</option>
                <option value="htl" {{ old('jurusan') == 'htl' ? 'selected' : ''}}>HTL</option>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="nis" class="col-sm-2 col-form-label">NIS : </label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="nis" name="nis" value="{{old('nis')}}">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="email" class="col-sm-2 col-form-label">Email : </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Tambah Data</button>
</form>
@endsection
