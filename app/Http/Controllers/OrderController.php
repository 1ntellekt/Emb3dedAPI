<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'status' => true,
            'message' => 'Get all orders success!',
            'orders' => Order::with('user')->get()
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'user_id' => 'required',
            'img_url' => 'sometimes|required',
        ]);

        $order = Order::create($request->all());

        return response([
            'status' => true,
            'message' => 'order add successful',
            'order' => $order
        ],201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Order::find($id);
        if(is_null($item)){
            return response([
                'status' => false,
                'message' => 'Order not found!'
            ],404);
        }
        
        return response()->json([
            'status' => true,
            'message' => 'Order found success!', 
            'order' => Order::with('user')->find($id)
        ], 200);
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
        $item = Order::find($id);
        if(is_null($item)){
            return response([
                'status' => false,
                'message' => 'Order not found!'
            ],404);
        }

        $request->validate([
            'title' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'user_id' => 'sometimes|required',
            'img_url' => 'sometimes|required',
        ]);

        $item->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Order update success!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Order::find($id);
        if(is_null($item)){
            return response([
                'status' => false,
                'message' => 'Order not found!'
            ],404);
        }

        $item->delete();

        return response()->json([
            'status' => true,
            'message' => 'Order delete success!'
        ], 200);
    }
}
