<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function post ()
    {
        return $this->hasMany(Post::class); //Relación de uno a muchos
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //Almacena los seguidores de un usuario
    public function followers() 
    {
        return $this->belongsToMany(User::class, "followers", "user_id", "follower_id");
    }

    //Almacenar la gente que seguimos
    public function following() 
    {
        return $this->belongsToMany(User::class, "followers", "follower_id", "user_id");
    }

    public function siguiendo(User $user)
    {
        return $this->followers()->where('follower_id', $user->id)->exists();
    }

}
