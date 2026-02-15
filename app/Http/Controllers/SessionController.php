<?php

namespace App\Http\Controllers;

use App\Models\session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $session = session::where('is_deleted', 'N')->get();
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
        try {
            //code...
            $sesi = new session;
            $sesi->name = $request->name;
            $sesi->date = $request->date;
            $sesi->created_date = Carbon::now();
            $sesi->created_by = Auth::user()->id;
            $sesi->save();
            Alert::toast('Data Tersimpan', 'success');
            return redirect('session');
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
        // 1. Perbaiki validasi agar mengabaikan ID data yang sedang diupdate
        $sesi = session::where('slug', $id)->firstOrFail();

        $request->validate([
            'name' => 'required|unique:sessions,name,' . $sesi->id, // Abaikan ID ini
            'date' => 'required'
        ]);

        try {
            // 2. Update field (Gunakan helper slug jika nama berubah)
            $sesi->name = $request->name;
            $sesi->slug = Str::slug($request->name); // Biasanya slug ikut berubah jika nama berubah
            $sesi->date = $request->date;
            $sesi->updated_by = Auth::id();

            // Laravel otomatis mengisi updated_at, tapi jika Anda pakai kolom custom:
            $sesi->updated_date = now();

            $sesi->save(); // save() lebih umum digunakan untuk update objek

            Alert::toast('Data Berhasil Diperbarui', 'success');
            return redirect('session');
        } catch (\Throwable $th) {
            // Sebaiknya log error jika di tahap produksi
            return back()->withErrors(['error' => 'Gagal memperbarui data: ' . $th->getMessage()]);
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
            $sesi =  session::where('slug', $id)->first();
            $sesi->is_deleted = 'Y';
            $sesi->deleted_by = Auth::user()->id;
            $sesi->deleted_date = Carbon::now();
            $sesi->update();
            Alert::toast('Data Terhapus', 'success');
            return redirect('session');
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th->getMessage());
        }
    }
}
