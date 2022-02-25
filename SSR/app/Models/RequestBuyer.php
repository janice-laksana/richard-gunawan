<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class RequestBuyer extends Model
{
    //
    protected $table = 'request';
    protected $primaryKey = 'request_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $guarded = [];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function offer()
    {
        return $this->hasMany(Offer::class, 'request_id', 'request_id');
    }



}
