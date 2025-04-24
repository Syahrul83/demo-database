<?php

// di gunaka n jika depanya DB::******
use Illuminate\Support\Facades\DB;

// di gunakan jika depanya Customer::******
use App\Models\Customer;

//di model
class Customer extends Model
{
    protected $fillable = ['CustomerName', 'ContactName', 'Address', 'City', 'PostalCode', 'Country'];
}

# memunculkan semua data
// In Laravel's Eloquent ORM,
// SELECT * FROM Customers
$customers = Customer::all();

//Alternative with Query Builder:
$customers = DB::table('customers')->get();

// menuncul kan filed tertentu
// SELECT CustomerName, City FROM Customers;
$customers = Customer::select('CustomerName', 'City')->get();
$customers = DB::table('customers')->select('CustomerName', 'City')->get();

// cari yang beda
// SELECT DISTINCT Country FROM Customers;
$countries = Customer::select('Country')->distinct()->get();
$countries = DB::table('customers')->select('Country')->distinct()->get();

// menghitung jumlah data
// SELECT COUNT(DISTINCT Country) FROM Customers;
$count = DB::table('customers')->distinct()->count('Country');
$count = Customer::distinct('Country')->count('Country');


// menghitung jumlah data dari field tertentu
// SELECT * FROM Customers WHERE Country='Mexico';
$customers = DB::table('customers')->where('Country', 'Mexico')->get();
$customers = Customer::where('Country', 'Mexico')->get();

//SELECT * FROM Customers WHERE CustomerID > 80;
$customers = DB::table('customers')->where('CustomerID', '>', 80)->get();
$customers = Customer::where('CustomerID', '>', 80)->get();


// order by
// SELECT * FROM Products ORDER BY Price;
$products = Product::orderBy('Price', 'desc')->get();
$products = DB::table('products')->orderBy('Price')->get();

// and
// SELECT * FROM Customers WHERE Country = 'Brazil' AND City = 'Rio de Janeiro' AND CustomerID > 50;
$customers = Customer::where('Country', 'Brazil')
    ->where('City', 'Rio de Janeiro')
    ->where('CustomerID', '>', 50)
    ->get();

$customers = DB::table('customers')
    ->where('Country', 'Brazil')
    ->where('City', 'Rio de Janeiro')
    ->where('CustomerID', '>', 50)
    ->get();


// and or
// SELECT * FROM Customers WHERE Country = 'Spain' AND (CustomerName LIKE 'G%' OR CustomerName LIKE 'R%');
$customers = Customer::where('Country', 'Spain')
    ->where(function ($query) {
        $query->where('CustomerName', 'LIKE', 'G%')
            ->orWhere('CustomerName', 'LIKE', 'R%');
    })
    ->get();



$customers = DB::table('customers')
    ->where('Country', 'Spain')
    ->where(function ($query) {
        $query->where('CustomerName', 'LIKE', 'G%')
            ->orWhere('CustomerName', 'LIKE', 'R%');
    })
    ->get();


// or where
// SELECT * FROM Customers WHERE Country = 'Germany' OR Country = 'Spain';
$customers = Customer::where('Country', 'Germany')
    ->orWhere('Country', 'Spain')
    ->get();

$customers = DB::table('customers')->where('Country', 'Germany')
    ->orWhere('Country', 'Spain')
    ->get();

// where not
// SELECT * FROM Customers WHERE NOT Country = 'Spain';
$customers = DB::table('customers')->whereNot('Country', 'Spain')->get();


// insert into
// INSERT INTO Customers (CustomerName, ContactName, Address, City, PostalCode, Country)
// VALUES ('Cardinal', 'Tom B. Erichsen', 'Skagen 21', 'Stavanger', '4006', 'Norway');

Customer::create([
    'CustomerName' => 'Cardinal',
    'ContactName' => 'Tom B. Erichsen',
    'Address' => 'Skagen 21',
    'City' => 'Stavanger',
    'PostalCode' => '4006',
    'Country' => 'Norway',
]);



DB::table('customers')->insert([
    'CustomerName' => 'Cardinal',
    'ContactName' => 'Tom B. Erichsen',
    'Address' => 'Skagen 21',
    'City' => 'Stavanger',
    'PostalCode' => '4006',
    'Country' => 'Norway',
]);





// update
// UPDATE Customers SET ContactName = 'Alfred Schmidt', City = 'Frankfurt'  WHERE CustomerID = 1;

Customer::where('CustomerID', 1)->update([
    'ContactName' => 'Alfred Schmidt',
    'City' => 'Frankfurt',
]);

DB::table('customers')
    ->where('CustomerID', 1)
    ->update([
        'ContactName' => 'Alfred Schmidt',
        'City' => 'Frankfurt',
    ]);



// delete
// DELETE FROM Customers WHERE CustomerID = 1;
Customer::where('CustomerID', 1)->delete();

DB::table('customers')->where('CustomerID', 1)->delete();



// DELETE FROM Customers WHERE Country = 'Germany';
Customer::where('Country', 'Germany')->delete();
DB::table('customers')->where('Country', 'Germany')->delete();


// Dalam konteks Laravel, **Eloquent ORM** dan **Query Builder** adalah dua cara untuk berinteraksi dengan database. Keduanya memiliki keuntungan dan kelemahan, tergantung pada kebutuhan proyek. Berikut adalah perbandingan mendetail:

// ---

// ### **Keuntungan Eloquent ORM**
// 1. **Abstraksi Tingkat Tinggi**:
//    - Eloquent menggunakan model berbasis objek yang merepresentasikan tabel database. Ini membuat kode lebih intuitif dan mudah dibaca, terutama untuk pengembang yang terbiasa dengan paradigma OOP (Object-Oriented Programming).
//    - Contoh: `Customer::where('Country', 'Spain')->get()` terasa lebih alami daripada query SQL mentah.

// 2. **Relasi Antar Tabel**:
//    - Eloquent menyediakan fitur relasi (one-to-one, one-to-many, many-to-many, dll.) yang mudah dikonfigurasi dan digunakan.
//    - Contoh: `$customer->orders` dapat langsung mengakses pesanan pelanggan tanpa menulis JOIN manual.

// 3. **Fitur Bawaan**:
//    - Mendukung fitur seperti soft deletes, timestamps, dan mutator/accessor secara otomatis.
//    - Contoh: Soft delete dapat diaktifkan hanya dengan menambahkan trait `SoftDeletes`.

// 4. **Keamanan Mass Assignment**:
//    - Eloquent memiliki mekanisme `$fillable` atau `$guarded` untuk mencegah mass assignment yang tidak diinginkan, meningkatkan keamanan.

// 5. **Kode Lebih Ringkas untuk Operasi CRUD**:
//    - Operasi seperti `create`, `update`, `delete`, atau `find` sangat sederhana.
//    - Contoh: `Customer::create($data)` lebih ringkas dibandingkan menulis query INSERT.

// 6. **Portabilitas Database**:
//    - Eloquent bekerja dengan berbagai database (MySQL, PostgreSQL, SQLite, dll.) tanpa perlu mengubah banyak kode, karena query dihasilkan secara otomatis.

// ---

// ### **Kelemahan Eloquent ORM**
// 1. **Performa Lebih Lambat**:
//    - Eloquent menambahkan overhead karena abstraksi tingkat tinggi dan pembuatan objek model. Ini bisa lebih lambat dibandingkan Query Builder untuk query kompleks atau data besar.
//    - Contoh: Mengambil ribuan baris dengan Eloquent menghasilkan banyak objek, yang memakan memori.

// 2. **Kurang Fleksibel untuk Query Kompleks**:
//    - Untuk query SQL yang sangat spesifik atau kompleks (misalnya subquery atau CTE), Eloquent bisa terasa membatasi, dan sering kali perlu menggunakan query raw.

// 3. **Kurva Belajar**:
//    - Pengembang baru mungkin perlu waktu untuk memahami konsep seperti relasi, mutator, atau event model.

// 4. **Memori Lebih Banyak**:
//    - Karena setiap baris diubah menjadi objek model, Eloquent menggunakan lebih banyak memori dibandingkan Query Builder, terutama untuk dataset besar.

// 5. **Risiko "N+1 Query Problem"**:
//    - Jika relasi tidak dimuat dengan benar (eager loading), Eloquent dapat menghasilkan banyak query tambahan.
//    - Contoh: Mengakses `$customer->orders` dalam loop tanpa `with('orders')` menyebabkan query berulang.

// ---

// ### **Keuntungan Query Builder**
// 1. **Performa Lebih Cepat**:
//    - Query Builder lebih ringan karena tidak membuat objek model, sehingga cocok untuk query besar atau performa kritis.
//    - Contoh: `DB::table('customers')->get()` lebih cepat dan hemat memori dibandingkan `Customer::all()`.

// 2. **Fleksibilitas Tinggi**:
//    - Query Builder memungkinkan penulisan query yang mendekati SQL mentah, sehingga lebih mudah untuk query kompleks seperti JOIN, subquery, atau agregasi.

// 3. **Kontrol Penuh atas Query**:
//    - Anda dapat menyesuaikan query dengan presisi tinggi tanpa abstraksi tambahan.
//    - Contoh: `DB::table('customers')->selectRaw('COUNT(*) as count')->get()`.

// 4. **Kurva Belajar Lebih Rendah**:
//    - Query Builder lebih mirip SQL, sehingga lebih mudah dipahami oleh pengembang yang sudah terbiasa dengan SQL.

// 5. **Memori Efisien**:
//    - Hasil query dikembalikan sebagai array atau koleksi sederhana, bukan objek model, sehingga lebih hemat memori.

// ---

// ### **Kelemahan Query Builder**
// 1. **Kode Kurang Intuitif**:
//    - Query Builder tidak menggunakan pendekatan berbasis model, sehingga kode bisa terlihat lebih verbose dan kurang terstruktur dibandingkan Eloquent.
//    - Contoh: Mengelola relasi antar tabel memerlukan JOIN manual.

// 2. **Tidak Ada Fitur Relasi Bawaan**:
//    - Tidak seperti Eloquent, Query Builder tidak mendukung relasi antar tabel secara otomatis, sehingga Anda harus menulis query JOIN sendiri.

// 3. **Raw Query Berisiko**:
//    - Jika tidak hati-hati, penggunaan query raw di Query Builder dapat menyebabkan risiko SQL injection jika input tidak di-sanitize dengan benar.

// 4. **Kurangnya Fitur Otomatis**:
//    - Query Builder tidak memiliki fitur seperti soft deletes, timestamps, atau mutator bawaan, yang harus diimplementasikan secara manual.

// 5. **Perawatan Kode Lebih Sulit**:
//    - Untuk proyek besar, kode Query Builder bisa menjadi sulit dikelola karena tidak ada struktur model yang jelas.

// ---

// ### **Kapan Menggunakan Eloquent ORM vs Query Builder?**
// - **Gunakan Eloquent ORM** jika:
//   - Anda membutuhkan abstraksi tingkat tinggi dan kode yang mudah dibaca.
//   - Proyek melibatkan relasi antar tabel (misalnya, hasMany, belongsTo).
//   - Anda ingin fitur bawaan seperti soft deletes, timestamps, atau mass assignment protection.
//   - Performa bukan prioritas utama, atau dataset relatif kecil.

// - **Gunakan Query Builder** jika:
//   - Anda membutuhkan performa optimal atau bekerja dengan dataset besar.
//   - Query sangat kompleks dan sulit diimplementasikan dengan Eloquent.
//   - Anda tidak memerlukan fitur model seperti relasi atau soft deletes.
//   - Anda ingin kontrol penuh atas query SQL.

// ---

// ### **Kesimpulan**
// - **Eloquent ORM** unggul dalam produktivitas, kemudahan penggunaan, dan fitur bawaan, tetapi kurang efisien untuk query besar atau kompleks.
// - **Query Builder** menawarkan performa lebih baik dan fleksibilitas, tetapi kurang intuitif dan tidak memiliki fitur model bawaan.
// - Dalam praktiknya, banyak proyek menggunakan kombinasi keduanya: Eloquent untuk operasi CRUD sederhana dan relasi, serta Query Builder untuk query performa tinggi atau kompleks.

// Jika Anda memiliki kasus spesifik atau ingin contoh lebih lanjut, beri tahu saya!
