<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    /**
     * definimos la tabla con la que vamos a trabajar
     *
     * @var string
     */
    protected $table = "cities";

    /**
     * definimos la primaryKey de la tabla con la que vamos a trabajar
     *
     * @var string
     */
    protected $primaryKey = "id";

    /**
     * definimos los atributos con los que se va a trabajar
     *
     * @var array
     */
    protected $fillable=[
        'name',
        'code',
        'code2',
        'country_code',
        'description',
        'id_provinces',
    ];

    /**
     * Metodo para definir relacion con el modelo User
     *
     * @return void
     */
    public function users() {
        return $this->hasMany(User::class, 'id_cities', 'id');
    }
}
