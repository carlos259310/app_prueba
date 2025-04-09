<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    //

    protected $table = 'clientes';

    //declarar la clave primaria
    protected $primaryKey = 'id_cliente';
    public $incrementing = true; // Asegurarse de que la clave primaria sea auto-incremental
    protected $keyType = 'int'; // Especificar el tipo de la clave primaria

    //colocar los campos que pueden ser alterados

    protected $fillable = [
        'nombre_1',
        'nombre_2',
        'apellido_1',
        'apellido_2',
        'email',
        'tipo_documento',
        'numero_documento',
        'tipo_cliente',
        'tipo_persona',
        'razon_social',
        'tipo_cliente',
        'telefono',
        'direccion',
        'ciudad',
        'departamento'
    ];

        /**
     * Relación con la tabla `ciudades`.
     * Un cliente pertenece a una ciudad.
     */
    public function ciudad()
    {
        return $this->belongsTo(Ciudades::class, 'ciudad', 'id_ciudad');
    }

    /**
     * Relación con la tabla `departamentos`.
     * Un cliente pertenece a un departamento.
     */
    public function departamento()
    {
        return $this->belongsTo(Departamentos::class, 'departamento', 'id_departamento');
    }
}
