<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Check;
use Illuminate\Http\Exceptions\HttpResponseException;

class CheckController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'booking_id'     => 'required|exists:bookings,id',
            'check_type'     => 'required|in:in,out',
        ]);

        $booking_id = Booking::where('id',$request->booking_id)->get();

        if ($booking_id->user_id == auth()->user()->id){
            $check = Check::create([
                'booking_id'       => $request->booking_id,
                'check_type'       => $request->check_type,
            ]);

            return response(['Message:'=>'Check Created successfully','Code:'=>'1','booking' => $check], 201);
        }

        else{
            return response(['Message:'=>'You can make check for your booking only ','Code:'=>'-1'], 403);
        }
    }
}
