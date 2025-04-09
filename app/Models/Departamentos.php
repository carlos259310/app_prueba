<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    use HasFactory;
    protected $table = 'departamentos';
    protected $primaryKey = 'id_departamento';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['id_departamento', 'departamento'];
    //relacion uno a muchos
    public function ciudades()
    {
        return $this->hasMany(Ciudades::class, 'id_departamento', 'id_departamento');
    }
    //relacion uno a muchos inversa
    public function clientes()
    {
        return $this->hasMany(Clientes::class, 'departamento', 'id_departamento');
    }
  
}
