<?php

namespace App\Http\Controllers;

use App\Topping_Cost;
use Illuminate\Http\Request;

class ToppingCostController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Topping_Cost  $topping_Cost
     * @return \Illuminate\Http\Response
     */
    public function show(Topping_Cost $topping_Cost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topping_Cost  $topping_Cost
     * @return \Illuminate\Http\Response
     */
    public function edit(Topping_Cost $topping_Cost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topping_Cost  $topping_Cost
     * @return \Illuminate\Http\Response
     */
    public function updatePrice(Request $request)
    {
        foreach ($request->input() as $val){
            $topping = Topping_Cost::find($val['id']);

            $topping->update(['cost' => $val['topping_cost']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topping_Cost  $topping_Cost
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topping_Cost $topping_Cost)
    {
        //
    }
}
