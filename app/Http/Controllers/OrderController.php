<?php

namespace App\Http\Controllers;

use App\Item;
use App\Mail\ConfirmOrder;
use App\order;
use App\OrderedToppings;
use App\OrderHistory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
//use Pusher\Laravel\Facades\Pusher;

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
        $order->pickup = $request->pickup == 'pickup' ? 1:0;
        //if($request->pickup == 'pickup')
        $order->save();

        $count = count($items);

        for ($x = 0; $x < $count; $x++ ){
            $order_history = new OrderHistory();
            $order_history->order_id = $order->id;
            $order_history->item_id = $items[$x]['item_id'];
            $order_history->size_id = $items[$x]['size_id'];
            $order_history->quantity = $items[$x]['quantity'] ;
            $order_history->toppings_cost = $items[$x]['total_topping_cost'];
            $order_history->save();

            if(count($items[$x]['toppings']) > 0){
                for($y = 0; $y < count($items[$x]['toppings']); $y++){
                    $ordered_toppings = new OrderedToppings();
                    $ordered_toppings->order_history_id = $order_history->id;
                    $ordered_toppings->topping =$items[$x]['toppings'][$y]['name'];
                    $ordered_toppings->save();
                }
            }

        }

        $order = Order::where('id', $order->id)->with('user')->first();
        $order_history = OrderHistory::where('order_id', $order->id)->get();
        // ToDo: uncomment the code below.
        //Mail::to($order->user->email)->send(new ConfirmOrder($order, $order_history));
    }


    public function getOrders()
    {
        // Employees will recieve these orders
        $orders = Order::where('complete', '=', 0)->with('user')->with('orderHistories')->orderBy('created_at', 'asc')->get();

        return $orders;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderComplete($id)
    {
        $order = Order::findOrFail($id);
        $order->complete = 1;
        $order->update();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function getOrderHistory($user_id)
    {
        $order = Order::where('user_id', $user_id)->with('user')->with('orderHistories')->orderBy('created_at', 'desc')->get();
        //$order_history = OrderHistory::where('order_id', $order->id)->get();

        return response($order);
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
    public function deleteOrder($id)
    {
        $order = Order::find($id);
        $items = OrderHistory::where('order_id', $order->id)->delete();
        Order::find($id)->delete();
    }
}
