<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; //para relaciones
use Illuminate\Database\Eloquent\Model;

class Ciudades extends Model
{
  use HasFactory;
  protected $table='Ciudades';
  protected $primaryKey='id_ciudad';
  protected $keyType='string';
  public $incrementing=false;

protected $fillable=['id_ciudad','ciudad','id_departamento'];
  
  //relacion uno a muchos
  public function departamentos(){
    return $this->belongsTo(Departamentos::class,'id_departamento','id_departamento');
  }

  //relacion uno a muchos inversa
  public function clientes()
  {
      return $this->hasMany(Clientes::class, 'ciudad', 'id_ciudad');
  }


}
