<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        'phone',
        'role_id',
        'options',
        'expiration_date',
        'verification_code',
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
        return $this->hasOne(Role::class, 'id');
    }

    public function assignRole(Role $role)
    {
        $this->roles()->attach($role);
    }

    public function revokeRole(Role $role)
    {
        $this->roles()->detach($role);
    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return $role->intersect($this->roles)->count();
    }
    
    // Пример назначения роли пользователю
    // $user = User::find(1);
    // $role = Role::where('name', 'admin')->first();
    // $user->assignRole($role);

    // // Пример проверки роли пользователя
    // $user = User::find(1);
    // if ($user->hasRole('admin')) {
    //     // Действия, доступные администратору
    // } else {
    //     // Действия для других ролей или незарегистрированных пользователей
    // }
}
