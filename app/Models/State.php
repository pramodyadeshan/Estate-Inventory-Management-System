<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $fillable = ['id','state_name'];

    public function division()
    {
        return $this->hasMany(State::class, 'state_id');
    }

    public function user()
    {
        return $this->hasMany(User::class, 'state_id');
    }
}
