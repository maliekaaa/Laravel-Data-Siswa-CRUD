@extends('layout.layout')

@section('content')
<div class="d-flex justify-content-center mt-5">
    <form action="{{ route('akun.edit.formulir', $users['id']) }}" method="POST" class="card p-4 shadow-sm rounded" style="width: 50%;">
        @csrf
        @method('PATCH')
        @if (Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ( $errors->all() as $error )
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nama:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{ $users['name']}}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">Email:</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" value="{{ $users['email'] }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="password" class="col-sm-2 col-form-label">Password:</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="password" value="{{ $users['password'] }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="role" class="col-sm-2 col-form-label">Role :</label>
            <div class="col-sm-10">
                <select class="form-select" id="role" name="role">
                    <option selected disabled hidden>Pilih</option>
                    <option value="admin" {{ old('role') == 'pembimbing' ? 'selected' : '' }}>Pembimbing</option>
                    <option value="user" {{ old('role') == 'pengurus' ? 'selected' : '' }}>Pengurus</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100">Tambah Data</button>
    </form>
</div>
@endsection
