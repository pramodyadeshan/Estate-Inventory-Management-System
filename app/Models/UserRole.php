<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    protected $fillable = ['id','role_name','group_level','status'];

    public function users()
    {
        return $this->hasOne(User::class);
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
