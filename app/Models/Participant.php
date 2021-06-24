<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    // protected $fillable = ['dni','last_name','name','email','cell','sex','business'];
    protected $primaryKey = 'participant_id';

}
