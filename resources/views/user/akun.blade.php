@extends('layout.layout')

@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <div class="container h-50">
        <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('akun.tambah') }}" class="btn btn-primary me-3">Tambah Akun</a>
        <form class="d-flex" role="search" action="{{ route('akun.data')}}" method="GET">
            <input type="text" class="form-control me-2" placeholder="Search Data" aria-label="Search" name="search_name">
            <button class="btn btn-primary" type="submit">Search</button>
        </form>
    </div>


    <div class="table-responsive">
        <table class="table table-hover table-bordered">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if (count($users) < 1)
                    <tr>
                        <td colspan="6" class="text-center">Data Akun Kosong</td>
                    </tr>
                @else
                    @php $no = 1 @endphp
                    @foreach ($users as $index => $item)
                        <tr>
                            {{-- <td>{{ ($users->currentPage() - 1) * $users->perPage() + ($index + 1) }}</td> --}}
                            <td>{{ ($users->currentPage() - 1) * $users->perPage() + ($index + 1) }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['email'] }}</td>
                            <td>{{ $item['role']}}</td>
                            <td class="d-flex">
                                <a href={{ route('akun.edit', $item['id']) }} class="btn btn-primary me-2">Edit</a>
                                <button class="btn btn-danger btn-sm"
                                    onclick="showModal('{{ $item->id }}', '{{ $item->name }}')">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <div class="d-flex justify-content-end">
            {{ $users->links() }}
        </div>

        {{-- Modal Hapus --}}

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="form-delete-obat" method="POST">
                    @csrf
                    {{-- menimpa method="POST" diganti menjadi delete, sesuai dengan http
                method untul menghapus data- --}}
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data Akun</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah anda yakin ingin menghapus akun <span id="nama-akun"></span>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                            <button type="submit" class="btn btn-danger" id="confirm-delete">Hapus</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Modal edit stok --}}

        <div class="modal fade" id="modal_edit_stock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="form_edit_stock" method="POST">
                    @csrf
                    {{-- menimpa method="POST" diganti menjadi delete, sesuai dengan http
                method untul menghapus data- --}}
                    @method('PATCH')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Akun</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        {{-- <div class="modal-body">
                            <div class="form-group">
                                <label for="stock" class="form-label">Stok: </label>
                                <input type="number" name="stock" id="stok_edit" class="form-control">
                                @if (Session::get('failed'))
                                    <small class="text-danger">{{ Session::get('failed') }}</small>
                                @endif
                            </div>
                        </div> --}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                            <button type="submit" class="btn btn-danger" id="confirm-delete">Edit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function showModal(id, name) {
            let urlDelete = '{{ route('akun.hapus', ':id') }}';
            urlDelete = urlDelete.replace(":id", id);
            $('#form-delete-obat').attr('action', urlDelete);
            $('#exampleModal').modal('show');
            $('#nama-akun').text(name);
        }
    </script>
@endpush
