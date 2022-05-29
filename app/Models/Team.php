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
        // pivot table team_user
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}