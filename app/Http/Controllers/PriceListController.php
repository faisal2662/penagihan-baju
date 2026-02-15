<?php

namespace App\Http\Controllers;

use App\Models\PriceList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PriceListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $priceLists = PriceList::where('is_deleted', 'N')->get();
        return view('master.price-list', compact('priceLists'));
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

        try {
            $priceList = new PriceList;
            $priceList->size = $request->size;
            $priceList->price_sale = str_replace(',', '', $request->price_sale);
            $priceList->price = str_replace(',', '', $request->price);
            $priceList->created_by = Auth::user()->id;
            $priceList->created_date = Carbon::now();
            $priceList->save();

            Alert::toast('Data Tersimpan', 'success');
            return redirect('/price-list');
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th->getMessage());
        }
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

        try {
            $priceList = PriceList::where('id', $id)->first();
            $priceList->size = $request->size;
            $priceList->price_sale = str_replace(',', '', $request->price_sale);
            $priceList->price = str_replace(',', '', $request->price);
            $priceList->updated_by = Auth::user()->id;
            $priceList->updated_date = Carbon::now();
            $priceList->update();

            Alert::toast('Data Tersimpan', 'success');
            return redirect('/price-list');
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        try {
            $priceList = PriceList::where('id', $id)->first();
            $priceList->deleted_by = Auth::user()->id;
            $priceList->deleted_date = Carbon::now();
            $priceList->is_deleted = 'Y';
            $priceList->update();

            Alert::toast('Data Terhapus', 'success');
            return redirect('/price-list');
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th->getMessage());
        }
    }
}
