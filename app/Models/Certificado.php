<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificado extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'certificado_id';

    protected $table = 'certificados';
    protected $fillable = ['certificado_id', 'fecha_curso', 'curso', 'tipo_curso', 'tipo_documento', 'numero_documento', 'apellido_paterno', 'apellido_materno', 'empresa', 'cargo', 'email', 'supervisor_responsable', 'observaciones', 'acronimos', 'nombre_curso_oficial', 'fecha_oficial', 'cod_certificado', 'descripcion_larga', 'descripcion_corta', 'fecha_vencimiento', 'duracion', 'active', 'create_by', 'update_by', 'delete_by','nombres'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
