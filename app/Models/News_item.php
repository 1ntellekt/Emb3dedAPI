<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News_item extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'img_url',
        'tag',
        'created_at',
    ];

    protected $hidden = [
        //'created_at',
        'updated_at',
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }

}
