<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;

class StaffController extends Controller
{
    public function staff()
    {
        $staff = Staff::all();
        return response(['Message:'=>'API request return successfully','Code:'=>'1','Data'=>$staff],200);
    }
}
