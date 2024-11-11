<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;
    public function categories(){
        return $this->belongsTo(Category::class);
    }
}
