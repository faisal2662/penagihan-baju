<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\session;
use App\Models\Customer;
use App\Models\DownPayment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //
    public function reportDay(Request $request)
    {


        $date = Carbon::now()->format('Y-m-d');
        if ($request->date) {
            $report = Transaction::with('customer')->where('created_at', 'like', '%' . $request->date . '%')->paginate(10);
            //    dd($report);
            return view('reports/day', compact('report', 'date'));
        }

        $report = Transaction::with('customer')->where('created_at', 'like', '%' . $date . '%')->paginate(10);

        return view('reports/day', compact('report', 'date'));
    }

    public function reportFinance()
    {

        $dp = DownPayment::sum('nominal');

        // uang masuk
        $paid =  DB::table('price_lists')->select('price_lists.size', DB::raw('SUM(payments.temporary) as jumlah'))->join('customers', 'price_lists.id', '=', 'customers.id_price_list')->join('payments', 'customers.id', '=', 'payments.id_customer')->groupBy('price_lists.size')->get()->sum('jumlah');

        // uang tersedia
        $available = $paid - $dp;

        // keseluruhan
        $sale =  Payment::sum('total');

        // yang di setorkan
        $deposit =  DB::table('price_lists')->select('price_lists.size', DB::raw('SUM(price_lists.price) as jumlah'))->join('customers', 'price_lists.id', '=', 'customers.id_price_list')->groupBy('price_lists.size')->get()->sum('jumlah');

        // keuntungan
        $profit = $sale - $deposit;

        // yang belum masuk
        $debt = $sale - $paid;


        return view('reports/finance', compact('paid', 'deposit', 'sale', 'profit', 'debt', 'dp', 'available'));
    }
    public function reportShirt(Request $request)
    {
        $cus = Customer::all();
        $session = session::all();
        if ($request->session != '') {
            # code...
            $countSize =  DB::table('price_lists')->select('price_lists.size', DB::raw('COUNT(*) as jumlah'))->join('customers', 'price_lists.id', '=', 'customers.id_price_list')->where('slug_session', $request->session)->groupBy('price_lists.size')->get();

            $countCategory = DB::table('categories')->select('categories.name', DB::raw('COUNT(*) as jumlah'))->join('customers', 'categories.slug', '=', 'customers.slug_category')->where('slug_session', $request->session)->groupBy('categories.name')->get();

            $countColor = DB::table('colors')->select('colors.name', DB::raw('COUNT(*) as jumlah'))->join('customers', 'colors.slug', '=', 'customers.slug_color')->where('slug_session', $request->session)->groupBy('colors.name')->get();
        } else {
            $countSize =  DB::table('price_lists')->select('price_lists.size', DB::raw('COUNT(*) as jumlah'))->join('customers', 'price_lists.id', '=', 'customers.id_price_list')->groupBy('price_lists.size')->get();

            $countCategory = DB::table('categories')->select('categories.name', DB::raw('COUNT(*) as jumlah'))->join('customers', 'categories.slug', '=', 'customers.slug_category')->groupBy('categories.name')->get();

            $countColor = DB::table('colors')->select('colors.name', DB::raw('COUNT(*) as jumlah'))->join('customers', 'colors.slug', '=', 'customers.slug_color')->groupBy('colors.name')->get();
        }

        return view('reports/shirt', compact('countCategory', 'countColor', 'countSize', 'session'));
    }
}