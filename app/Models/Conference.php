<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    use HasFactory;
    protected $fillable = ['link', 'unread', 'status', 'user_id', 'created_by'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
