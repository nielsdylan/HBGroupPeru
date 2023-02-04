<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
    use HasFactory;
    protected $primaryKey = 'certificado_id';

    protected $table = 'certificados';
    // protected $fillable = ['participant_id', 'cours_id', 'description_cours', 'date', 'hour', 'user_id', 'status', 'code', 'user_business_id', 'instructor_id', 'active', 'create_by', 'update_by', 'delete_by'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
