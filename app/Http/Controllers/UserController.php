<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $roles = Role::all();
        $users = User::all();
        return view('users.index', compact('users', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'slug_role' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        User::create($request->all());

        Alert::toast('Data Tersimpan', 'success');
        return redirect('user');
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
            'name' => 'required',
            'username' => 'required',
            'slug_role' => 'required',
        ]);

        User::where('slug', $id)->first()->update($request->all());

        Alert::toast('Data Tersimpan', 'success');
        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        User::where('slug', $id)->first()->delete();

        Alert::toast('Data Terhapus', 'success');
        return redirect('user');
    }

    public function confirmPass(Request $request, $id)
    {
        if (!Hash::check($request->passwordAdmin, Auth::user()->password)) {
            return back()->withErrors(['passwordAdmin' => 'Password salah']);
        }
        $user = User::where('slug', $id)->first();
        // dd('berhasil');
        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);
        $password = Hash::make($request->password);
        
        $user->update([
            'password' => $password
        ]);
        Alert::toast('Data Tersimpan', 'success');
        return redirect('user');
    }
}