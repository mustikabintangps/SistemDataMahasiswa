@extends('layouts.app')

@section('title', 'HOME - Data Mahasiswa')

@section('content')
<div class="row mb-4">
    <div class="col">
        <h2 class="fw-bold">
            <i class="bi bi-mortarboard-fill text-primary me-2"></i>
            Data Mahasiswa
        </h2>
    </div>
</div>

<!-- Statistik Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-light mb-1">Total Mahasiswa</h6>
                        <h3 class="fw-bold mb-0">{{ $totalMahasiswa }}</h3>
                    </div>
                    <div class="fs-1 opacity-50">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-light mb-1">Laki-laki</h6>
                        <h3 class="fw-bold mb-0">{{ $totalLaki }}</h3>
                    </div>
                    <div class="fs-1 opacity-50">
                        <i class="bi bi-gender-male"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="fw-light mb-1">Perempuan</h6>
                        <h3 class="fw-bold mb-0">{{ $totalPerempuan }}</h3>
                    </div>
                    <div class="fs-1 opacity-50">
                        <i class="bi bi-gender-female"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search Form -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('home') }}" method="GET" class="row g-3">
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
                <p class="text-muted mb-0">Silakan tambahkan data melalui menu ADMIN</p>
            </div>
        @endif
    </div>
</div>
@endsection