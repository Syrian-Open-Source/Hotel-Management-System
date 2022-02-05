<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rate;
use App\Models\Room;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rate = Rate::all();
        return response(['rate' => $rate], 200);

    }

    public function my_rate()
    {
        $rate = Rate::where('user_id',auth()->user()->id)->get();
        return response(['rate' => $rate], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'room_id' => 'required|integer|exists:rooms,id',
            'rate'  => 'required|integer|in:1,2,3,4,5'
        ]);

        $rate = Rate::create([
            'user_id'       => auth()->user()->id,
            'room_id'       => $request->room_id,
            'rate'          => $request->rate,
        ]);

        $room_rate = Rate::avg('rate')->where('room_id',$request->room_id);

        $room = Room::where('id', $request->room_id);

        $room->update([
            'rate' => $room_rate,
        ]);

        return response(['Message:'=>'Rate Created successfully','Code:'=>'1','Rate' => $rate], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rate = Rate::find($id);

        return response(['Message:'=>'Rate info fetched successfully','Code:'=>'1','Rate' => $rate], 200);

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
        $this->validate($request,[
            'rate'  => 'required|integer|in:1,2,3,4,5'
        ]);

        $input = $request->all();

        $rate = Rate::find($id);
        $rate->update($input);

        $room_rate = Rate::avg('rate')->where('room_id',$rate->room_id);

        $room = Room::where('id', $rate->room_id);

        $room->update([
            'rate' => $room_rate,
        ]);

        return response(['Message:'=>'Rate info edited successfully','Code:'=>'1','Rate' => $rate], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rate::find($id)->delete();
        return response(['Message:'=>'Rate deleted successfully','Code:'=>'1'], 204);

    }
}
