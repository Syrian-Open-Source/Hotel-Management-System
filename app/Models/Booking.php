<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'room_id', 'status', 'start_date', 'end_date'];

    public function setUserIdAttribute()
    {
        $this->attributes['user_id'] = auth()->user()->id;
    }

    public function setStatusAttribute()
    {
        $this->attributes['status'] = true;
    }
}
