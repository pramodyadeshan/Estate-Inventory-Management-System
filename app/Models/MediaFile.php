<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'file_name',
        'file_type',
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'img_id');
    }
}
