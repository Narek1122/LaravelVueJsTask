<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parts extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'model',
        'make',
        'year',
        'partnumber',
        'name',
        'avatar'
    ];

    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
}
