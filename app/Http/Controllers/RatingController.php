<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request -> validate([
            'news_items_id' => 'required'
        ]);

        return response([
            'status' => true,
            'message' => 'Get all marks success!',
            'marks' => Rating::with('user')->where('news_items_id',$request->news_items_id)->get()
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
            'user_id' => 'required',
            'news_items_id' => 'required',
            'mark' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|lt:5.01',
            'comment' => 'sometimes|required|string',
        ]);

        $query = Rating::query();

        $it = $query->where('user_id', $request->user_id)->where('news_items_id', $request->news_items_id)->first();

        if ($it != null && $it->count()>0){
           $it->update($request->all());
        } else {
            Rating::create($request->all());
        }

        return response([
            'status' => true,
            'message' => 'Mark is added or updated'
        ],201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getUserNewsMark(Request $request)
    {
        $request -> validate([
            'user_id' => 'required',
            'news_items_id' => 'required'
        ]);

        $query = Rating::query();

        $it = $query->where('user_id', $request->user_id)->where('news_items_id', $request->news_items_id)->first();

        if ($it != null && $it->count()>0){
            return response([
                'status' => true,
                'message' => 'Get yours mark success!',
                'you_mark' => $it
            ],200);
         } else {
            return response([
                'status' => false,
                'message' => 'You yet didnt put mark!',
                'you_mark' => 0.0
            ],404);
         }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    // }
}
