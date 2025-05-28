<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model {
  
  protected $table = 'registros';

  protected $primaryKey = 'IdRegistro';

  public $incrementing = true;

  protected $keyType = 'int';

  public $timestamps = true;

  protected $fillable = [
    'IdMask',
    'IdInFile',
    'Nombre',
    'Descripcion',
    'Origin'
  ];

  protected $casts = [
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
  ];
}
