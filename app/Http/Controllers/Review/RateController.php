<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRateRequest;
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
    public function store(StoreRateRequest $request)
    {
        $data = $request->validated();

        $rate = Rate::create([
            'user_id'       => auth()->user()->id,
            'room_id'       => $data->room_id,
            'rate'          => $data->rate,
        ]);

       Room::where('id', $data->room_id)->update([
            'rate' => Rate::where('room_id',$data->room_id)->avg('rate'),
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
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'rate'  => 'required|integer|in:1,2,3,4,5'
        ]);

        $rate = Rate::findOrFail($id)->update($request->all());

        Room::where('id', $rate->room_id)->update([
            'rate' => Rate::avg('rate')->where('room_id',$rate->room_id),
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
