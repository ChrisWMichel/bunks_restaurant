<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use App\Price;
use App\Size;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SizeController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSizePrice(Request $request, $id)
    {
        $item_id = $id;
         $count = 0;
         foreach($request as $x){
             $count++;
             // do not remove this
             print_r($x);
         }

        for($x = 0; $x <= $count; $x++){
            $price = new Price();
            $price->item_id = $item_id;
            $price->price = $request[$x]['price'];
            $price->save();

            $size = new Size();
            $size->item_id = $item_id;
            $size->size = $request[$x]['size'];
            $size->save();
        }

        return response(null);
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function show(Size $size)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function edit(Size $size)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size)
    {
        //
    }
}
