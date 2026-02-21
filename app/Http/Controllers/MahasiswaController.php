<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MahasiswaController extends Controller
{
    /**
     * Menampilkan list data.
     * Halaman HOME: Menampilkan data mahasiswa descending by NIM
     */
    public function index(Request $request)
    {
        // Query dasar dengan pengurutan descending by NIM
        $query = Mahasiswa::orderBy('nim', 'desc');
        
        // Fitur pencarian berdasarkan nama
        if ($request->has('search') && !empty($request->search)) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }
        
        // Ambil data dengan pagination 
        $mahasiswas = $query->paginate(10)->withQueryString();
        
        // Hitung total data
        $totalMahasiswa = Mahasiswa::count();
        
        // Statistik berdasarkan gender
        $totalLaki = Mahasiswa::where('gender', 'L')->count();
        $totalPerempuan = Mahasiswa::where('gender', 'P')->count();
        
        return view('home', compact(
            'mahasiswas', 
            'totalMahasiswa', 
            'totalLaki', 
            'totalPerempuan'
        ));
    }

    /**
     * Halaman form tambah data
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nim' => 'required|string|max:20|unique:mahasiswas,nim',
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'gender' => 'required|in:L,P',
        ]);

        // Hitung usia
        $usia = Carbon::parse($request->tanggal_lahir)->age;
        
        // Gabungkan data request dengan usia
        $data = $request->all();
        $data['usia'] = $usia;
        
        // Simpan data
        Mahasiswa::create($data);
        
        return redirect()->route('admin.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    /**
     * Menampilkan Halaman admin
     */
    public function show(Mahasiswa $mahasiswa)
    {
        return view('admin.show', compact('mahasiswa'));
    }

    /**
     *Menampilkan tampilan untuk edit.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('admin.edit', compact('mahasiswa'));
    }

    /**
     * Update data
     * NIM tidak bisa diubah
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        // Validasi data - NIM tidak divalidasi unique karena tidak diubah
        $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'gender' => 'required|in:L,P',
        ]);

        // Hitung usia terbaru
        $usia = Carbon::parse($request->tanggal_lahir)->age;
        
        // Update data (NIM tidak disertakan)
        $mahasiswa->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'gender' => $request->gender,
            'usia' => $usia,
        ]);
        
        return redirect()->route('admin.index')
            ->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    /**
     * Menghapus salah satu data
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        
        return redirect()->route('admin.index')
            ->with('success', 'Data mahasiswa berhasil dihapus.');
    }

    /**
     * Halaman ADMIN: Menampilkan semua data untuk pengelolaan
     */
    public function adminIndex(Request $request)
    {
        $query = Mahasiswa::orderBy('created_at', 'desc');
        
        if ($request->has('search') && !empty($request->search)) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }
        
        $mahasiswas = $query->paginate(10);
        
        return view('admin.index', compact('mahasiswas'));
    }
}
