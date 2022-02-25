<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chat';
    protected $primaryKey = 'chat_id';
    public $incrementing = true;
    public $timestamps = false;

    protected $guarded = [];

    public function sender()
    {
        return $this->belongsTo(User::class, 'chat_sendder', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'chat_receiver', 'id');
    }
}
