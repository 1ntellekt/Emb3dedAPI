<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'text_msg',
        'img_msg',
        'file_msg',
        'file_3d_msg',
        'sender_id',
        'recepient_id',
        'chat_id',
        'created_at'
    ];

    protected $hidden = [
        //'created_at',
        'updated_at',
    ];

    public function chat(){
        return $this->belongsTo(Chat::class);
    }

}
