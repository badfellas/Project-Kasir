<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Good;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\Customer;
use PDF;

class CashierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.cashiers.index', [
            'active' => 'cashier',
            'transactions' => Transaction::with('user')->latest()->get()
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createtransaction()
    {
        return view('dashboard.cashiers.transaction.create', [
            'active' => 'cashier',
            'users' => User::all(),
            'customers' => Customer::all(),
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createorder(Request $request)
    {
        return view('dashboard.cashiers.order.create', [
            'active' => 'cashier',
            'goods' => Good::all(),
            'no_nota' => $request->no_nota,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storetransaction(Request $request)
    {
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'no_nota' => 'required|string',
            'tgl_transaksi' => 'required|date',
            'user_id' => 'required|integer',
            'nama_pembeli' => 'required|string',
        ]);
    
        // Buat transaksi baru menggunakan Eloquent
        $transaction = Transaction::create([
            'no_nota' => $validatedData['no_nota'],
            'tgl_transaksi' => $validatedData['tgl_transaksi'],
            'user_id' => $validatedData['user_id'],
            'nama_pembeli' => $validatedData['nama_pembeli'],
            'status' => 'pending', // Status default
            'total_harga' => 0,    // Total harga default
            'bayar' => 0,          // Nilai default untuk bayar
            'kembalian' => 0,      // Nilai default untuk kembalian
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        
    
        // Redirect ke halaman order dengan data yang sesuai
        return view('dashboard.cashiers.order.index', [
            'active' => 'cashier',
            'goods' => Good::all(),
            'orders' => Order::where('no_nota', $transaction->no_nota)->get(),
            'no_nota' => $transaction->no_nota,
        ])->with('success', 'Transaksi berhasil dibuat.');
    }

    public function storeorder(Request $request)
    {
        $barang = Good::where('id', $request['good_id'])->first();
        $harga = $barang->harga;
        Order::create([
            'no_nota' => $request->no_nota,
            'good_id' => $request->good_id,
            'qty' => $request->qty,
            'subtotal' => $request->subtotal,
            'price' => $harga,
        ]);
        Good::find($request->good_id)->decrement('stok', $request->qty);
        return view('dashboard.cashiers.order.index', [
            'no_nota' => $request['no_nota'],
            'orders' => Order::where('no_nota', $request['no_nota'])->get(),
            'goods' => Good::all(),
            'active' => 'cashier',
        ])->with('success', 'Pesanan telah ditambahkan.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function finishing(Request $request)
    {
        $rules = [
            'id' => $request->id,
            'status' => $request->status,
            'total_harga' => $request->total_harga,
            'bayar' => $request->bayar,
            'kembalian' => $request->kembalian,
        ];

        Transaction::where('id', $request->id)->update($rules);

       
        return redirect('/dashboard/cashier')->with('success', 'Transaksi Sukses!');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function nota(Request $request)
{
    // Ambil no_nota dari request
    $no_nota = $request->no_nota;
    
    // Cari transaksi tunggal (single transaction)
    $transaction = Transaction::where('no_nota', $no_nota)->first();
    
    // Jika transaksi tidak ditemukan
    if (!$transaction) {
        return redirect()->back()->with('error', 'Transaksi tidak ditemukan');
    }
    
    // Ambil semua order yang terkait
    $orders = Order::with('good')
                  ->where('no_nota', $no_nota)
                  ->get();
                  
    // Jika tidak ada order
    if ($orders->isEmpty()) {
        return redirect()->back()->with('error', 'Detail order tidak ditemukan');
    }
    
    // Generate PDF
    $pdf = PDF::loadView('nota_pdf', [
        'transaction' => $transaction,
        'orders' => $orders
    ]);
    
    // Download PDF
    return $pdf->download('nota_'.$no_nota.'.pdf');
}
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request)
    {
        return view('dashboard.cashiers.checkout', [
            'active' => 'cashier',
            'no_nota' => $request->no_nota,
            'total_harga' => $request->total_harga,
            'users' => User::all(),
            'transaction' => Transaction::where('no_nota', $request->no_nota)->first(),
        ]);
    }
}
