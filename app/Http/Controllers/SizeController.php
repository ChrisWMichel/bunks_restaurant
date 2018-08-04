<?php

namespace App\Http\Controllers;

use App\Item;
use App\Price;
use App\Size;
use App\Topping_Cost;
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
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
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

         if(!empty($request[0]['topping'])){
             for($x = 0; $x <= $count; $x++){
                 $price = new Price();
                 $price->item_id = $item_id;
                 $price->price = $request[$x]['price'];
                 $price->save();

                 $size = new Size();
                 $size->price_id = $price->id;
                 $size->size = $request[$x]['size'];
                 $size->save();

                 $topping = new Topping_Cost();
                 $topping->size_id = $size->id;
                 $topping->cost = $request[$x]['topping'];
                 $topping->save();

             }
             //$this->addToppingPrice($count, $request);
         }else{
             for($x = 0; $x <= $count; $x++){
                 $price = new Price();
                 $price->item_id = $item_id;
                 $price->price = $request[$x]['price'];
                 $price->save();

                 $size = new Size();
                 $size->price_id = $price->id;
                 $size->size = $request[$x]['size'];
                 $size->save();
             }
         }

       // $item = Item::find($item_id);

        //return response(['item_id'=>$item_id]); //->jsonSerialize()
    }

    public function addToppingPrice($count, $request){
        $sizes = Size::orderBy('id', 'desc')->take($count)->get();
        $x = 0;
        foreach($sizes as $size){

            $topping = new Topping_Cost();
            $topping->size_id = $size->id;
            $topping->cost = $request[$x]['topping'];
            $topping->save();
            $x++;
        }
    }

    public function updateSize(Request $request)
    {

        foreach ($request->input() as $val){
            $size = Size::find($val['id']);

            $size->update(['size' => $val['size']]);
        }

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
