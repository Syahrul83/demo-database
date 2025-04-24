<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    protected $table = 'konsumen';

    // Jika ingin masukan semua data ke dalam database
    // protected $guarded = ['id'];

    // Jika tidak ingin menggunakan timestamp
    // public $timestamps = false;

    protected $fillable = [
        'nama_konsumen',
        'nama_kontak',
        'alamat',
        'kota',
        'kode_post',
        'negara',

    ];

}
