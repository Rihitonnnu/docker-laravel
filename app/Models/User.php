<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

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
    
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

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
    ];

    /**
     * @return \App\Models\User
     * @param int $id
     * @param string $name
     * @param string $email
     */
    public function updateUser(string $name, string $email, int $id)
    {
        $user = $this::find($id);
        $user->fill(['name' => $name, 'email' => $email])->save();
        return $user;
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteUser(int $id)
    {
        $this::find($id)->delete();
    }
}
