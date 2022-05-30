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
        return $this->belongsToMany(Permission::class);
    }

    public function Teams()
    {
        return $this->belongsToMany(Team::class);
    }

    public function Users()
    {
        return $this->belongsToMany(User::class);
    }

    //https://laracasts.com/series/whats-new-in-laravel-5-1/episodes/16
    public function givePermissionTo(Permission $permission)
    {
        return $this->permissions()->save($permission);
    }
}