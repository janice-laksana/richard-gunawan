<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    //
    protected $table = 'transaksi';
    protected $primaryKey = 'transaksi_id';
    public $incrementing = false;
    public $timestamps = true;

    protected $guarded = [];

    public function transaksi_extra()
    {
        return $this->hasMany(TransaksiExtra::class, 'transaksi_id', 'transaksi_id');
    }

    public function jasa()
    {
        return $this->belongsTo(Jasa::class, 'jasa_id', 'jasa_id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'transaksi_buyer_id', 'id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'transaksi_seller_id', 'id');
    }

}
