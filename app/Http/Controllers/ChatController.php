<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
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
            'message' => 'Get all chats success!',
            'chats' => Chat::with(['user_first','user_second','last_message'])
            ->where('user_id_first',$request->user_id)
            ->orWhere('user_id_second', $request->user_id)->get()
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
        $request -> validate([
            'user_id_first' => 'required',
            'user_id_second' => 'required',
        ]);

        if ($request->user_id_first == $request->user_id_second) {
            return response([
                'status' => false,
                'message' => 'Error input (make different id-s pls)',
            ],400);
        }
        $query = Chat::query();

       $it = $query->where('user_id_first',$request->user_id_first)->where('user_id_second',$request->user_id_second)
       ->orWhere('user_id_first',$request->user_id_second)->where('user_id_second',$request->user_id_first)->get();
       if ($it != null && $it->count()>0) {
        return response([
            'status' => false,
            'message' => 'Error input (chat already created)',
        ],400);
       }

       $chat = Chat::create($request->all());

       return response([
        'status' => true,
        'message' => 'Chat created success!',
        'chat' => Chat::with(['user_first','user_second','last_message'])->find($chat->id),
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
        $item = Chat::find($id);
        if(is_null($item)){
            return response([
                'status' => false,
                'message' => 'Chat not found!'
            ],404);
        }
        
        return response()->json([
            'status' => true,
            'message' => 'Chat found success!', 
            'chat' => Chat::find($id),
            'messages' => Chat::find($id)->messages,
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
        $item = Chat::find($id);
        if(is_null($item)){
            return response([
                'status' => false,
                'message' => 'Chat not found!'
            ],404);
        }

        $request->validate([
            'download_first' => 'sometimes|required',
            'download_second' => 'sometimes|required',
        ]);

        $item->update($request->all());
        
        return response()->json([
            'status' => true,
            'message' => 'Chat update success!'
        ], 200);
    }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     //
    // }
}
