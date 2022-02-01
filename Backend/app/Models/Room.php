<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    /**
     * extra mean that room have some special things
     *
     * status to tell you that room is takin or not
     */
    protected $fillable = ['room_type', 'rate', 'extra', 'status', 'price'];

}
