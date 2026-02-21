<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use Carbon\Carbon;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nim' => '2021001',
                'nama' => 'Ahmad Fauzi',
                'alamat' => 'Jl. Merdeka No. 123, Jakarta',
                'tanggal_lahir' => '2000-01-15',
                'gender' => 'L',
            ],
            [
                'nim' => '2021002',
                'nama' => 'Budi Santoso',
                'alamat' => 'Jl. Sudirman No. 45, Bandung',
                'tanggal_lahir' => '2001-03-20',
                'gender' => 'L',
            ],
            [
                'nim' => '2021003',
                'nama' => 'Citra Dewi',
                'alamat' => 'Jl. Gatot Subroto No. 67, Surabaya',
                'tanggal_lahir' => '2000-07-10',
                'gender' => 'P',
            ],
            [
                'nim' => '2021004',
                'nama' => 'Dian Permata',
                'alamat' => 'Jl. Ahmad Yani No. 89, Medan',
                'tanggal_lahir' => '2001-11-25',
                'gender' => 'P',
            ],
            [
                'nim' => '2021005',
                'nama' => 'Eko Prasetyo',
                'alamat' => 'Jl. Diponegoro No. 234, Semarang',
                'tanggal_lahir' => '2000-09-05',
                'gender' => 'L',
            ],
        ];

        foreach ($data as $item) {
            $item['usia'] = Carbon::parse($item['tanggal_lahir'])->age;
            Mahasiswa::create($item);
        }
    }
}