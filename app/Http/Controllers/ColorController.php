<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $colors = Color::where('is_deleted', 'N')->get();
        return view('master.color', compact('colors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|unique:colors'
        ]);

        try {
            //code...
            $color = new Color;
            $color->name= $request->name;
            $color->created_by = Auth::user()->id;
            $color->created_date = Carbon::now();
            $color->save();
            Alert::toast('Data Tersimpan', 'success');
            return redirect('color');
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
            'name' => 'required|unique:colors'
        ]);

        try {
            //code...
            $color = Color::where('slug', $id)->first();
            $color->name= $request->name;
            $color->slug = null;
            $color->updated_date = Carbon::now();
            $color->updated_by = Auth::user()->id;
            $color->update();

            Alert::toast('Data Tersimpan', 'success');
            return redirect('color');
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
            $color  = Color::where('slug', $id)->first();
            $color->deleted_date = Carbon::now();
            $color->deleted_by = Auth::user()->id;
            $color->is_deleted = 'Y';
            $color->update();

            Alert::toast('Data Terhapus', 'success');
            return redirect('color');
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th->getMessage());
        }
    }
}
