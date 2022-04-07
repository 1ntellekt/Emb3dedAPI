<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Response;

class FileController extends Controller
{
    public function getDownloadFile(Request $request)
    {
        if (Storage::disk('local')->exists($request->file)) {
            $path = Storage::disk('local')->path($request->file);
            //$content = file_get_contents($path);
            // return response($content)->withHeaders([
            //     'Content-Type' => mime_content_type($path)
            // ]);
            return Response()->download($path);
        }
        return response()->json([
            'status' => false,
            'message' => 'File with that path not founded!'
        ],404);
    }

    public function getContentFile(Request $request)
    {
        if (Storage::disk('local')->exists($request->file)) {
            $path = Storage::disk('local')->path($request->file);
            $content = file_get_contents($path);
            return response($content)->withHeaders([
                'Content-Type' => mime_content_type($path)
            ]);
            //return Response()->download($path);
        }
        return response()->json([
            'status' => false,
            'message' => 'File with that path not founded!'
        ],404);
    }

    public function uploadFile(Request $request)
    {
        if($request->hasFile('chat_file')){
            $file = $request->file('chat_file');

                //$fileNow = now()->valueOf();

               $path = $file->storeAs('chat_file',$file->getClientOriginalName());

            if ($path == false) {
                return response()->json([
                'status' => false,
                'message' => 'File is not upload!',
                ],400);
            }

            return response()->json([
                'status' => true,
                'message' => 'File is uploaded!',
                'path'=>$path
            ],201);

        }
         elseif($request->hasFile('chat_3d_file')){
            $file = $request->file('chat_3d_file');

                //$fileNow = now()->valueOf();

               $path = $file->storeAs('chat_3d_file',$file->getClientOriginalName());

            if ($path == false) {
                return response()->json([
                'status' => false,
                'message' => 'File is not upload!',
                ],400);
            }

            return response()->json([
                'status' => true,
                'message' => 'File is uploaded!',
                'path'=>$path
            ],201);
        }

        elseif($request->hasFile('chat_img')){
            $file = $request->file('chat_img');

                //$fileNow = now()->valueOf();

               $path = $file->storeAs('chat_img',$file->getClientOriginalName());

               if ($path == false) {
                    return response()->json([
                    'status' => false,
                    'message' => 'File is not upload!',
                    ],400);
               }

            return response()->json([
                'status' => true,
                'message' => 'File is uploaded!',
                'path'=>$path
            ],201);
        }

        elseif($request->hasFile('order_img')){
            $file = $request->file('order_img');

                //$fileNow = now()->valueOf();

               $path = $file->storeAs('order_img',$file->getClientOriginalName());

            if ($path == false) {
                return response()->json([
                'status' => false,
                'message' => 'File is not upload!',
                ],400);
            }

            return response()->json([
                'status' => true,
                'message' => 'File is uploaded!',
                'path'=>$path
            ],201);
        }

        elseif($request->hasFile('news_img')){
            $file = $request->file('news_img');

               //$fileNow = now()->valueOf();

               $path = $file->storeAs('news_img',$file->getClientOriginalName());

            if ($path == false) {
                return response()->json([
                'status' => false,
                'message' => 'File is not upload!',
                ],400);
            }

            return response()->json([
                'status' => true,
                'message' => 'File is uploaded!',
                'path'=>$path
            ],201);
        }
    
        else {
            return response()->json([
                'status' => false,
                'message' => 'File is not upload!'
            ],404);
        }
    }

}
