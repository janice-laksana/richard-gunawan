<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    protected $table = 'nationality';
    protected $primaryKey = 'nationality_id';
    public $incrementing = true;
    public $timestamps = false;

    protected $guarded = [];
}
