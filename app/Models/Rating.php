<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'news_items_id',
        'comment',
        'mark',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public $timestamps = false;

}
