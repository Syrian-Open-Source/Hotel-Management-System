<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $review = Review::all();
        return response(['review' => $review], 200);
    }

    public function my_review()
    {
        $review = Review::where('user_id',auth()->user()->id)->get();
        return response(['review' => $review], 200);
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
            'review'  => 'required|string'
        ]);

        $review = Review::create([
            'user_id'       => auth()->user()->id,
            'room_id'       => $request->room_id,
            'review'      => $request->review,
        ]);

        return response(['Message:'=>'Review Created successfully','Code:'=>'1','Review' => $review], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $review = Review::find($id);

        return response(['Message:'=>'Review info fetched successfully','Code:'=>'1','Review' => $review], 200);
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
            'review'  => 'string'
        ]);

        $input = $request->all();

        $review = Review::find($id);
        $review->update($input);

        return response(['Message:'=>'Review info edited successfully','Code:'=>'1','Review' => $review], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Review::find($id)->delete();
        return response(['Message:'=>'Review deleted successfully','Code:'=>'1'], 204);
    }
}
