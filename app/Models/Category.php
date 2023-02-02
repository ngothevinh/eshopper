<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    //lấy tất cả parent_id theo cha
    public function categoryChildrent(){
        return $this->hasMany(Category::class,'parent_id');
    }

    //tạo relationship từ bảng Category lấy được tất cả các sản phẩm từ bảng Product
    public function products(){
        return $this->hasMany(Product::class,'category_id');
    }
}
