<?php

namespace App\Http\Controllers\Rooms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $room = Room::all();
        return response(['room' => $room], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'room_type'  => 'required|integer|exists:room_types,id',
            'rate'       => 'integer|between:0,5',
            'extra'      => 'string',
            'status'     => 'boolean',
            'price'      => 'integer|min:1'
        ]);

        $room = Room::create([
            'room_type' => $request->room_type,
            'rate'      => $request->rate,
            'extra'     => $request->extra,
            'status'    => $request->status,
            'price'     => $request->price,
        ]);

        return response(['Message:'=>'Room Created successfully','Code:'=>'1','room' => $room], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = Room::find($id);

        return response(['Message:'=>'Room info fetched successfully','Code:'=>'1','user' => $room], 200);

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
        $this->validate($request, [
            'room_type'  => 'integer|exists:room_types,id',
            'rate'       => 'integer|between:0,5',
            'extra'      => 'string',
            'status'     => 'boolean',
            'price'      => 'integer|min:1'
        ]);

        $input = $request->all();

        $room = Room::find($id);
        $room->update($input);

        return response(['Message:'=>'Room info edited successfully','Code:'=>'1','room type' => $room], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Room::find($id)->delete();
        return response(['Message:'=>'Room deleted successfully','Code:'=>'1'], 204);

    }
}
