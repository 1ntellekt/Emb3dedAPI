<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeviceController extends Controller
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
            'message' => 'get data devices successful!',
            'devices' => Device::with('user')->get()
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
        $fields = $request->validate([
                'name_device' => 'required|string',
                'token' => 'required|string|unique:devices,token',
                'user_id' => 'required',
        ]);

        $device = Device::create([
            'name_device' => $fields['name_device'],
            'token' => $fields['token'],
            'user_id' => $fields['user_id'],
        ]);

        return response([
            'status' => true,
            'message' => 'device add successful',
            'device' => $device
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

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
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
    public function destroy(Request $request)
    {

        $field = $request->validate([
            'token' => 'required|string',
        ]);

        $device = Device::where('token', $field['token'])->first();
        if(is_null($device)){
            return response([
                'status' => false,
                'message' => 'Device not found!'
            ],404);
        }

        $device->delete();

        return response()->json([
            'status' => true,
            'message' => 'Device delete success!'
        ], 200);
    }
}
