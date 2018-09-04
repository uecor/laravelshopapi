<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'description',
    ];

    // 与商品关联，一个类型下有许多产品
    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
