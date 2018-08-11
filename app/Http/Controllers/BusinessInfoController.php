<?php

namespace App\Http\Controllers;

use App\Business_info;
use Illuminate\Http\Request;

class BusinessInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$biz_info = Business_info::select()->first();
        $biz_info = Business_info::whereId(1)->first();

        return response($biz_info->jsonSerialize());
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
     * @param  \App\Business_info  $business_info
     * @return \Illuminate\Http\Response
     */
    public function show(Business_info $business_info)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Business_info  $business_info
     * @return \Illuminate\Http\Response
     */
    public function edit(Business_info $business_info)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Business_info  $business_info
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Business_info $business_info)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Business_info  $business_info
     * @return \Illuminate\Http\Response
     */
    public function destroy(Business_info $business_info)
    {
        //
    }
}
