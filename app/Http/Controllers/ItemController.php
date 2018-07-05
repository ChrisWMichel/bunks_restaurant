<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cat_list = Category::all()->pluck('name', 'id');

        return response($cat_list->jsonSerialize());
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
        $item = New Item();
        $item->category_id = $request->cat_id;
        $item->name = $request->name;
        $item->description = $request->description;

        if($file = $request->image){
            $name = $file->getClientOriginalName();
            $name = $this->getName($name);
            $file->move('images', $name);
            $item->image_path = $name;
        }

          $item->save();

        return response($item->jsonSerialize());
    }


    public function updateItem(Request $request, $id)
    {
        $item = Item::find($id);

        $item->name = $request->input('name');
        $item->description = $request->description;

        if($file = $request->image){
            $name = $file->getClientOriginalName();
            $old_image = $item->image_path;
            $name = $this->getName($name);
            $file->move('images', $name);
            $item->image_path = $name;

            @unlink('images/' . $old_image);
        }
        $item->update();

        return response($item->jsonSerialize());
        //return response($request);
    }

    private function getName($name){
        $change_name = explode('.', $name);
        $add_num = $change_name[0] . '-' . Item::randNum();
        $final_name = $add_num . '.' . $change_name[1];
        return $final_name;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
