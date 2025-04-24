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
