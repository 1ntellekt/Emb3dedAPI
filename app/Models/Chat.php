<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'download_first',
        'download_second',
        'user_id_first',
        'user_id_second',
    ];

    protected $hidden = [
        'user_id_first',
        'user_id_second',
    ];

    public $timestamps = false;


    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function last_message(){
        return $this->hasOne(Message::class)->orderBy('created_at', 'desc');
    }

    public function user_first(){
        return $this->belongsTo(User::class, 'user_id_first', 'id');
    }

    public function user_second(){
        return $this->belongsTo(User::class, 'user_id_second', 'id');
    }

}
