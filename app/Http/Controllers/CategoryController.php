<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $category = Category::where('is_deleted', 'N')->get();
        return view('master.category', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'name' => 'required|unique:categories',
            'price' => 'required'
        ]);

        try {
            //code...
            $category = new Category;
            $category->name = $request->name;
            $category->price = str_replace(',', '', $request->price);
            $category->created_date = Carbon::now();
            $category->created_by = Auth::user()->id;
            $category->save();


            Alert::toast('Data Tersimpan', 'success');
            return redirect('category');
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
            'name' => 'required|',
            'price' => 'required'
        ]);

        try {
            //code...
            $category = Category::where('slug', $id)->first();
            $category->name = $request->name;
            $category->price = str_replace(',', '', $request->price);
            $category->slug = null;
            $category->updated_date = Carbon::now();
            $category->updated_by = Auth::user()->id;

            $category->update();

            Alert::toast('Data Tersimpan', 'success');
            return redirect('category');
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


            $category = Category::where('slug', $id)->first();

            $category->deleted_date = Carbon::now();
            $category->deleted_by = Auth::user()->id;
            $category->is_deleted = 'Y';
            $category->update();
            Alert::toast('Data Terhapus', 'success');
            return redirect('category');
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th->getMessage());
        }
    }
}
