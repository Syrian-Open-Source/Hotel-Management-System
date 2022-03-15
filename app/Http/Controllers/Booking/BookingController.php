<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\BaseController;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use Auth;

class BookingController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \App\Exceptions\PublicException
     */
    public function index()
    {
        return $this->responseSuccess(
            ['Booking' => Booking::all()],
        );

    }

    public function myBooking()
    {
        $booking = Booking::where('user_id', auth()->user()->id)->get();
        return response(['Booking' => $booking], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookingRequest $request)
    {
        $data = $request->validated();

        $booking = Booking::create($data);

        return response(['Message:' => 'Booking Created successfully', 'Code:' => '1', 'booking' => $booking], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = Booking::find($id);

        return response(['Message:' => 'Booking info fetched successfully', 'Code:' => '1', 'user' => $booking], 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookingRequest $request, $id)
    {
        $data = $request->validated();

        $booking = Booking::find($id);
        $booking->update($data);

        return response(['Message:' => 'Booking info edited successfully', 'Code:' => '1', 'Booking' => $booking], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Booking::find($id)->delete();
        return response(['Message:' => 'Booking deleted successfully', 'Code:' => '1'], 204);
    }
}
