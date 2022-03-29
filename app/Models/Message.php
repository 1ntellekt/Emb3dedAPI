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
        'user_id_sender',
        'user_id_recepient',
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

    public function recepient(){
        return $this->belongsTo(User::class, 'user_id_recepient', 'id');
    }

    public function sender(){
        return $this->belongsTo(User::class, 'user_id_sender', 'id');
    }

}
