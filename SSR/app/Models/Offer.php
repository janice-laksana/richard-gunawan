<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    //
    protected $table = 'offer';
    protected $primaryKey = 'offer_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function jasa()
    {
        return $this->belongsTo(Jasa::class, 'jasa_id', 'jasa_id');
    }

    public function request()
    {
        return $this->belongsTo(RequestBuyer::class, 'request_id', 'request_id');
    }
}
