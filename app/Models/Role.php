<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name'
    ];

    public function Permissions()
    {
        return $this->hasMany(Permission::class);
    }

    public function Teams()
    {
        return $this->belongsToMany(Team::class);
    }

    public function Users()
    {
        return $this->belongsToMany(User::class);
    }
}