<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryModel extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey = 'category_id';

    protected $fillable = ['name','images'];

    public function products()
    {
        return $this->hasMany(ProductModel::class, 'category_id');
    }
    public function getProductsCountAttribute()
    {
        return $this->products()->count();
    }
}
