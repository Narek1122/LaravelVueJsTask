<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartImages extends Model
{
    use HasFactory;


    public function allPartImages(){
        return $this->belongsTo(Parts::class,'part_id');
    }
}
