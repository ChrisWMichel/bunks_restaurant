<?php

namespace App\Http\Controllers;

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
        $item = Item::find($item_id);

        //return response(['item_id'=>$item_id]); //->jsonSerialize()
        $this->sendDataBack($item);
    }

    public function updateSize(Request $request)
    {

        foreach ($request->input() as $val){
            $size = Size::find($val['id']);

            $size->update(['size' => $val['size']]);
        }

    }

    protected function sendDataBack($item){
        return \response($item->jsonSerialize());
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
