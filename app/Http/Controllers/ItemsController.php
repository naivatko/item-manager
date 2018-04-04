<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Validator;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = array(
            'success' => true,
            'message' => 'function success',
            'data'    => array(
                'items' => Item::all()->toArray()
            )
        );

        return response()->json($response);
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
        $validator = Validator::make($request->all(), [
            'text' => 'required'
        ]);

        if ($validator->fails()) {
            $response = array(
                'success' => false,
                'message' => $validator->messages()->first()
            );

            return response()->json($response);
        }

        $item       = new Item();
        $item->text = $request->input('text');
        $item->body = $request->input('body');
        
        $item->save();

        $response = array(
            'success' => true,
            'message' => 'function success, item successfully added',
            'data'    => $item
        );

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = array(
            'success' => true,
            'message' => 'function success',
            'data'    => array(
                'item' => Item::find($id)->toArray()
            )
        );    
    
        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::destroy($id);

        $response = array(
            'success' => true,
            'message' => 'Item '.$id.' deleted'
        );

        return response()->json($response);
    }
}
