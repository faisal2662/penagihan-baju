<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class TakingController extends Controller
{
    //

    public function index()
    {
        $cust = Customer::get();
        return view('taking.index', compact('cust'));
    }

    public function Search(Request $request)
    {


        // return json_encode('df');
        // return \Response::json($response);

        return json_encode("sdsd");
    }
}