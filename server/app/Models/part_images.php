<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class part_images extends Model
{
    use HasFactory;

    protected $fillable =[
        'part_id',
        'avatar',
        'user_id'
    ];
}
