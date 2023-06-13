<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;
    protected $table = 'absences';
    protected $guarded = ['name_of_model', '_token', '_method'];
    protected $fillable = ['id_personne', 'id_event', 'date'];
}
