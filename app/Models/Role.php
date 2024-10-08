<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    public function projectUsers(): HasMany
    {
        return $this->hasMany(ProjectUser::class);
    }

    // In the Role model (Role.php)
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
