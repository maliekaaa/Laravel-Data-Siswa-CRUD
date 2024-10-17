@extends('layout.layout')
{{-- extends : import blade --}}

@section('content')
    <div class="d-flex justify-content-end">
        <form class="d-flex" role="search">
            <input type="search" class="form-control me-2" placeholder="Search Data Siswa" aria-label="Search" name="search_data">
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
                <th>NIS</th>
                <th>Jurusan</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if (count($data) < 1)
                <tr>
                    <td colspan="6" class="text-center">Data Siswa/i</td>
                <tr>
                @else
                    @foreach ($data as $index => $item)
                <tr>
                    <td>{{ ($data->currentPage() -1) *  $data->perPage() + ($index + 1)}}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['nis'] }}</td>
                    <td>{{ $item['jurusan'] }}</td>
                    <td>{{ $item['email'] }}</td>
                    <td class="d-flex">
                        {{-- <button class="btn btn-primary me-2">Edit</button> --}}
                        <a href="{{route('data.edit', $item['id'])}}" class="btn btn-primary me-2">Edit</a>
                        <button class="btn btn-danger"
                            onclick="showModal('{{ $item->id }}', '{{ $item['name'] }}')">Hapus</button>
                    </td>
                </tr>
            @endforeach
            @endif
        </tbody>
    </table>
 {{--modal hapus--}}
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form-delete-data" method="POST">
            @csrf
            {{-- menimpa method="POST" diganti menjadi delete, sesuai dengan http
        method untul menghapus data- --}}
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Siswa/i</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin menghapus data <span id="nama-data"></span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-danger" id="confirm-delete">Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div>
{{--modal edit stok--}}
<div class="modal fade" id="modal_edit_stock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form_edit_stock" method="POST">
            @csrf
            {{-- menimpa method="POST" diganti menjadi delete, sesuai dengan http
                 method untul menghapus data- --}}
            @method('PATCH')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   <div class="form-group">
                    <label for="stock_edit" class="form-label">Email</label>
                    <input type="number" name="stock" id="stock_edit" class="form-control">
                    @if (Session::get('failed'))
                    <small class="text-danger">{{ Session::get('failed') }}</small>

                    @endif
                   </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-danger" id="confirm-delete">Edit</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{ $data->links() }}
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function showModal(id, name) {
            // ini untuk url delete di dalam route
            let urlDelete = '{{ route('data.hapus', ':id') }}';
            urlDelete = urlDelete.replace(":id", id);
            // ini untuk action attributenya
            $('#form-delete-data').attr('action', urlDelete);
            // ini untuk showModal
            $('#exampleModal').modal('show');
            // ini untuk mengisi modalnya
            $('#nama-data').text(name);
        }
    </script>
@endpush

