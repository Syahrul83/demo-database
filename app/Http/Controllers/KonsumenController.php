<?php

namespace App\Http\Controllers;

use App\Models\Konsumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KonsumenController extends Controller
{
    public function index()
    {
        // Menampilkan semua data dengan Eloquent ORM
        // $customers = Konsumen::all();
        // Menampilkan semua data dengan Query Builder
        // $customers = DB::table('konsumen')->get();

        // Menampilkan data dengan tampilan arrya di tambah toArray()
        // $customers = Konsumen::all()->toArray();

        // Menampilkan data debug dengan dd()
        // dd($customers);
    }
}
