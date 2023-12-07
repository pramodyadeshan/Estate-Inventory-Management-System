<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    protected $fillable = ['division_name', 'state_id'];

    public function division()
    {
        return $this->hasMany(Division::class, 'division_name');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'division_id');
    }

    public function stock()
    {
        return $this->hasMany(Stock::class, 'division_id');
    }

}
