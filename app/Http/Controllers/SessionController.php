<?php

namespace App\Http\Controllers;

use App\Models\session;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $session = session::all();
        return view('master.session', compact('session'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|unique:sessions',
            'date' => 'required'
        ]);

        session::create($request->all());
        Alert::toast('Data Tersimpan', 'success');
        return redirect('session');
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
            'name' => 'required|unique:sessions',
            'date' => 'required'
        ]);

       $sess =  session::where('slug', $id)->first();
       $sess->slug = null;
       $sess->update($request->all());
        Alert::toast('Data Tersimpan', 'success');
        return redirect('session');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        session::where('slug', $id)->first()->delete();

        Alert::toast('Data Terhapus', 'success');
        return redirect('session');

    }
}