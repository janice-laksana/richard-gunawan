<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $table = 'review';
    protected $primaryKey = 'review_id';
    public $incrementing = true;
    public $timestamps = false;

    protected $guarded = [];
}
