<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request -> validate([
            'user_id' => 'required'
        ]);

        return response([
            'status' => true,
            'message' => 'Get all orders success!',
            'orders' => Order::with('user')->where('user_id',$request->user_id)->get()
        ],200);
    }

    public function all(){
        return response([
            'status' => true,
            'message' => 'Get all orders success!',
            'orders' => Order::with('user')->where('status',0)->get()
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
            'order' => Order::with('user')->find($order->id)
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

    public function filtering(Request $request)
    {
        $data = $request->all();
       // $filter = app()->make(ItemFilter::class,array_filter($data));
        //$items = Item::filter($filter)->get();
        $query = Order::query();
        $res = Order::with('user')->get();

        if (isset($data['title'])) {
            $query->where('title', 'like', "%{$data['title']}%");
            $res = $query->with('user')->get();
        } 
        elseif(isset($data['author'])){
            $users = User::where('login','like', "%{$data['author']}%")->get('id');
            $arr = array();
            foreach($users as $it) {
                    array_push($arr,$it['id']);
            }

            $res = $query->whereIn('user_id', $arr)->with('user')->get();
        }

        // if (isset($data['tag']) && isset($data['title'])) {
        //     $query->where('tag', 'like', "%{$data['tag']}%")->orWhere('title', 'like', "%{$data['title']}%");
        // }

        // if (isset($data['title'])) {
        //    $query->where('title', 'like', "%{$data['title']}%");
        // }

        // if (isset($data['tag'])) {
        //     $query->where('tag', 'like', "%{$data['tag']}%");
        // }

        // if (isset($data['cost'])) {
        //    $query->where('cost', '>=', $data['cost']);
        // }

        return response([
            'orders' => $res
        ],200);
    }

}
