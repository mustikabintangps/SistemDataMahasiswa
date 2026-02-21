<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Mahasiswa::orderBy('nim', 'desc');
        
        if ($request->has('search') && !empty($request->search)) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }
        
        $mahasiswas = $query->paginate(10)->withQueryString();
        
        $totalMahasiswa = Mahasiswa::count();
        
        $totalLaki = Mahasiswa::where('gender', 'L')->count();
        $totalPerempuan = Mahasiswa::where('gender', 'P')->count();
        
        return view('home', compact(
            'mahasiswas', 
            'totalMahasiswa', 
            'totalLaki', 
            'totalPerempuan'
        ));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:20|unique:mahasiswas,nim',
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'gender' => 'required|in:L,P',
        ]);

        $usia = Carbon::parse($request->tanggal_lahir)->age;
        
        $data = $request->all();
        $data['usia'] = $usia;
        
        Mahasiswa::create($data);
        
        return redirect()->route('admin.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function show(Mahasiswa $mahasiswa)
    {
        return view('admin.show', compact('mahasiswa'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('admin.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'gender' => 'required|in:L,P',
        ]);

        $usia = Carbon::parse($request->tanggal_lahir)->age;
        
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

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        
        return redirect()->route('admin.index')
            ->with('success', 'Data mahasiswa berhasil dihapus.');
    }

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