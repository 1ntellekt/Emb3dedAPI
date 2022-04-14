<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class ViewerController extends Controller
{
    public function getViewer(Request $request){
        $request -> validate([
            'model_url' => 'required|string',
        ]);
        return view('model', ['url' => $request->model_url]);
    }
}
