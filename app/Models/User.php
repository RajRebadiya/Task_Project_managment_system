<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'project_user')
            ->withPivot('project_id')
            ->withTimestamps();
    }

    public function project(): BelongsToMany
    {
        return $this->belongsToMany(Project::class)
            ->withPivot('role_id')
            ->withTimestamps();
    }

    public function projectCount()
    {
        return $this->projects()->count();
    }

    // In User.php model
    public function projectsWithRoles()
    {
        return $this->belongsToMany(Project::class, 'project_user')
            ->withPivot('role_id')
            ->join('roles', 'project_user.role_id', '=', 'roles.id')
            ->select('projects.*', 'roles.role_name');
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_user_project')->withTimestamps();
    }
}
