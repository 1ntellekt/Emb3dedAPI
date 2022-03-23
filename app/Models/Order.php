<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'img_url',
        'status',
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
