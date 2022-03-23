<?php

namespace App\Http\Controllers;

use App\Models\News_item;
use Illuminate\Http\Request;

class NewsItemController extends Controller
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
            'message' => 'Get all news success!',
            'news' => News_item::with('user')->get()
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
            'tag' => 'required|string',
            'img_url' => 'sometimes|required',
        ]);

        $news_item = News_item::create($request->all());

        return response([
            'status' => true,
            'message' => 'News item add successful',
            'news_item' => $news_item
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
        $item = News_item::find($id);
        if(is_null($item)){
            return response([
                'status' => false,
                'message' => 'News item not found!'
            ],404);
        }
        
        return response()->json([
            'status' => true,
            'message' => 'News item found success!', 
            'news_item' => News_item::with('user')->find($id)
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
        $item = News_item::find($id);
        if(is_null($item)){
            return response([
                'status' => false,
                'message' => 'News item not found!'
            ],404);
        }

        $request->validate([
            'title' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'user_id' => 'sometimes|required',
            'img_url' => 'sometimes|required',
            'tag' => 'sometimes|required|string'
        ]);

        $item->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'News item update success!'
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
        $item = News_item::find($id);
        if(is_null($item)){
            return response([
                'status' => false,
                'message' => 'News item not found!'
            ],404);
        }

        $item->delete();

        return response()->json([
            'status' => true,
            'message' => 'News item delete success!'
        ], 200);
    }
}
