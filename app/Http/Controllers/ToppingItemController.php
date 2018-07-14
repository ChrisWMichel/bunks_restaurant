<?php

namespace App\Http\Controllers;

use App\Topping_Item;
use Illuminate\Http\Request;

class ToppingItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $item = New Topping_Item();
        $item->topping__cat_id = (int)$request->cat_id;
        $item->item = $request->name;
        if( $request->double_price == 'true'){
            $item->double_price = 1;
        }

        $item->save();

        return response($item->jsonSerialize());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Topping_Item  $topping_Item
     * @return \Illuminate\Http\Response
     */
    public function show(Topping_Item $topping_Item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topping_Item  $topping_Item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topping_Item  $topping_Item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $topping = Topping_Item::find($id);

        $topping->item = $request->item;
        $topping->double_price = $request->double_price;
        $topping->update();

        //return response($topping->jsonSerialize());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topping_Item  $topping_Item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topping_Item $topping_Item)
    {
        //
    }
}
