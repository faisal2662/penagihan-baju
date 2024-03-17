<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $category = Category::all();
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

        Category::create($request->all());

        Alert::toast('Data Tersimpan', 'success');
        return redirect('category');
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
            'name' => 'required|unique:categories',
            'price' => 'required'
        ]);

        $category = Category::where('slug', $id)->first();
        
        $category->slug =null;
        $category->update($request->all());

        Alert::toast('Data Tersimpan', 'success');
        return redirect('category');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Category::where('slug', $id)->first()->delete();

        Alert::toast('Data Terhapus', 'success');
        return redirect('category');

    }
}