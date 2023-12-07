<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'username',
        'password',
        'status',
        'role_id',
        'updated_at',
        'image',
        'state_id',
        'current_state',
    ];

    public function role()
    {
        return $this->belongsTo(UserRole::class);
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'user_id');
    }

    public function incomes()
    {
        return $this->hasMany(Income::class, 'user_id');
    }

    public function expenditure()
    {
        $this->hasMany(Expenditure::class, 'user_id');
    }
    public function Stock()
    {
        return $this->hasMany(Stock::class, 'user_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'id');
    }
    public function conference()
    {
        return $this->hasOne(Conference::class, 'user_id');
    }
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'status' => 'integer',
    ];
}
