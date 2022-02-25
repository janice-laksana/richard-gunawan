<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'wishlist'; 
    protected $primaryKey = 'wishlist_id';
    public $timestamps = false;

    public function jasa()
    {
        return $this->belongsTo(Jasa::class,'jasa_id','wishlist_id_jasa');
    }
}