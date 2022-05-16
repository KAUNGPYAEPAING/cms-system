<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];


    // Every Post have its own user
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getPostImageAttribute($value){
        // return asset('storage/'.$value);

        if(strpos($value, 'https://') !== false || strpos($value, 'http://') !== false){
            return asset($value);
        }else{
            return asset('storage/'.$value);
        }
    }
}
