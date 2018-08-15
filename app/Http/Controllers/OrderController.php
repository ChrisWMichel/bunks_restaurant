<?php

namespace App\Http\Controllers;

use App\Item;
use App\order;
use App\OrderHistory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class OrderController extends Controller
{

    public function index()
    {
        return view('employee.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request)
    {
        $user_id = $request->user_id;
        $items = $request->cart;
        $note = $request->note;
        $total_cost = $request->total_cost;



        $order = new Order();
        $order->user_id = $user_id;
        $order->notes = $note;
        $order->total = $total_cost;
        $order->save();

        $count = count($items);

        for ($x = 0; $x < $count; $x++ ){
            $order_history = new OrderHistory();
            $order_history->order_id = $order->id;
            $order_history->item_id = $items[$x]['item_id'];
            $order_history->size_id = $items[$x]['size_id'];
            $order_history->quantity = $items[$x]['quantity'] ;
            $order_history->save();
        }
        //return response($items);
    }


    public function getOrders()
    {
        $orders = Order::Where('complete', '=', 0)->get();
        //$item = Item::all();
       // $orders = User::where('orders.complete', '=', 0)->get();
        //$orders = User::all();

        return $orders;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        //
    }
}
