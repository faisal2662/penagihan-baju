<?php

namespace App\Http\Controllers;

use App\Models\DownPayment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DownPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $dp = DownPayment::get();
        return view('down-payment', compact('dp'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //\
        $request->validate([
            'description' => 'required',
            'nominal' => 'required',
            'date' => 'required'
        ]);

        DownPayment::create($request->all());

        Alert::toast('Data Tersimpan', 'success');
        return redirect('/down-payment');
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
          $request->validate([
            'description' => 'required',
            'nominal' => 'required',
            'date' => 'required'
        ]);

        DownPayment::where('id' , $id)->first()->update($request->all());

        Alert::toast('Data Tersimpan', 'success');
        return redirect('/down-payment');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        DownPayment::where('id',$id)->first()->delete();
               Alert::toast('Data Terhapus', 'success');
        return redirect('/down-payment');
    }
}