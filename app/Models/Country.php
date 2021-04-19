<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    /**
     * definimos la tabla con la que vamos a trabajar
     *
     * @var string
     */
    protected $table = "countries";

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
        'description',
    ];
}
