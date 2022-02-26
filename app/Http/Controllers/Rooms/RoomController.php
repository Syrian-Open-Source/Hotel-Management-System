<?php

namespace App\Http\Controllers\Rooms;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoom;
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
    public function store(StoreRoom $request)
    {
        $data = $request->validated();

        $room = Room::create([
            'room_type' => $data->room_type,
            'rate'      => $data->rate,
            'extra'     => $data->extra,
            'status'    => $data->status,
            'price'     => $data->price,
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
        $data = $request->validated();

        $room = Room::find($id);
        $room->update($data);

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
