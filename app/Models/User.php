<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'email',
        'is_admin',
        'phone',
        'identification_card',
        'date_of_birth',
        'password',
        'id_cities',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Metodo para definir relacion con el modelo City
     *
     * @return void
     */
    public function city(){
        return $this->belongsTo(City::class, 'id_cities', 'id');
    }

    /**
     * Metodo para definir relacion con el modelo Message
     *
     * @return void
     */
    public function messages(){
        return $this->hasMany(Message::class, 'id_users', 'id');
    }
}
