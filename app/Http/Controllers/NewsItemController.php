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
    public function index(Request $request)
    {

        $request -> validate([
            'user_id' => 'required'
        ]);

        return response([
            'status' => true,
            'message' => 'Get all news success!',
            'news' => News_item::with('user')->where('user_id',$request->user_id)->get()
        ],200);
    }

    public function all(){
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
            'news_item' => News_item::with('user')->find($news_item->id)
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
            'img_url' => 'sometimes|required|string',
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

    public function filtering(Request $request){
        $data = $request->all();

       // $filter = app()->make(ItemFilter::class,array_filter($data));
        //$items = Item::filter($filter)->get();

        $query = News_item::query();

        if (isset($data['txt'])) {
            $query->where('tag', 'like', "%{$data['txt']}%")->orWhere('title', 'like', "%{$data['txt']}%");
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
            'news' => $query->with(['user'])->get()
        ],200);
    }


}
