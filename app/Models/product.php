<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable=['name','price','image','category_id'];
    public function categoy(){
        return $this->belongsTo(category::class);
    }
    public function tags(){
        return $this->belongsToMany(tag::class);
    }

}
