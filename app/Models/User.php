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

    /**Relación belongsTo: La función rol() establece que un
     * User pertenece a una Rol. Esto significa que hay 
     * una relación de muchos a uno entre User y Rol. 
     * En la base de datos, esto se representa típicamente con una 
     * clave foránea en la tabla users que hace referencia a 
     * la tabla rols. 
     */
    public function rol()
    {
        //$user->$rol
        return $this->belongsTo(Rol::class);
    }

    /**Relación hasMany: La función projects() establece que un User
     * tiene muchas Project. Esto significa que hay una relación 
     * de uno a muchos entre User y Project. En la base de datos, 
     * esto se representa típicamente con una clave foránea en la tabla 
     * Projects que hace referencia a la tabla User. 
     * */

    public function projects()
    {
        //$user->$projects
        return $this->hasMany(Project::class);
    }

    public function assignments()
    {
        //$user->$assignments
        return $this->hasMany(Assignment::class);
    }

    public function trackings()
    {
        //$user->$trackings
        return $this->hasMany(Tracking::class);
    }
}
