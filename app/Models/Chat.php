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
        'user_first',
        'user_second',
    ];

    public $timestamps = false;


    public function messages(){
        return $this->hasMany(Message::class);
    }

}
