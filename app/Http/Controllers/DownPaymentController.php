<?php

namespace App\Http\Controllers;

use App\Models\DownPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DownPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $dp = DownPayment::where('is_deleted', 'N')->get();
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

        try {
            //code...
            $dp = new DownPayment;
            $dp->description = $request->description;
            $dp->nominal = str_replace(',', '', $request->nominal);
            $dp->date = $request->date;
            $dp->created_date = Carbon::now();
            $dp->created_by = Auth::user()->id;

            $dp->save();


            Alert::toast('Data Tersimpan', 'success');
            return redirect('/down-payment');
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
            'description' => 'required',
            'nominal' => 'required',
            'date' => 'required'
        ]);

        try {
            //code...
            $dp = DownPayment::where('id', $id)->first();
            $dp->description = $request->description;
            $dp->nominal = str_replace(',', '', $request->nominal);
            $dp->date = $request->date;
            $dp->updated_date = Carbon::now();
            $dp->updated_by = Auth::user()->id;

            $dp->update();

            Alert::toast('Data Tersimpan', 'success');
            return redirect('/down-payment');
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
            //code...
            $dp = DownPayment::where('id', $id)->first();
            $dp->deleted_date = Carbon::now();
            $dp->deleted_by = Auth::user()->id;
            $dp->is_deleted = 'Y';
            $dp->update();
            Alert::toast('Data Terhapus', 'success');
            return redirect('/down-payment');
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th->getMessage());
        }
    }
}
