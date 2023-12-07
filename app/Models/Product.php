<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['id','name','qty','buy_price','sell_price','manu_date','exp_date','isActive','cate_id','img_id', 'user_id', 'division_id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cate_id');
    }

    public function image()
    {
        return $this->belongsTo(MediaFile::class, 'img_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function stock()
    {
        return $this->hasMany(Stock::class,'product_id');
    }
}
