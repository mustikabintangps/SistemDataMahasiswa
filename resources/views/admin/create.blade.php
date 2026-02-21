@extends('layouts.app')

@section('title', 'Tambah Data Mahasiswa')

@section('content')
<div class="row mb-4">
    <div class="col">
        <h2 class="fw-bold">
            <i class="bi bi-plus-circle text-primary me-2"></i>
            Tambah Data Mahasiswa
        </h2>
        <p class="text-muted">Isi form berikut untuk menambahkan data mahasiswa baru</p>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('admin.store') }}" method="POST">
            @csrf
            
            <div class="row g-4">
                <!-- NIM -->
                <div class="col-md-6">
                    <label for="nim" class="form-label fw-semibold">NIM <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('nim') is-invalid @enderror" 
                           id="nim" 
                           name="nim" 
                           value="{{ old('nim') }}" 
                           placeholder="Contoh: 2021001"
                           required>
                    @error('nim')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Nama -->
                <div class="col-md-6">
                    <label for="nama" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('nama') is-invalid @enderror" 
                           id="nama" 
                           name="nama" 
                           value="{{ old('nama') }}" 
                           placeholder="Masukkan nama lengkap"
                           required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Alamat -->
                <div class="col-12">
                    <label for="alamat" class="form-label fw-semibold">Alamat <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror" 
                              id="alamat" 
                              name="alamat" 
                              rows="3" 
                              placeholder="Masukkan alamat lengkap"
                              required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Tanggal Lahir -->
                <div class="col-md-6">
                    <label for="tanggal_lahir" class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" 
                           class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                           id="tanggal_lahir" 
                           name="tanggal_lahir" 
                           value="{{ old('tanggal_lahir') }}"
                           required>
                    @error('tanggal_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Gender -->
                <div class="col-md-6">
                    <label for="gender" class="form-label fw-semibold">Gender <span class="text-danger">*</span></label>
                    <select class="form-select @error('gender') is-invalid @enderror" 
                            id="gender" 
                            name="gender" 
                            required>
                        <option value="">Pilih Gender</option>
                        <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Submit Buttons -->
                <div class="col-12 mt-4">
                    <hr>
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('admin.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>Simpan Data
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection