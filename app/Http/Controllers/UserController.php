<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
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
        $roles = Role::where('is_deleted', 'N')->get();
        $users = User::with('Role')->where('users.is_deleted', 'N')->get();
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
            'username' => 'required|unique:users,username',
            'role_id' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        $user  = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->role_id = $request->role_id;
        $user->password = Hash::make($request->password);
        $user->number = $request->number;
        $user->created_by = Auth::user()->id;
        $user->created_date = Carbon::now();
        $user->save();

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
            'role_id' => 'required',
        ]);
        $user  = User::where('slug', $id)->first();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->role_id = $request->role_id;
        $user->password = Hash::make($request->password);
        $user->number = $request->number;
        $user->updated_by = Auth::user()->id;
        $user->updated_date = Carbon::now();
        $user->update();


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
        $user = User::where('slug', $id)->first();
        $user->is_deleted = 'Y';
        $user->deleted_date = Carbon::now();
        $user->deleted_by = Auth::user()->id;
        $user->update();
        // ->delete();

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
