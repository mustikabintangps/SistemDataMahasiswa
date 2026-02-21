@extends('layouts.app')

@section('title', 'Edit Data Mahasiswa')

@section('content')
<div class="row mb-4">
    <div class="col">
        <h2 class="fw-bold">
            <i class="bi bi-pencil-square text-warning me-2"></i>
            Edit Data Mahasiswa
        </h2>
        <p class="text-muted">Ubah data mahasiswa (NIM tidak dapat diubah)</p>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('admin.update', $mahasiswa->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row g-4">
                <!-- NIM (Readonly/Tidak Bisa Diubah) -->
                <div class="col-md-6">
                    <label for="nim" class="form-label fw-semibold">NIM</label>
                    <input type="text" 
                           class="form-control bg-light" 
                           id="nim" 
                           value="{{ $mahasiswa->nim }}" 
                           readonly
                           disabled>
                    <small class="text-muted">NIM tidak dapat diubah</small>
                </div>
                
                <!-- Nama -->
                <div class="col-md-6">
                    <label for="nama" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('nama') is-invalid @enderror" 
                           id="nama" 
                           name="nama" 
                           value="{{ old('nama', $mahasiswa->nama) }}" 
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
                              required>{{ old('alamat', $mahasiswa->alamat) }}</textarea>
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
                           value="{{ old('tanggal_lahir', $mahasiswa->tanggal_lahir->format('Y-m-d')) }}"
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
                        <option value="L" {{ old('gender', $mahasiswa->gender) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('gender', $mahasiswa->gender) == 'P' ? 'selected' : '' }}>Perempuan</option>
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
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-save me-2"></i>Update Data
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection