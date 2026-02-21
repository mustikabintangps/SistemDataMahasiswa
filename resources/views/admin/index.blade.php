@extends('layouts.app')

@section('title', 'ADMIN - Kelola Data Mahasiswa')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2 class="fw-bold">
            <i class="bi bi-gear-fill text-primary me-2"></i>
            Kelola Data Mahasiswa
        </h2>
        <p class="text-muted">Halaman untuk mengelola data mahasiswa (Tambah, Edit, Hapus)</p>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('admin.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Tambah Mahasiswa
        </a>
    </div>
</div>

<!-- Search Form -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('admin.index') }}" method="GET" class="row g-3">
            <div class="col-md-10">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" 
                           class="form-control border-start-0 ps-0" 
                           name="search" 
                           placeholder="Cari mahasiswa berdasarkan nama..." 
                           value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search me-2"></i>Cari
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Tabel Data Mahasiswa -->
<div class="card border-0 shadow-sm">
    <div class="card-body">
        @if($mahasiswas->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Tanggal Lahir</th>
                            <th>Gender</th>
                            <th>Usia</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mahasiswas as $mhs)
                        <tr>
                            <td><span class="fw-semibold">{{ $mhs->nim }}</span></td>
                            <td>{{ $mhs->nama }}</td>
                            <td>{{ Str::limit($mhs->alamat, 30) }}</td>
                            <td>{{ $mhs->tanggal_lahir->format('d/m/Y') }}</td>
                            <td>
                                @if($mhs->gender == 'L')
                                    <span class="badge bg-info">Laki-laki</span>
                                @else
                                    <span class="badge bg-success">Perempuan</span>
                                @endif
                            </td>
                            <td>{{ $mhs->usia }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.edit', $mhs->id) }}" 
                                       class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.destroy', $mhs->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="mt-4">
                {{ $mahasiswas->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                <h5 class="text-muted">Tidak ada data mahasiswa</h5>
                <a href="{{ route('admin.create') }}" class="btn btn-primary mt-3">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Data Pertama
                </a>
            </div>
        @endif
    </div>
</div>
@endsection