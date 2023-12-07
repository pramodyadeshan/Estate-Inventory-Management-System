<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = ['date', 'note', 'price', 'user_id'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
