<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\PriceList;
use App\Models\session;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    //

    public function index(Request $request)
    {
        if ($request->name) {
            $customers = Customer::with(['pricelist', 'payment', 'color', 'category', 'session',  'transaction'])->where('name', 'like', '%' . $request->name . '%')->paginate();
        } else if ($request->session) {
            $customers = Customer::with(['pricelist', 'payment', 'color', 'category', 'session',  'transaction'])->where('sessions_id', 'like', '%' . $request->session . '%')->paginate(10);
        } else {
            $customers = Customer::with(['pricelist', 'payment', 'color', 'category', 'session',  'transaction'])->paginate(20);
            // dd($customers);
        }
        $searchsess = session::get();
        $searchCustomers = Customer::get('name');
        return view('customers/index', compact('customers', 'searchCustomers', 'searchsess'));
    }

    public function datatable(Request $request)
    {
        if ($request->name) {
            $customers = Customer::with(['pricelist', 'payment', 'color', 'category', 'session',  'transaction'])->where('name', 'like', '%' . $request->name . '%')->paginate();
        } else if ($request->session) {
            $customers = Customer::with(['pricelist', 'payment', 'color', 'category', 'session',  'transaction'])->where('sessions_id', 'like', '%' . $request->session . '%')->paginate(10);
        } else {
            $customers = Customer::with(['pricelist', 'payment', 'color', 'category', 'session',  'transaction'])->paginate(20);
            // dd($customers);
        }
        return DataTables::of($customers)->escapecolumns([])->make(true);
    }

    public function create()
    {
        $price = PriceList::where('is_deleted', 'N')->get();
        $category = Category::where('is_deleted', 'N')->get();
        $sess = session::where('is_deleted', 'N')->get();
        $color = Color::where('is_deleted', 'N')->get();
        return view('customers/create', compact('price', 'color', 'category', 'sess'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:customers',
            'size' => 'required',
            'color' => 'required',
            'category' => 'required',
            'status' => 'required',
        ]);

        try {
            //code...
            $temp = 0;

            if ($request->status == 'Lunas') {
                $temp = $request->total;
            }

            // // dd($temp);
            Customer::create([
                'name' => $request->name,
                'price_list_id' => $request->size,
                'color_id' => $request->color,
                'category_id' => $request->category,
                'session_id' => $request->session,
                'status' => $request->status,
                'created_by' => Auth::user()->id,
                'created_date' => Carbon::now()
            ]);
            $cus = Customer::where('name', $request->name)->first();

            Payment::create([
                'customer_id' => $cus->id,
                'remaining' => $request->total,
                'temporary' => $temp,
                'total' => $request->total

            ]);

            Alert::toast('Data Tersimpan', 'success');
            return redirect()->back();
            } catch (\Throwable $th) {
                //throw $th;
                return response()->json($th->getMessage());
                Alert::toast('Terjadi Kesalahan', 'warning');
        }
    }

    public function edit($id)
    {

        $customer = Customer::with('payment')->where('slug', $id)->first();
        // dd($customer);
        $price = PriceList::all();
        $category = Category::all();
        $sess = session::all();
        $color = Color::all();
        return view('customers/edit', compact(['customer', 'price', 'color', 'category', 'sess']));
    }

    public function update(Request $request, $id)
    {
        // dd($id);
        $request->validate([
            'name' => 'required',
            'size' => 'required',
            'color' => 'required',
            'category' => 'required',
            'status' => 'required',
        ]);

        // $temp = 0;

        if ($request->status == 'Lunas') {
            $temp = $request->total;
        }

        // // dd($temp);
        $cust =  Customer::where('slug', $id)->first();
        $cust->slug = '';
        $cust->update([
            'name' => $request->name,
            'slug_price_list' => $request->size,
            'slug_color' => $request->color,
            'slug_category' => $request->category,
            'slug_session' => $request->session,
            'status' => $request->status,
        ]);

        $pays = Payment::where('slug_customer', $id)->first();
        if ($pays->remaining != $request->total) {
            $remain = $request->total - $pays->temporary;
            $pays->update([
                'remaining' => $remain,
                'total' => $request->total
            ]);
        } else {
            $pays->update([
                'remaining' => $request->total,
                'total' => $request->total
            ]);
        }

        Alert::toast('Data Tersimpan', 'success');
        return redirect('customer');
    }

    public function destroy($id)
    {

        $cus  = Customer::where('slug', $id)->first();
        $pay = Payment::where('slug_customer', $cus->slug)->first();
        // dd($pay);
        if ($pay != null) {
            $pay->delete();
        }

        $trans = Transaction::where('slug_customer', $cus->slug)->first();
        if ($trans != null) {
            $trans->delete();
        }
        $cus->delete();
        Alert::toast('Hapus Berhasil', 'success');
        return redirect('customer');
    }


    public function searchName(Request $request)
    {
        $search =   $request->name;

        try {
            //code...
            $data = Customer::where('name', 'like', '%' .  $search . '%')->select('name')->get();
            // $data = 'dfdf';
            return response()->json(['name' => $data], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th->getMessage(), 500);
        }
    }

    public function resultName(Request $request)
    {
        $data = '';
        $search = $request->name;

        // if ($search != '') {
        //     $data =  Customer::with(['pricelist', 'transaction', 'payment'])->where('name', 'like', '%' .  $search . '%')->first();
        // }

        if ($search != '') {
            $data =  Customer::with(['pricelist', 'transaction', 'payment'])->where('slug',   $search)->first();
        }

        return json_encode($data);
    }

    public function resetCust(Request $request)
    {
        // dd($request);
        if (!Hash::check($request->password, Auth::user()->password)) {
            return back()->withErrors(['password' => 'password yang anda masukkan salah']);
        }
        // dd('tidak');

        Payment::query()->truncate();
        Transaction::query()->truncate();
        Customer::query()->delete();
        DB::statement("ALTER TABLE `customers` AUTO_INCREMENT = 1");
        Alert::toast('Data Pelanggan Berhasil di hapus', 'success');
        return redirect('/reset');
    }
}
