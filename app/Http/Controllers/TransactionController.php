<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 
        $cust  = Customer::get(['name', 'slug']);

        return view('billing', compact('cust'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'name' => 'required|exists:customers,slug',
            'cash' => 'required'
        ]);
        // dd($request);


        $pays = Payment::where('slug_customer', $request->slug)->first();
        $temp = $pays->temporary +  $request->cash;
        $remain = $pays->remaining - $request->cash;
        if ($temp > $pays->total) {
            return back()->withErrors(['cash' => 'pembayaran melebihi target']);
        }
        $pays->update([
            'remaining' => $remain,
            'temporary' => $temp
        ]);
        $trans = Transaction::create([
            'slug_customer' => $request->slug,
            'cash' => $request->cash
        ]);
        $pay = Payment::where('slug_customer', $request->slug)->first();


        if ($pay->temporary >= $pay->total) {
            $cus = Customer::where('id', $request->slug)->first()->update(['status' => 'Lunas']);
        }


        Alert::toast(' Data Tersimpan', 'success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        //
        // dd($request);
        $cus = Customer::where('slug', $request->slug_customer)->first();
        $cust  = Transaction::with('customer')->find($id);
        $pays =  Payment::where('slug_customer', $cust->customer->slug)->first();

        if ($pays->temporary <= $pays->total) {
            $cus->update(['status' => 'Belum Lunas']);
        }

        $pays->update([
            'remaining' => $pays->remaining + $request->cash,
            'temporary' => $pays->temporary  - $request->cash
        ]);

        $cust->delete();

        Alert::toast('Hapus Berhasil', 'success');

        return redirect('customer');
    }
}