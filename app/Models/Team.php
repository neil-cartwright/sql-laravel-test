<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name'
    ];

    public function Users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function Roles()
    {
        return $this->belongsToMany(Role::class);
    }
}