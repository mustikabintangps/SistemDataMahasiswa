<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $fillable = [
        'nim',
        'nama',
        'alamat',
        'tanggal_lahir',
        'gender',
        'usia',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($mahasiswa) {
            $mahasiswa->usia = Carbon::parse($mahasiswa->tanggal_lahir)->age;
        });
    }

    public function getUsiaAttribute($value)
    {
        return $value . ' tahun';
    }

    public function scopeGender($query, $gender)
    {
        return $query->where('gender', $gender);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('nama', 'like', "%{$search}%");
    }
}
