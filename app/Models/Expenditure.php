<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'note', 'price', 'user_id'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
