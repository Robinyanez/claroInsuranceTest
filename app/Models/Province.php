<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    /**
     * definimos la tabla con la que vamos a trabajar
     *
     * @var string
     */
    protected $table = "provinces";

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
        'country_code',
        'description',
        'id_countries',
    ];
}
