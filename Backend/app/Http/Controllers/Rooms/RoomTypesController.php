<?php

namespace App\Http\Controllers\Rooms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomType;

class RoomTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $room_type = RoomType::all();
        return response(['room type' => $room_type], 200);
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
            'name'  => 'required|string',
            'beds'  => 'required|integer',
            'stars' => 'required|integer|between:1,5',
        ]);

        $room_type = RoomType::create([
            'name'  => $request->name,
            'beds'  => $request->beds,
            'stars' => $request->stars,
        ]);

        return response(['Message:'=>'Room Type Created successfully','Code:'=>'1','room type' => $room_type], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room_type = RoomType::find($id);

        return response(['Message:'=>'Room Type info fetched successfully','Code:'=>'1','user' => $room_type], 200);

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
            'name'  => 'string',
            'beds'  => 'integer',
            'stars' => 'integer|between:1,5',
        ]);

        $input = $request->all();

        $room_type = RoomType::find($id);
        $room_type->update($input);

        return response(['Message:'=>'Room Type info edited successfully','Code:'=>'1','room type' => $room_type], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RoomType::find($id)->delete();
        return response(['Message:'=>'Room Type deleted successfully','Code:'=>'1'], 204);

    }
}
