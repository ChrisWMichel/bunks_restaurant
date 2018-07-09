<?php

namespace App\Http\Controllers;

use App\Topping_Cat;
use Illuminate\Http\Request;

class ToppingCatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Topping_Cat::all();

        return response($categories->jsonSerialize());

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
        $category = new Topping_Cat();
        $category->name = $request->name;
        $category->save();

        return response($category->jsonSerialize());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Topping_Cat  $topping_Cat
     * @return \Illuminate\Http\Response
     */
    public function show(Topping_Cat $topping_Cat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topping_Cat  $topping_Cat
     * @return \Illuminate\Http\Response
     */
    public function edit(Topping_Cat $topping_Cat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topping_Cat  $topping_Cat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topping_Cat $topping_Cat)
    {
        //
    }

    public function destroy($id)
    {
        Topping_Cat::find($id)->delete();
    }
}
