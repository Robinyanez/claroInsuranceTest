<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * definimos la tabla con la que vamos a trabajar
     *
     * @var string
     */
    protected $table = "messages";

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
        'asunto',
        'destinatario',
        'mensaje',
        'status',
        'id_users',
    ];

    /**
     * Metodo para definir relacion con el modelo User
     *
     * @return void
     */
    public function users(){
        return $this->belongsTo(User::class, 'id_users', 'id');
    }
}
