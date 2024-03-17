<?php

namespace App\Http\Controllers;

use App\Models\PriceList;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PriceListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $priceLists = PriceList::all();
        return view('price-list', compact('priceLists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'size' => 'required|max:5|unique:price_lists',
            'price' => 'required',
            'price_sale' => 'required'
        ]);

        PriceList::create($request->all());
        Alert::toast('Data Tersimpan', 'success');
        return redirect('/price-list');
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
            'size' => 'required',
            'price' => 'required',
            'price_sale' => 'required'
        ]);

        $pl = PriceList::where('id', $id)->first();

        $pl->slug = null;
        $pl->update($request->all());
        Alert::toast('Data Tersimpan', 'success');
        return redirect('/price-list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        PriceList::where('id', $id)->first()->delete();
        Alert::toast('Data Terhapus', 'Success');
        return redirect('/price-list');
    }
}