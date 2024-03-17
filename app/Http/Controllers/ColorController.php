<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $colors = Color::all();
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

        Color::create($request->all());

        Alert::toast('Data Tersimpan', 'success');
        return redirect('color');
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

        $color = Color::where('slug', $id)->first();
        $color->slug = null;

        $color->update($request->all());

        Alert::toast('Data Tersimpan', 'success');
        return redirect('color');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Color::where('slug', $id)->first()->delete();
        
         Alert::toast('Data Terhapus', 'success');
        return redirect('color');
    }
}