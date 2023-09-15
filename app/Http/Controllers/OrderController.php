<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
   
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::with('user')->get();
        return view('dashboard', ['orders' => $orders]);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tahun = date("y");
        $bulan = date("m");
        $query = DB::select("select max(substring(order_id,8,3)) as lastcode 
								from `orders`
								where substring(job,4,2)='$tahun' 
								and substring(job,6,2)='$bulan' ");

        if ($query[0]->lastcode > 0) {
            $lastcode = $query[0]->lastcode;
            $tmp = ((int)$lastcode) + 1;
            $lastcode = sprintf("%03s", $tmp);
            $lastcode = $tahun . $bulan . $lastcode;
        } else {
            $lastcode = $tahun . $bulan . "001";
        }
        $order_id = 'ORDER' . $lastcode;


        $this->validate($request, [
            'amount'   => 'required',
            'status'   => 'required',
        ]);

        $order = Order::create([
            'order_id' => $order_id,
            'amount' => $request->amount,
            'status' => $request->status,
            'user_id' => Auth::user()->id,
           
        ]);

        $balance = Auth::user()->balance;
        $newBalance = $balance - $request->amount;

        //update User
        $data = [
            'balance' => $newBalance
        ];

        User::update($data);

        if ($order) {
            return redirect()->route('dashboard', $order->id)->withSuccess('New order created');
        } else {
            return redirect()->route('form')->with(['error' => 'Failed Insert Data!']);
        }
    }
}
