<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'text_msg' => 'sometimes|required|string',
            'img_msg' => 'sometimes|required|string',
            'file_msg' => 'sometimes|required|string',
            'file_3d_msg' => 'sometimes|required|string',
            'chat_id' => 'required',
            'user_id_sender' => 'required',
            'user_id_recepient' => 'required'
        ]);

        $message = Message::create($request->all());

        return response([
            'status' => true,
            'message' => 'Message add successful',
            'message_created' => $message
        ],201);

    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Message::find($id);
        if(is_null($item)){
            return response([
                'status' => false,
                'message' => 'Message not found!'
            ],404);
        }

        $request->validate([
            'text_msg' => 'sometimes|required|string',
            'img_msg' => 'sometimes|required|string',
            'file_msg' => 'sometimes|required|string',
            'file_3d_msg' => 'sometimes|required|string',
        ]);

        $item->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Message update success!'
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
        $item = Message::find($id);
        if(is_null($item)){
            return response([
                'status' => false,
                'message' => 'Message not found!'
            ],404);
        }

        $item->delete();

        return response()->json([
            'status' => true,
            'message' => 'Message delete success!'
        ], 200);
    }
}
